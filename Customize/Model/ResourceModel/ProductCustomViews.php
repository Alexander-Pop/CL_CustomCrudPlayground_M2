<?php

namespace Codelegacy\Customize\Model\ResourceModel;

class ProductCustomViews extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('product_custom_views', 'view_id');
    }
}
