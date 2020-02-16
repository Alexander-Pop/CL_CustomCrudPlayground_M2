<?php

/*
 * Action : save product design data
 */

namespace Codelegacy\Customize\Observer;

use Magento\Framework\Event\ObserverInterface;

class Productsaveafter implements ObserverInterface {

    public function __construct(
    \Magento\Framework\App\RequestInterface $request, \Magento\Framework\App\Filesystem\DirectoryList $directory_list, \Magento\Store\Model\StoreManagerInterface $storeManager, \Codelegacy\Customize\Model\ProductCustomViewsFactory $productViewFactory, \Codelegacy\Customize\Model\ProductPartColorsFactory $productColorFactory, \Codelegacy\Customize\Model\ProductTextLengthFactory $productTextLengthFactory, \Codelegacy\Customize\Model\ProductOtherinfoFactory $productOtherinfoFactory
    ) {
        $this->request = $request;
        $this->directory_list = $directory_list;
        $this->storeManager = $storeManager;
        $this->productViewFactory = $productViewFactory;
        $this->productColorFactory = $productColorFactory;
        $this->productTextLengthFactory = $productTextLengthFactory;
        $this->productOtherinfoFactory = $productOtherinfoFactory;
    }

    public function execute(
    \Magento\Framework\Event\Observer $observer
    ) {
        $_product = $observer->getProduct();
        $product_id = $_product->getId();
        $post = $this->request->getParams();
        $this->saveProductParts($post, $product_id);
        $this->saveProductTextLimit($post, $product_id);
        $this->saveImageViews($post, $product_id);
        $this->saveOtherInfo($post, $product_id);
    }

    public function deleteAll($model, $id) {
        $modelPrduct = $model->getCollection();
        $modelPrduct->addFieldToFilter('product_id', $id);

        foreach ($modelPrduct as $collection) {
            $collection->delete();
        }
    }

    /*
     * Save product parts
     */

    public function saveProductParts($data, $id) {
        if (!isset($data['customize_product']['part'])) {
            return;
        }
        $this->deleteAll($this->productColorFactory->create(), $id);
        $cnt1 = 0;


        foreach ($data['customize_product']['part'] as $cusotm_product) {
            $saveData = array();
            $saveData['product_id'] = $id;

            $saveData['part_id'] = $cnt1;
            $saveData['part_name'] = $cusotm_product['part_name'];
            $cnt2 = 0;
            try {
                foreach ($cusotm_product['data'] as $colorData) {
                    $saveData['color_code'] = $colorData['color_code'];
                    $saveData['color_title'] = $colorData['color_title'];
                    $saveData['price'] = $colorData['price'];
                    $saveData['color'] = $colorData['color'];
                    $saveData['active'] = (isset($data['customize_product']['active']) && (int) ($cnt1 . $cnt2) == $data['customize_product']['active']) ? 1 : 0;

                    $modelPrductColor = $this->productColorFactory->create()->load($id, 'product_id');
                    ;
                    $modelPrductColor->setProductId($id);
                    $modelPrductColor->setData($saveData);
                    $modelPrductColor->save();
                    $cnt2 ++;
                }
                $cnt1++;
            } catch (\Exception $e) {
                echo $e;
                die;
            }
        }
    }

    /*
     * Save product text limit value
     */

    public function saveProductTextLimit($data, $id) {
        if (!isset($data['customize_product']['text_limit'])) {
            return;
        }


        $this->deleteAll($this->productTextLengthFactory->create(), $id);
        foreach ($data['customize_product']['text_limit'] as $text_limit) {
            $saveData = array();
            $saveData['product_id'] = $id;
            $saveData['part_name'] = $text_limit['views'];

            try {
                foreach ($text_limit['data'] as $data) {
                    $saveData['len_title'] = $data['length_title'];
                    $saveData['llength'] = $data['length'];
                    $saveData['mlength'] = $data['mlength'];
                    $saveData['optional'] = $data['optional'];

                    $modelTextLimit = $this->productTextLengthFactory->create()->load($id, 'product_id');
                    $modelTextLimit->setProductId($id);
                    $modelTextLimit->setData($saveData);
                    $modelTextLimit->save();
                }
            } catch (\Exception $e) {
                echo $e;
                die;
            }
        }
    }

    /*
     * Save product view images ( svg/png )
     */

    public function saveImageViews($data, $id) {
        if (!isset($data['customize_images'])) {
            return;
        }
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl();
        $rootPath = $this->directory_list->getRoot();

        $modelProductView = $this->productViewFactory->create()->load($id, 'product_id');

        if (count($modelProductView->getData()) < 1) {
            $modelProductView->setProductId($id);
        }

        foreach ($data['customize_images'] as $key => $imageData) {
            $imageName = $imageData[0]['name'];
            $url = $imageData[0]['url'];

            $thmb = (strpos($key, "thumb") !== false) ? "_THMB" : "";

            $newImageName = "PID_" . $id . $thmb . "_ANG_" . explode("image_", $key)[1] . "." . pathinfo($url, PATHINFO_EXTENSION);
            $rootImagePath = $rootPath . '/' . explode($mediaUrl, $url)[1];
            $newPath = str_replace($imageName, $newImageName, $rootImagePath);

            if (sizeof($imageData[0]) > 5) {

                if (is_file($rootImagePath) && file_exists($rootImagePath)) {
                    rename($rootImagePath, $newPath);

                    $modelProductView->setData('product_id', $id);
                    $modelProductView->setData($key, $newImageName);

                    try {
                        $modelProductView->save();
                    } catch (\Exception $e) {
                        echo $e;
                        die;
                    }
                }
            }
        }
    }

    /*
     * Save product other info ( font,size category,cliparts )
     */

    function saveOtherInfo($data, $id){

        if (!isset($data['otherInfo'])){
            return;
        }

        $mediaUrl = $this->storeManager->getStore()->getBaseUrl();
        $rootPath = $this->directory_list->getRoot();

        $modelProductOtherInfo = $this->productOtherinfoFactory->create()->load($id, 'product_id');


        if (count($modelProductOtherInfo->getData()) < 1) {
            $modelProductOtherInfo->setData('product_id', $id);
        }

        $modelProductOtherInfo->setData('font', serialize($data['otherInfo']['font']));
        $modelProductOtherInfo->setData('font_size', $data['otherInfo']['font_size']);
        $modelProductOtherInfo->setData('clipcat', serialize($data['otherInfo']['clipcat']));
        $modelProductOtherInfo->setData('bclipcat', serialize($data['otherInfo']['bclipcat']));
        $modelProductOtherInfo->setData('sizecat', serialize($data['otherInfo']['sizecat']));
        $modelProductOtherInfo->setData('stylenumber', serialize($data['otherInfo']['stylenumber']));
        $modelProductOtherInfo->setData('swatch_status', $data['otherInfo']['swatch_status']);
        try {
            $modelProductOtherInfo->save();
        } catch (Exception $ex){
            echo $ex;
            die;
        }
    }

}
