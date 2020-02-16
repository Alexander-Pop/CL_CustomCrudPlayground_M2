<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Font\Model;

class Font extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('Codelegacy\Font\Model\ResourceModel\Font');
    }


    public function getAvailableStatuses()
    {


        $availableOptions = ['1' => 'Enable',
                          '0' => 'Disable'];

        return $availableOptions;
    }
}
