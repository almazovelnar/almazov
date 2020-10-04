<?php

namespace core\migrations;

use yii\db\Migration;

/**
 * Class Product
 * @package core\migrations
 */
class Product
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->migration->createTable('{{%product_categories}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string()->notNull(),
            'depth' => $this->migration->integer()->defaultValue(0),
            'lft' => $this->migration->integer()->notNull(),
            'rgt' => $this->migration->integer()->notNull(),
            'parent' => $this->migration->integer()->defaultValue(0),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->migration->string()->null(),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%product_category_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->notNull(),
            'subtitle' => $this->migration->string()->notNull(),
            'slug' => $this->migration->string()->notNull(),
            'description' => $this->migration->text()->null(),
            'more' => $this->migration->text()->null(),
            'meta_json' => $this->migration->text()->null()
        ]);

        $this->migration->createTable('{{%product_brands}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string()->notNull(),
            'depth' => $this->migration->integer()->defaultValue(0),
            'lft' => $this->migration->integer()->notNull(),
            'rgt' => $this->migration->integer()->notNull(),
            'parent' => $this->migration->integer()->defaultValue(0),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->migration->string()->null(),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%product_brand_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->notNull(),
            'slug' => $this->migration->string()->notNull(),
            'description' => $this->migration->text()->null(),
            'meta_json' => $this->migration->text()->null()
        ]);

        $this->migration->createTable('{{%products}}', [
            'id' => $this->migration->primaryKey(),
            'image' => $this->migration->string()->null(),
            'sku' => $this->migration->string()->unique()->notNull(),
            'price' => $this->migration->double()->defaultValue(0.00),
            'sale_price' => $this->migration->double()->null(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_author' => $this->migration->integer()->notNull(),
            'sort' => $this->migration->integer()->notNull(),
            'quantity' => $this->migration->integer()->defaultValue(1),
            'see' => $this->migration->integer()->defaultValue(0),
            'sell' => $this->migration->integer()->defaultValue(0),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%product_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->null(),
            'subtitle' => $this->migration->string()->null(),
            'slug' => $this->migration->string()->null(),
            'description' => $this->migration->text()->null(),
            'more' => $this->migration->text()->null(),
            'meta_json' => $this->migration->text()->null()
        ]);

        $this->migration->createTable('{{%product_category}}', [
            'category_id' => $this->migration->integer()->notNull(),
            'product_id' => $this->migration->integer()->notNull()
        ]);

        $this->migration->createTable('{{%product_brand}}', [
            'brand_id' => $this->migration->integer()->notNull(),
            'product_id' => $this->migration->integer()->notNull()
        ]);

        $this->migration->addForeignKey('fk_category_lang',     'product_category_lang',    'model_id', 'product_categories', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_brand_lang',     'product_brand_lang',    'model_id', 'product_brands', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_product_lang',     'product_lang',    'model_id', 'products', 'id', 'CASCADE');

        $this->migration->addPrimaryKey('pk_product_category', 'product_category', 'category_id, product_id');
        $this->migration->addForeignKey('fk_product_category_category',     'product_category',    'category_id', 'product_categories', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_product_category_product',     'product_category',    'product_id', 'products', 'id', 'CASCADE');

        $this->migration->addPrimaryKey('pk_product_brand', 'product_brand', 'brand_id, product_id');
        $this->migration->addForeignKey('fk_product_brand_brand',     'product_brand',    'brand_id', 'product_brands', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_product_brand_product',     'product_brand',    'product_id', 'products', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->migration->dropForeignKey('fk_category_lang', 'product_category_lang');
        $this->migration->dropForeignKey('fk_brand_lang', 'product_brand_lang');
        $this->migration->dropForeignKey('fk_product_lang', 'product_lang');

        $this->migration->dropForeignKey('fk_product_category_category', 'product_category');
        $this->migration->dropForeignKey('fk_product_category_product', 'product_category');

        $this->migration->dropForeignKey('fk_product_brand_brand', 'product_brand');
        $this->migration->dropForeignKey('fk_product_brand_product', 'product_brand');

        $this->migration->dropTable('{{%product_category_lang}}');
        $this->migration->dropTable('{{%product_categories}}');
        $this->migration->dropTable('{{%product_brand_lang}}');
        $this->migration->dropTable('{{%product_brands}}');
        $this->migration->dropTable('{{%product_lang}}');
        $this->migration->dropTable('{{%products}}');
        $this->migration->dropTable('{{%product_category}}');
        $this->migration->dropTable('{{%product_brand}}');
    }
}