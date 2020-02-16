<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\orders\Model\orders\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Style implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => '1', 'label' => __('Single Breasted')],
            ['value' => '2', 'label' => __('Double breasted')],
            ['value' => '3', 'label' => __('StitMandarinch')]
        ];
    }
}
