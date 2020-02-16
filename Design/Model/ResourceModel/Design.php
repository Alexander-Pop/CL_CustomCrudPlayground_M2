<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Design\Model\ResourceModel;

class Design extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{



    protected function _construct()
    {
        $this->_init('codelegacy_design', 'codelegacy_design_id');
    }
}
