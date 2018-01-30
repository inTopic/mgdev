<?php
/** @var Mage_Core_Model_Resource_Setup $this */
die();
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('sendpulseintegration/session'))
    ->addColumn(
        'session_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'primary'  => true,
    ), 'session id'
    )
    ->addColumn('api_id', Varien_Db_Ddl_Table::TYPE_TEXT, null, array('nullable' => false), 'api id')
    ->addColumn('secret_key', Varien_Db_Ddl_Table::TYPE_TEXT, null, array('nullable' => false), 'secret key')
    ->addColumn('expired', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array('default' => 0), 'expired');

$installer->getConnection()->createTable($table);

$installer->endSetup();