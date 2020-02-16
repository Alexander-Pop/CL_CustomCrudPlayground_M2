<?php
namespace Codelegacy\Customize\Block\Adminhtml\Product;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;

class TextLimit extends \Magento\Backend\Block\Widget\Form\Generic {

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    protected $_template = 'Codelegacy_Customize::product/text-limit.phtml';

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\System\Store $systemStore, \Magento\Framework\App\Request\Http $request, \Magento\Store\Model\StoreManagerInterface $storeManager, \Codelegacy\Customize\Model\ProductTextLengthFactory $productTextLengthFactory, array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_systemStore = $systemStore;
        $this->request = $request;
        $this->storeManager = $storeManager;
        $this->productTextLengthFactory = $productTextLengthFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /*
     * Get product text limit data
     */

    public function getProductTextLimitData() {
        $modelPrductColor = $this->productTextLengthFactory->create()->getCollection();
        $modelPrductColor->addFieldToFilter('product_id', $this->getCurrentProduct()->getId());
        $modelPrductColor->getSelect()->group('part_name');
        $text_view = array();
        $edcolor = 0;
        foreach ($modelPrductColor->getData() as $views) {
            $cnt = 0;
            $view = $views['part_name'];
            $customcolorsquery1 = $this->productTextLengthFactory->create()->getCollection();
            $customcolorsquery1->addFieldToFilter('product_id', $this->getCurrentProduct()->getId());
            $customcolorsquery1->addFieldToFilter('part_name', $view);
            $customcolorsresult1 = $customcolorsquery1->getData();
            foreach ($customcolorsresult1 as $colors) {
                $text_view[$view][$cnt]['length'] = $colors['llength'];
                $text_view[$view][$cnt]['mlength'] = $colors['mlength'];
                $text_view[$view][$cnt]['optional'] = $colors['optional'];
                $text_view[$view][$cnt]['length_title'] = $colors['len_title'];
                $cnt++;
            }
        }

        return $text_view;
    }

    public function getCurrentProduct() {
        return $this->_coreRegistry->registry('current_product');
    }

}
