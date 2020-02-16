<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Block\Adminhtml\Orders;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinueButton
 */
class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        // return [
        //     'label' => __('Save and Continue Edit'),
        //     'class' => 'save',
        //     'data_attribute' => [
        //         'mage-init' => [
        //             'button' => ['eorders' => 'saveAndContinueEdit'],
        //         ],
        //     ],
        //     'sort_order' => 80,
        // ];
    }
}
