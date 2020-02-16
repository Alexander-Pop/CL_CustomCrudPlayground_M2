<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Font\Model\ResourceModel;

class Font extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{



    protected function _construct()
    {
        $this->_init('codelegacy_font', 'codelegacy_font_id');
    }
}
