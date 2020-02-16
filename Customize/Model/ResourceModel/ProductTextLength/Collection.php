<?php

namespace Codelegacy\Customize\Model\ResourceModel\ProductTextLength;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{	
	protected $_idFieldName = 'len_id';

    protected function _construct()
    {
        $this->_init('Codelegacy\Customize\Model\ProductTextLength', 'Codelegacy\Customize\Model\ResourceModel\ProductTextLength');
        $this->_map['fields']['len_id'] = 'main_table.len_id';
    }
}
