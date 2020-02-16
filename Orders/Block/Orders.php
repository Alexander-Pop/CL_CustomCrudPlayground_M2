<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\ObjectManagerInterface;

class Orders extends Template
{

    protected $scopeConfig;
    protected $collectionFactory;
    protected $objectManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Codelegacy\Orders\Model\ResourceModel\Orders\CollectionFactory $collectionFactory,
        ObjectManagerInterface $objectManager
    ) {

        $this->scopeConfig = $context->getScopeConfig();
        $this->collectionFactory = $collectionFactory;
        $this->objectManager = $objectManager;

        parent::__construct($context);
    }


    public function getFrontOrders()
    {


        $collection = $this->collectionFactory->create()->addFieldToFilter('status', 1);

        /*
         * cehck for arguments,provided in block call
         */
        if ($ids_list = $this->getOrdersBlockArguments()) {
            $collection->addFilter('codelegacy_orders_id', ['in' => $ids_list], 'public');
        }

        return $collection;
    }


    public function getOrdersBlockArguments()
    {

        $list =  $this->getOrdersList();

        $listArray = [];

        if ($list != '') {
            $listArray = explode(',', $list);
        }

        return $listArray;
    }

    public function getMediaDirectoryUrl()
    {

        $media_dir = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')
        ->getStore()
        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        return $media_dir;
    }
}
