<?php

namespace Codelegacy\Customize\Model;

class ProductCustomViews extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Codelegacy\Customize\Model\ResourceModel\ProductCustomViews');
    }
}
