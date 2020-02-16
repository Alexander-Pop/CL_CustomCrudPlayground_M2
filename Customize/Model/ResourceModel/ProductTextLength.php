<?php

namespace Codelegacy\Customize\Model\ResourceModel;

class ProductTextLength extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('product_custom_length', 'len_id');
    }
}
