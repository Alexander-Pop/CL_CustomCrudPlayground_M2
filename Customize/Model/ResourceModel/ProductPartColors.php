<?php

namespace Codelegacy\Customize\Model\ResourceModel;

class ProductPartColors extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('product_custom_colors', 'color_id');
    }
}
