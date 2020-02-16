<?php


namespace Codelegacy\Customize\Model\ResourceModel\ProductFonts;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    protected $_idFieldName = 'font_id';

    protected function _construct() {
        $this->_init('Codelegacy\Customize\Model\ProductFonts', 'Codelegacy\Customize\Model\ResourceModel\ProductFonts');
        $this->_map['fields']['font_id'] = 'main_table.font_id';
    }

}
