<?php
namespace Codelegacy\Customize\Model\Config\Source\CustomizeProduct;

class FontSize implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Get available options
     *
     * @codeCoverageIgnore
     * @return array
     */
    public function toOptionArray()
    {
    	return array(
    		['value' => '15', 'label' => '15'],
    		['value' => '20', 'label' => '20'],
    		['value' => '30', 'label' => '30'],
    		['value' => '32', 'label' => '32'],
    		['value' => '34', 'label' => '34'],
    		['value' => '36', 'label' => '36'],
    		['value' => '38', 'label' => '38'],
    		['value' => '40', 'label' => '40'],
                ['value' => '44', 'label' => '44'],
                ['value' => '50', 'label' => '50'],
                ['value' => '60', 'label' => '60'],
                ['value' => '80', 'label' => '80'],
                ['value' => '85', 'label' => '85'],
                ['value' => '90', 'label' => '90']
    	);
    }
}
