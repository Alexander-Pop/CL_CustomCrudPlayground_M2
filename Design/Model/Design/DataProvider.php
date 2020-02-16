<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/

namespace Codelegacy\Design\Model\Design;

use Codelegacy\Design\Model\ResourceModel\Design\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    public $_storeManager;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
    $name, $primaryFieldName, $requestFieldName, CollectionFactory $blockCollectionFactory, DataPersistorInterface $dataPersistor, \Magento\Store\Model\StoreManagerInterface $storeManager, array $meta = [], array $data = []
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->_storeManager = $storeManager;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData() {
        $temp=[];
        $tempthread=[];
        $baseurl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Magento\Cms\Model\Block $block */
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
            $temp = $block->getData();

            if($temp['thumbnail_image']!=''){
                $img = [];
                $img[0]['name'] = $temp['thumbnail_image'];
                $img[0]['url'] = $baseurl . $temp['thumbnail_image'];
                $temp['thumbnail_image'] = $img;
                $this->loadedData[$block->getId()]['thumbnail_image'] = $img;
            }

            // if($temp['glow_image']!=''){
            //     $mtl = [];
            //     $mtl[0]['name'] = $temp['glow_image'];
            //     $mtl[0]['url'] = $baseurl . $temp['glow_image'];
            //     $temp['glow_image'] = $mtl;
            //     $this->loadedData[$block->getId()]['glow_image'] = $mtl;
            // }

        }

        $data = $this->dataPersistor->get('codelegacy_design');

        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);

            $this->loadedData[$block->getId()] = $block->getData();

            $this->dataPersistor->clear('codelegacy_design');
        }

        if (empty($this->loadedData)) {
            return $this->loadedData;
        } else {

            if ($block->getData('codelegacy_designimage') != null) {
                $t2[$block->getId()] = $temp;
                return $t2;
            } else {
                return $this->loadedData;
            }

        }
    }

}