<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Font\Model\Font\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Size implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => '1', 'label' => __('Slim')],
            ['value' => '2', 'label' => __('Regular')],
            ['value' => '3', 'label' => __('Wide')]
        ];
    }
}
