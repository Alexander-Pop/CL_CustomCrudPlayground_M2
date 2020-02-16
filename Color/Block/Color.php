<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Color\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\ObjectManagerInterface;

class Color extends Template
{

    protected $scopeConfig;
    protected $collectionFactory;
    protected $objectManager;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Codelegacy\Color\Model\ResourceModel\Color\CollectionFactory $collectionFactory,
        ObjectManagerInterface $objectManager
    ) {

        $this->scopeConfig = $context->getScopeConfig();
        $this->collectionFactory = $collectionFactory;
        $this->objectManager = $objectManager;

        parent::__construct($context);
    }


    public function getFrontColor()
    {
        $collection = $this->collectionFactory->create()
        ->addFieldToFilter('status', 1);

        /*
         * cehck for arguments,provided in block call
         */
        if ($ids_list = $this->getColorBlockArguments()) {
            $collection->addFilter('codelegacy_color_id', ['in' => $ids_list], 'public');
        }

        return $collection;
    }


    public function getColorBlockArguments()
    {

        $list =  $this->getColorList();

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
