<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Color\Model\ResourceModel\Color;

use \Codelegacy\Color\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'codelegacy_color_id';

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
        $this->_init('Codelegacy\Color\Model\Color', 'Codelegacy\Color\Model\ResourceModel\Color');
        $this->_map['fields']['codelegacy_color_id'] = 'main_table.codelegacy_color_id';
    }
}
