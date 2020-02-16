<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Contacts\Model;

class Contacts extends \Magento\Framework\Model\AbstractModel
{


    protected function _construct()
    {
        $this->_init('Codelegacy\Contacts\Model\ResourceModel\Contacts');
    }


    public function getAvailableStatuses()
    {


        $availableOptions = ['1' => 'Enable',
                          '0' => 'Disable'];

        return $availableOptions;
    }
}
