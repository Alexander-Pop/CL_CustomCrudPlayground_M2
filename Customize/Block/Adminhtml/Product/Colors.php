<?php

/*
 * This block is used to get color data
 */

namespace Codelegacy\Customize\Block\Adminhtml\Product;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;

class Colors extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    protected $_template = 'Codelegacy_Customize::product/colors.phtml';
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Codelegacy\Customize\Model\ProductPartColorsFactory $productColorFactory,
        array $data = []
    ) {
        $this->_coreRegistry    = $registry;
        $this->_systemStore     = $systemStore;
        $this->request          = $request;
        $this->storeManager     = $storeManager;
        $this->productColorFactory = $productColorFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    
    /*
     * Get product part data
     */

    public function getProductPartData() {
        $modelPrductColor = $this->productColorFactory->create()->getCollection();
        $modelPrductColor->addFieldToFilter('product_id', $this->getCurrentProduct()->getId());
        $modelPrductColor->getSelect()->group('part_name');
        $partArr = array();
        $edcolor = 0;
        foreach ($modelPrductColor->getData() as $parts) {
            $cnt = 0;
            $part = $parts['part_name'];
            $customcolorsquery1 = $this->productColorFactory->create()->getCollection();
            $customcolorsquery1->addFieldToFilter('product_id', $this->getCurrentProduct()->getId());
            $customcolorsquery1->addFieldToFilter('part_name', $part);
            $customcolorsresult1 = $customcolorsquery1->getData();
            foreach ($customcolorsresult1 as $colors) {
                $partArr[$part][$cnt]['color_code'] = $colors['color_code'];
                $partArr[$part][$cnt]['price'] = $colors['price'];
                $partArr[$part][$cnt]['name'] = $colors['color_title'];
                $partArr[$part][$cnt]['color'] = $colors['color'];
                $partArr[$part][$cnt]['active'] = $colors['active'];
                $cnt++;
            }
        }


        return $partArr;
    }

    public function getCurrentProduct()
    {       
        return $this->_coreRegistry->registry('current_product');
    }

}
