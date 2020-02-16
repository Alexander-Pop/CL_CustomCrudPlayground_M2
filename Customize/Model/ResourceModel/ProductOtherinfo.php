<?php

namespace Codelegacy\Customize\Model\ResourceModel;

class ProductOtherinfo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('product_custom_otherinfo', 'otherinfo_id');
    }
}
