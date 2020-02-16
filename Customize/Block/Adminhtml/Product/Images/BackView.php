<?php

namespace Codelegacy\Customize\Block\Adminhtml\Product\Images;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Backend\Block\Widget\Form;
use Magento\Backend\Block\Widget\Form\Generic;


class BackView extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    protected $_template = 'Codelegacy_Customize::product/images/back-view.phtml';

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->_coreRegistry    = $registry;
        $this->_systemStore     = $systemStore;
        $this->request          = $request;
        $this->storeManager     = $storeManager;
        parent::__construct($context, $registry, $formFactory, $data);
      }
}
