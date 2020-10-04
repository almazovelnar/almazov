<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m201003_175616_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_categories}}', [
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

        $this->createTable('{{%service_category_lang}}', [
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

        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'type' => $this->string()->null(),
            'image' => $this->string()->null(),
            'images' => $this->text()->null(),
            'video' => $this->string()->null(),
            'author' => $this->string()->null(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%service_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string()->notNull(),
            'slug' => $this->string()->null(),
            'link' => $this->string()->null(),
            'description' => $this->text()->null(),
            'more' => $this->text()->null(),
            'meta_json' => $this->text()->null()
        ]);


        $this->createTable('{{%service_category}}', [
            'category_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_service_category_lang',     'service_category_lang',    'model_id', 'service_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_service_lang',     'service_lang',    'model_id', 'services', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_service_category', 'service_category', 'category_id, service_id');
        $this->addForeignKey('fk_service_category_category',     'service_category',    'category_id', 'service_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_service_category_service',     'service_category',    'service_id', 'services', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_service_category_lang', 'service_category_lang');
        $this->dropForeignKey('fk_service_lang', 'service_lang');

        $this->dropForeignKey('fk_service_category_category', 'service_category');
        $this->dropForeignKey('fk_service_category_service', 'service_category');

        $this->dropTable('{{%service_categories}}');
        $this->dropTable('{{%service_category_lang}}');
        $this->dropTable('{{%services}}');
        $this->dropTable('{{%service_lang}}');
    }
}
