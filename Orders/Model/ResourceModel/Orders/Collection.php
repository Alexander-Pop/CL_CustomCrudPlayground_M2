<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Model\ResourceModel\Orders;

use \Codelegacy\Orders\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'codelegacy_orders_id';

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
        $this->_init('Codelegacy\Orders\Model\Orders', 'Codelegacy\Orders\Model\ResourceModel\Orders');
        $this->_map['fields']['codelegacy_orders_id'] = 'main_table.codelegacy_orders_id';
    }
}
