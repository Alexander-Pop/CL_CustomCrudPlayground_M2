<?php
namespace Codelegacy\Customize\Model\Config\Source\CustomizeProduct;

class Font implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get available options
     *
     * @codeCoverageIgnore
     * @return array
     */
    // public function __construct(
    // 	\Codelegacy\DesignData\Model\FontFactory $productFontsFactory
    // ) {
    // 	$this->productFontsFactory = $productFontsFactory;
    // }

    public function toOptionArray()
    {

    	$option = array();
    	// $model = $this->productFontsFactory->create()->getCollection();
      //
    	// foreach($model->getData() as $font) {
			// $option[] = array(
			// 	'value' => $font['font_id'],
			// 	'label' => $font['name']
			// );
    	// }

      $option[] = array(
        'value' => 'value 1',
        'label' => 'font'
      );

    	return $option;
    }
}
