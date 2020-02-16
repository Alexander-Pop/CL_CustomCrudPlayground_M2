<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Color\Model\Color\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Path implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        $availableOptions = ['1' => 'Enable', '0' => 'Disable'];

        $options = [];
        foreach ($availableOptions as $key => $label) {
            $options[] = [
                'label' => $label,
                'value' => $key,
            ];
        }
        return $options;
    }
}
