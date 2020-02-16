<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\font\Model\font\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class ParentCategory implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        return [
          ['value' => '1', 'label' => __('cat 1')],
          ['value' => '2', 'label' => __('cat 2')],
          ['value' => '3', 'label' => __('cat 3')],
          ['value' => '4', 'label' => __('cat 4')]
        ];
    }
}
