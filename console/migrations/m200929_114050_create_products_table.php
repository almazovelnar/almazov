<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m200929_114050_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'depth' => $this->integer()->defaultValue(0),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'parent' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->string()->null(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%product_category_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'more' => $this->text()->null(),
            'meta_json' => $this->text()->null()
        ]);

        $this->createTable('{{%product_brands}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'depth' => $this->integer()->defaultValue(0),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'parent' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->string()->null(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%product_brand_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'meta_json' => $this->text()->null()
        ]);

        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->null(),
            'sku' => $this->string()->unique()->notNull(),
            'price' => $this->double()->defaultValue(0.00),
            'sale_price' => $this->double()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_author' => $this->integer()->notNull(),
            'sort' => $this->integer()->notNull(),
            'quantity' => $this->integer()->defaultValue(1),
            'see' => $this->integer()->defaultValue(0),
            'sell' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%product_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->null(),
            'subtitle' => $this->string()->null(),
            'slug' => $this->string()->null(),
            'description' => $this->text()->null(),
            'more' => $this->text()->null(),
            'meta_json' => $this->text()->null()
        ]);

        $this->createTable('{{%product_category}}', [
            'category_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);

        $this->createTable('{{%product_brand}}', [
            'brand_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_category_lang',     'product_category_lang',    'model_id', 'product_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_brand_lang',     'product_brand_lang',    'model_id', 'product_brands', 'id', 'CASCADE');
        $this->addForeignKey('fk_product_lang',     'product_lang',    'model_id', 'products', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_product_category', 'product_category', 'category_id, product_id');
        $this->addForeignKey('fk_product_category_category',     'product_category',    'category_id', 'product_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_product_category_product',     'product_category',    'product_id', 'products', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_product_brand', 'product_brand', 'brand_id, product_id');
        $this->addForeignKey('fk_product_brand_brand',     'product_brand',    'brand_id', 'product_brands', 'id', 'CASCADE');
        $this->addForeignKey('fk_product_brand_product',     'product_brand',    'product_id', 'products', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_category_lang', 'product_category_lang');
        $this->dropForeignKey('fk_brand_lang', 'product_brand_lang');
        $this->dropForeignKey('fk_product_lang', 'product_lang');

        $this->dropForeignKey('fk_product_category_category', 'product_category');
        $this->dropForeignKey('fk_product_category_product', 'product_category');

        $this->dropForeignKey('fk_product_brand_brand', 'product_brand');
        $this->dropForeignKey('fk_product_brand_product', 'product_brand');

        $this->dropTable('{{%product_category_lang}}');
        $this->dropTable('{{%product_categories}}');
        $this->dropTable('{{%product_brand_lang}}');
        $this->dropTable('{{%product_brands}}');
        $this->dropTable('{{%product_lang}}');
        $this->dropTable('{{%products}}');
        $this->dropTable('{{%product_category}}');
    }
}
