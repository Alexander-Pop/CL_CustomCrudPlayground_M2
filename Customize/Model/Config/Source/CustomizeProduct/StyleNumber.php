<?php

namespace Codelegacy\Customize\Model\Config\Source\CustomizeProduct;

class StyleNumber implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Get available options
     *
     * @codeCoverageIgnore
     * @return array
     */
    // public function __construct(
    // \Codelegacy\Style\Model\StyleFactory $styleNumberFactory
    // ) {
    //     $this->styleNumberFactory = $styleNumberFactory;
    // }

    public function toOptionArray(){

        $option = array();
        // $model = $this->styleNumberFactory->create()->getCollection();
        //
        // foreach ($model->getData() as $style) {
        //     $option[] = array(
        //         'value' => $style['custom_style_id'],
        //         'label' => $style['number']
        //     );
        // }

        $option[] = array(
            'value' => 'style',
            'label' => 'style'
        );

        return $option;
    }

}
