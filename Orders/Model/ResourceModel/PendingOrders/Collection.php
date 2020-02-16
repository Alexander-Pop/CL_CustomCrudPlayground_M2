<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Model\ResourceModel\PendingOrders;

use \Codelegacy\Orders\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

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
        $this->_init('Codelegacy\Orders\Model\PendingOrders', 'Codelegacy\Orders\Model\ResourceModel\PendingOrders');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
