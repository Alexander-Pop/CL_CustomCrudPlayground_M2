<?php

namespace Codelegacy\Customize\Model\ResourceModel\ProductPartColors;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{	
	protected $_idFieldName = 'color_id';

    protected function _construct()
    {
        $this->_init('Codelegacy\Customize\Model\ProductPartColors', 'Codelegacy\Customize\Model\ResourceModel\ProductPartColors');
        $this->_map['fields']['color_id'] = 'main_table.color_id';
    }
}
