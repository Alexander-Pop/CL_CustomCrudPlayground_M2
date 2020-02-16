<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Contacts\Model\ResourceModel\Contacts;

use \Codelegacy\Contacts\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'codelegacy_contacts_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Codelegacy\Contacts\Model\Contacts', 'Codelegacy\Contacts\Model\ResourceModel\Contacts');
        $this->_map['fields']['codelegacy_contacts_id'] = 'main_table.codelegacy_contacts_id';
    }
}
