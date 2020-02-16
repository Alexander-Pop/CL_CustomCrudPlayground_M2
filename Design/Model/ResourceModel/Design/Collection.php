<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Design\Model\ResourceModel\Design;

use \Codelegacy\Design\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'codelegacy_design_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Codelegacy\Design\Model\Design', 'Codelegacy\Design\Model\ResourceModel\Design');
        $this->_map['fields']['codelegacy_design_id'] = 'main_table.codelegacy_design_id';
    }
}
