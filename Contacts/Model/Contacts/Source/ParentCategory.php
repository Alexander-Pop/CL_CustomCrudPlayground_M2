<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\contacts\Model\contacts\Source;

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
          ['value' => 'Sole', 'label' => __('Sole')],
          ['value' => 'Hill', 'label' => __('Hill')],
          ['value' => 'Back', 'label' => __('Back')],
          ['value' => 'UpperBack', 'label' => __('UpperBack')],
          ['value' => 'Body', 'label' => __('Body')],
          ['value' => 'Front', 'label' => __('Front')],
          ['value' => 'Piping', 'label' => __('Piping')],
          ['value' => 'Less', 'label' => __('Less')],
          ['value' => 'InnerLining', 'label' => __('InnerLining')],
          ['value' => 'ToungePipe', 'label' => __('ToungePipe')],
          ['value' => 'Tounge', 'label' => __('Tounge')],
          ['value' => 'Upper', 'label' => __('Upper')]
        ];
    }
}
