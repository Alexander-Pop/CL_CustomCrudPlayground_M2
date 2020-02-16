<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Model;

class Orders extends \Magento\Framework\Model\AbstractModel
{


    protected function _construct()
    {
        $this->_init('Codelegacy\Orders\Model\ResourceModel\Orders');
    }


    public function getAvailableStatuses()
    {


        $availableOptions = ['1' => 'Enable',
                          '0' => 'Disable'];

        return $availableOptions;
    }
}
