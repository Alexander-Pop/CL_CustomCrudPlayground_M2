<?php

namespace Codelegacy\Customize\Model\ResourceModel\ProductOtherinfo;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{	
	protected $_idFieldName = 'otherinfo_id';

    protected function _construct()
    {
        $this->_init('Codelegacy\Customize\Model\ProductOtherinfo', 'Codelegacy\Customize\Model\ResourceModel\ProductOtherinfo');
        $this->_map['fields']['otherinfo_id'] = 'main_table.otherinfo_id';
    }
}
