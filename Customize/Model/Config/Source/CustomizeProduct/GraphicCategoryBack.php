<?php
namespace Codelegacy\Customize\Model\Config\Source\CustomizeProduct;

class GraphicCategoryBack implements \Magento\Framework\Option\ArrayInterface
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
      //   $model->addFieldToFilter('type',array('eq'=>0));
    	// foreach($model->getData() as $font) {
			// $option[] = array(
			// 	'value' => $font['gcat_id'],
			// 	'label' => $font['title']
			// );
    	// }
      $option[] = array(
        'value' => 'value 2',
        'label' => 'label 1'
      );
        return $option;
    }
}
