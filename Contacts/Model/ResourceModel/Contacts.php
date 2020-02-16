<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Contacts\Model\ResourceModel;

class Contacts extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{



    protected function _construct()
    {
        $this->_init('codelegacy_contacts', 'codelegacy_contacts_id');
    }
}
