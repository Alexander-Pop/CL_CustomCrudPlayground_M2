<?php

/*
 * Product data provider
 */

namespace Codelegacy\Customize\Plugin;

use Magento\Framework\UrlInterface;

class ProductDataProvider {

    public function __construct(
    \Magento\Framework\Registry $registry, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Filesystem\DirectoryList $directory_list, \Codelegacy\Customize\Model\ProductCustomViewsFactory $customViewFactory, \Codelegacy\Customize\Model\ProductOtherinfoFactory $productOtherinfoFactory
    ) {
        $this->_registry = $registry;
        $this->storeManager = $storeManager;
        $this->directory_list = $directory_list;
        $this->customViewFactory = $customViewFactory;
        $this->productOtherinfoFactory = $productOtherinfoFactory;
    }

    /*
     * Get full path of images & prepare data for other information
     */

    public function aroundGetData(\Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider $subject, callable $proceed) {
        $result = $proceed();

        $rootPath = $this->directory_list->getPath('media') . "/";
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        $model = $this->customViewFactory->create()->load($this->getCurrentProduct()->getId(), 'product_id');


        $otherInfoModel = $this->productOtherinfoFactory->create()->load($this->getCurrentProduct()->getId(), 'product_id');


        $customProductData = $model->getData();

        $customProductOtherInfo = $otherInfoModel->getData();

        foreach ($result as &$product) {

            if (array_keys($product)[0] == 'product') {

                if (sizeof($customProductData) > 0) {

                    if ($customProductData['view_image_1'] != "" && file_exists($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_image_1'])) {
                        $product['customize_images']['view_image_1'][0]['name'] = $customProductData['view_image_1'];
                        $product['customize_images']['view_image_1'][0]['size'] = filesize($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_image_1']);
                        $product['customize_images']['view_image_1'][0]['url'] = $mediaUrl . 'catalog/tmp/custom_product/' . $customProductData['view_image_1'];
                    }

                    if ($customProductData['view_image_2'] != "" && file_exists($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_image_2'])) {
                        $product['customize_images']['view_image_2'][0]['name'] = $customProductData['view_image_2'];
                        $product['customize_images']['view_image_2'][0]['size'] = filesize($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_image_2']);
                        $product['customize_images']['view_image_2'][0]['url'] = $mediaUrl . 'catalog/tmp/custom_product/' . $customProductData['view_image_2'];
                    }

                    if ($customProductData['view_image_3'] != "" && file_exists($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_image_3'])) {
                        $product['customize_images']['view_image_3'][0]['name'] = $customProductData['view_image_3'];
                        $product['customize_images']['view_image_3'][0]['size'] = filesize($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_image_3']);
                        $product['customize_images']['view_image_3'][0]['url'] = $mediaUrl . 'catalog/tmp/custom_product/' . $customProductData['view_image_3'];
                    }



                    if ($customProductData['view_thumb_image_1'] != "" && file_exists($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_1'])) {
                        $product['customize_images']['view_thumb_image_1'][0]['name'] = $customProductData['view_thumb_image_1'];
                        $product['customize_images']['view_thumb_image_1'][0]['size'] = filesize($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_1']);
                        $product['customize_images']['view_thumb_image_1'][0]['url'] = $mediaUrl . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_1'];
                    }

                    if ($customProductData['view_thumb_image_2'] != "" && file_exists($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_2'])) {
                        $product['customize_images']['view_thumb_image_2'][0]['name'] = $customProductData['view_thumb_image_2'];
                        $product['customize_images']['view_thumb_image_2'][0]['size'] = filesize($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_2']);
                        $product['customize_images']['view_thumb_image_2'][0]['url'] = $mediaUrl . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_2'];
                    }

                    if ($customProductData['view_thumb_image_3'] != "" && file_exists($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_3'])) {
                        $product['customize_images']['view_thumb_image_3'][0]['name'] = $customProductData['view_thumb_image_3'];
                        $product['customize_images']['view_thumb_image_3'][0]['size'] = filesize($rootPath . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_3']);
                        $product['customize_images']['view_thumb_image_3'][0]['url'] = $mediaUrl . 'catalog/tmp/custom_product/' . $customProductData['view_thumb_image_3'];
                    }
                }
            }

            if (sizeof($customProductOtherInfo) > 0) {
                $product['otherInfo']['font'] = unserialize($customProductOtherInfo['font']);
                $product['otherInfo']['font_size'] = $customProductOtherInfo['font_size'];
                $product['otherInfo']['clipcat'] = unserialize($customProductOtherInfo['clipcat']);
                $product['otherInfo']['bclipcat'] = unserialize($customProductOtherInfo['bclipcat']);
                $product['otherInfo']['sizecat'] = unserialize($customProductOtherInfo['sizecat']);
                $product['otherInfo']['stylenumber'] = unserialize($customProductOtherInfo['stylenumber']);
                $product['otherInfo']['swatch_status'] = $customProductOtherInfo['swatch_status'];
            }
        }

        // echo "<pre>"; print_r($result); die;
        return $result;
    }

    public function getCurrentProduct() {
        return $this->_registry->registry('current_product');
    }

}
