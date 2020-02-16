<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Font\Model\ResourceModel\Font;

use \Codelegacy\Font\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'codelegacy_font_id';

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
        $this->_init('Codelegacy\Font\Model\Font', 'Codelegacy\Font\Model\ResourceModel\Font');
        $this->_map['fields']['codelegacy_font_id'] = 'main_table.codelegacy_font_id';
    }
}
