<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Design\Model\Design\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Type implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

      return [
          ['value' => '1', 'label' => __('Wash/Fade')],
          ['value' => '2', 'label' => __('Riped/Details')],
          ['value' => '3', 'label' => __('Paints/Art')]
      ];
    }
}
