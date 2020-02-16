<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Contacts\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {

    public function install(
        SchemaSetupInterface $setup, 
        ModuleContextInterface $context
    ) {

        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'codelegacy_contacts'
         */
        $table = $installer->getConnection()->newTable($installer->getTable('codelegacy_contacts'))
            ->addColumn(
                'codelegacy_contacts_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true, 
                    'unsigned' => true, 
                    'nullable' => false, 
                    'primary' => true
                ],
                'Contacts ID'
            )->addColumn(
                'f_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'F Name'
            )->addColumn(
                'l_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'L Name'
            )->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Email'
            )->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Message'
            )->addColumn(
                'reply',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Edit'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                [],
                'Status'
            );


        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }

}
