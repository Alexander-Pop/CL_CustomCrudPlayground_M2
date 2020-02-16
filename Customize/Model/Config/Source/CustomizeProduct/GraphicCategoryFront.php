<?php
namespace Codelegacy\Customize\Model\Config\Source\CustomizeProduct;

class GraphicCategoryFront implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get available options
     *
     * @codeCoverageIgnore
     * @return array
     */
    //  public function __construct(
    // 	\Codelegacy\DesignData\Model\GraphicsCategoryFactory $productGraphicsFactory
    // ) {
    // 	$this->productGraphicsFactory = $productGraphicsFactory;
    // }

    public function toOptionArray()
    {
    	$option = array();
    	// $model = $this->productGraphicsFactory->create()->getCollection();
      //   $model->addFieldToFilter('type',array('eq'=>1));
    	// foreach($model->getData() as $font) {
			// $option[] = array(
			// 	'value' => $font['gcat_id'],
			// 	'label' => $font['title']
			// );
    	// }

      // $option[] = array(
      //   'value' => 'value 2',
      //   'label' => 'label'
      // );
      //   return $option;
      return [
        ['value' => '0', 'label' => __('Sole')],
        ['value' => '1', 'label' => __('Hill')],
        ['value' => '2', 'label' => __('Back')],
        ['value' => '3', 'label' => __('UpperBack')],
        ['value' => '4', 'label' => __('Body')],
        ['value' => '5', 'label' => __('Front')],
        ['value' => '6', 'label' => __('Piping')],
        ['value' => '7', 'label' => __('Less')],
        ['value' => '8', 'label' => __('InnerLining')],
        ['value' => '9', 'label' => __('TungPipe')],
        ['value' => '10', 'label' => __('Tung')],
        ['value' => '11', 'label' => __('Upper')]
      ];
    }
}
