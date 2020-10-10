<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Order
 * @package console\models\migrations
 */
class Order extends Migration
{
    public function up()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
            'status' => $this->string()->notNull(),
            'quantity' => $this->smallInteger()->defaultValue(1),
            'subtotal' => $this->double()->defaultValue(0.00),
            'total' => $this->double()->defaultValue(0.00)
        ]);

        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->null(),
            'sku' => $this->string()->notNull(),
            'price' => $this->double()->defaultValue(0.00),
            'quantity' => $this->smallInteger()->defaultValue(1)
        ]);

        $this->createTable('{{%order_payment}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'payment_method' => $this->string()->notNull(),
            'status' => $this->string()->null(),
            'payment_id' => $this->string()->null()
        ]);

        $this->createTable('{{%order_delivery}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'delivery_method' => $this->string(),
            'location_id' => $this->integer()->null(),
            'country' => $this->string()->null(),
            'city' => $this->string()->null(),
            'address' => $this->string()->null(),
            'post' => $this->string()->null(),
            'delivery_price' => $this->string()->null(),
        ]);

        $this->createTable('{{%order_customer}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->null(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->null(),
            'middle_name' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'email' => $this->string()->null()
        ]);

        $this->addForeignKey('fk_order_item',     'order_item',    'order_id', 'orders', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_payment',     'order_payment',    'order_id', 'orders', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_delivery',     'order_delivery',    'order_id', 'orders', 'id', 'CASCADE');
        $this->addForeignKey('fk_order_customer',     'order_customer',    'order_id', 'orders', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_order_item', 'order_item');
        $this->dropForeignKey('fk_order_payment', 'order_payment');
        $this->dropForeignKey('fk_order_delivery', 'order_delivery');
        $this->dropForeignKey('fk_order_customer', 'order_customer');

        $this->dropTable('{{%order_customer}}');
        $this->dropTable('{{%order_delivery}}');
        $this->dropTable('{{%order_payment}}');
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%orders}}');
    }
}