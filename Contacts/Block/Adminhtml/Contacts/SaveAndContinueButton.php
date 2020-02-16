<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Contacts\Block\Adminhtml\Contacts;

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
        //             'button' => ['econtacts' => 'saveAndContinueEdit'],
        //         ],
        //     ],
        //     'sort_order' => 80,
        // ];
    }
}
