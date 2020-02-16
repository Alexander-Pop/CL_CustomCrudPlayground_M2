<?php
namespace Codelegacy\Customize\Model\Config\Source\CustomizeProduct;

class SizeCategory implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get available options
     *
     * @codeCoverageIgnore
     * @return array
     */

    //  public function __construct(
    // 	\Codelegacy\DesignData\Model\SizeCategoryFactory $productSizeFactory
    // ) {
    // 	$this->productSizeFactory = $productSizeFactory;
    // }

    public function toOptionArray()
    {
    	$option = array();
    	// $model = $this->productSizeFactory->create()->getCollection();
      //
    	// foreach($model->getData() as $font) {
			// $option[] = array(
			// 	'value' => $font['sizecat_id'],
			// 	'label' => $font['title']
			// );
    	// }
      $option[] = array(
        'value' => 'value 2',
        'label' => 'label'
      );
        return $option;
    }
}
