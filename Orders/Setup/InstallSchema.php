<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {


        // $installer = $setup;
        // $installer->startSetup();

        /**
         * Create table 'codelegacy_orders'
         */
        // $table = $installer->getConnection()->newTable($installer->getTable('codelegacy_orders'))
        // ->addColumn(
        //         'codelegacy_orders_id',
        //         \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
        //         null,
        //         ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
        //         'Orders ID'
        //     )
        // ->addColumn(
        //     'customer_id',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
        //     255,
        //     [],
        //     'Customer ID'
        // )
        // ->addColumn(
        //     'customer_name',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        //     255,
        //     [],
        //     'Customer Name'
        // )
        // ->addColumn(
        //     'customer_email',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        //     255,
        //     [],
        //     'Customer Email'
        // )
        // ->addColumn(
        //     'product_id',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        //     255,
        //     [],
        //     'Product ID'
        // )
        // ->addColumn(
        //     'product_details',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        //     [],
        //     'Product Details'
        // )
        // ->addColumn(
        //     'custom_design',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        //     [],
        //     'Custom Design'
        // )
        // ->addColumn(
        //     'created_at',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
        //     null,
        //     ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
        //     'Created At'
        // )
        // ->addColumn(
        //         'updated_at',
        //         \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
        //         null,
        //         ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
        //         'Updated At'
        // )
        // ->addColumn(
        //     'status',
        //     \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        //     255,
        //     [],
        //     'Status'
        // );
        //
        //
        // $installer->getConnection()->createTable($table);
        // $installer->endSetup();


        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'codelegacy_color'
         */
        $table = $installer->getConnection()->newTable($installer->getTable('codelegacy_orders'))
            ->addColumn(
                'codelegacy_orders_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Color ID'
            )
            ->addColumn(
                'order_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Order ID'
            )
        ->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Customer ID'
        )
        ->addColumn(
            'customer_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
            255,
            [],
            'Customer Name'
        )
        ->addColumn(
            'customer_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Customer EMail'
        )
        ->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Product ID'
        )
        ->addColumn(
            'product_details',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Product Details'
        )
        ->addColumn(
            'custom_design',
            \Magento\Framework\DB\Ddl\Table::TYPE_LONGTEXT,
            255,
            [],
            'Custom Design'
        )
        ->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Created At'
        )
        ->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
        )
        ->addColumn(
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
