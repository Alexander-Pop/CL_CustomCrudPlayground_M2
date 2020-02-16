<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Color\Model;

class Color extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('Codelegacy\Color\Model\ResourceModel\Color');
    }

    public function getAvailableStatuses()
    {

        $availableOptions = [
            '1' => 'Enable',
            '0' => 'Disable'
        ];

        return $availableOptions;
    }
}
