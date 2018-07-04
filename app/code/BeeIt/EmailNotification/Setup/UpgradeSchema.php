<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7/3/2018
 * Time: 11:32 AM
 */
namespace BeeIt\EmailNotification\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ){

        $installer =$setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '0.1.9') < 0) {
                $installer->getConnection()->addColumn(
                    $installer->getTable('product_alert_stock'),
                    'customer_email',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 50,
                        'nullable' => true,
                        'comment' => 'Customer registration email'
                    ]
                );

                $installer->getConnection()->dropForeignKey(
                    $installer->getTable('product_alert_stock'),
                    'customer_id'
                );
                $installer->getConnection()->addForeignKey(
                    $installer->getFkName('product_alert_stock', 'customer_email', 'customer_entity', 'email'),
                    $installer->getTable('product_alert_stock'),
                    'customer_email',
                    $installer->getTable('customer_entity'),
                    'email',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                );


                $installer->getConnection()->dropForeignKey(
                    $installer->getTable('product_alert_stock'),
                    $installer->getFkName('customer_entity', 'entity_id', 'product_alert_stock', 'customer_id')
                );

        } else {
            $installer->getConnection()->changeColumn(
                $installer->getTable('product_alert_stock'),
                'customer_id',
                'customer_id',
                ['nullable' => true]
            );
        }
        $installer->endSetup();

    }




}