<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Model\Orders;

use Codelegacy\Orders\Model\ResourceModel\Orders\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProviderThread extends \Magento\Ui\DataProvider\AbstractDataProvider
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
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->_storeManager=$storeManager;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $baseurl =  $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Magento\Cms\Model\Block $block */
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();

            $temp = $block->getData();
                $img = [];
                $img[0]['name'] = $temp['codelegacy_ordersimage'];
                $img[0]['url'] = $baseurl.$temp['codelegacy_ordersimage'];
               $temp['codelegacy_ordersimage'] = $img;

               $img2 = [];
               $img2[0]['name'] = $temp['codelegacy_ordersmtl'];
               $img2[0]['url'] = $baseurl.$temp['codelegacy_ordersmtl'];
              $temp['codelegacy_ordersmtl'] = $img2;

                $imgthread = [];
                $imgthread[0]['name'] = $temp['codelegacy_ordersobj'];
                $imgthread[0]['url'] = $baseurl.$temp['codelegacy_ordersobj'];
               $temp['codelegacy_ordersobj'] = $imgthread;
        }






        $data = $this->dataPersistor->get('codelegacy_orders');

        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);



            $this->loadedData[$block->getId()] = $block->getData();

            $this->dataPersistor->clear('codelegacy_orders');
        }

        if (empty($this->loadedData)) {
            return $this->loadedData;
        } else {
            if ($block->getData('codelegacy_ordersobj') != null && $block->getData('codelegacy_ordersimage') != null) {
                $t2[$block->getId()] = $temp;
                return $t2;
            } else {
                return $this->loadedData;
            }
        }
    }
}
