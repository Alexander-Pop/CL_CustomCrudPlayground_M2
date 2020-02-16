<?php

namespace Codelegacy\Customize\Model\ResourceModel\ProductCustomViews;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{	
	protected $_idFieldName = 'view_id';

    protected function _construct()
    {
        $this->_init('Codelegacy\Customize\Model\ProductCustomViews', 'Codelegacy\Customize\Model\ResourceModel\ProductCustomViews');
        $this->_map['fields']['view_id'] = 'main_table.view_id';
    }
}
