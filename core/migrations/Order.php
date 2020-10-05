<?php

namespace core\migrations;

use yii\db\Migration;

class Order
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%orders}}', [
            'id' => $this->migration->primaryKey(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->migration->timestamp()->null(),
            'status' => $this->migration->string()->notNull(),
            'quantity' => $this->migration->smallInteger()->defaultValue(1),
            'subtotal' => $this->migration->double()->defaultValue(0.00),
            'total' => $this->migration->double()->defaultValue(0.00)
        ]);

        $this->migration->createTable('{{%order_item}}', [
            'id' => $this->migration->primaryKey(),
            'order_id' => $this->migration->integer()->notNull(),
            'product_id' => $this->migration->integer()->notNull(),
            'name' => $this->migration->string()->null(),
            'sku' => $this->migration->string()->notNull(),
            'price' => $this->migration->double()->defaultValue(0.00),
            'quantity' => $this->migration->smallInteger()->defaultValue(1)
        ]);

        $this->migration->createTable('{{%order_payment}}', [
            'id' => $this->migration->primaryKey(),
            'order_id' => $this->migration->integer()->notNull(),
            'payment_method' => $this->migration->string()->notNull(),
            'status' => $this->migration->string()->null(),
            'payment_id' => $this->migration->string()->null()
        ]);

        $this->migration->createTable('{{%order_delivery}}', [
            'id' => $this->migration->primaryKey(),
            'order_id' => $this->migration->integer()->notNull(),
            'delivery_method' => $this->migration->string(),
            'location_id' => $this->migration->integer()->null(),
            'country' => $this->migration->string()->null(),
            'city' => $this->migration->string()->null(),
            'address' => $this->migration->string()->null(),
            'post' => $this->migration->string()->null(),
            'delivery_price' => $this->migration->string()->null(),
        ]);

        $this->migration->createTable('{{%order_customer}}', [
            'id' => $this->migration->primaryKey(),
            'order_id' => $this->migration->integer()->notNull(),
            'customer_id' => $this->migration->integer()->null(),
            'name' => $this->migration->string()->notNull(),
            'surname' => $this->migration->string()->null(),
            'middle_name' => $this->migration->string()->null(),
            'phone' => $this->migration->string()->null(),
            'email' => $this->migration->string()->null()
        ]);

        $this->migration->addForeignKey('fk_order_item',     'order_item',    'order_id', 'orders', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_order_payment',     'order_payment',    'order_id', 'orders', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_order_delivery',     'order_delivery',    'order_id', 'orders', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_order_customer',     'order_customer',    'order_id', 'orders', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_order_item', 'order_item');
        $this->migration->dropForeignKey('fk_order_payment', 'order_payment');
        $this->migration->dropForeignKey('fk_order_delivery', 'order_delivery');
        $this->migration->dropForeignKey('fk_order_customer', 'order_customer');

        $this->migration->dropTable('{{%order_customer}}');
        $this->migration->dropTable('{{%order_delivery}}');
        $this->migration->dropTable('{{%order_payment}}');
        $this->migration->dropTable('{{%order_item}}');
        $this->migration->dropTable('{{%orders}}');
    }
}