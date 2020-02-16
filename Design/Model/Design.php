<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Design\Model;

class Design extends \Magento\Framework\Model\AbstractModel
{


    protected function _construct()
    {
        $this->_init('Codelegacy\Design\Model\ResourceModel\Design');
    }


    public function getAvailableStatuses()
    {


        $availableOptions = ['1' => 'Enable',
                          '0' => 'Disable'];

        return $availableOptions;
    }
}
