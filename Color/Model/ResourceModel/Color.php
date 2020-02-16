<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Color\Model\ResourceModel;

class Color extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init(
        	'codelegacy_color', 
        	'codelegacy_color_id'
        );
    }
}
