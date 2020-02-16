<?php

namespace Codelegacy\Customize\Model\ResourceModel;

class ProductFonts extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('font', 'font_id');
    }
}
