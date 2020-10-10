<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Post
 * @package console\models\migrations
 */
class Post extends Migration
{
    public function up()
    {
        $this->createTable('{{%post_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'depth' => $this->integer()->defaultValue(0),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'parent' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->string()->null(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%post_category_lang}}', [
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

        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'type' => $this->string()->null(),
            'image' => $this->string()->null(),
            'images' => $this->text()->null(),
            'video' => $this->string()->null(),
            'author' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'sort' => $this->integer()->notNull(),
            'see' => $this->integer()->defaultValue(0),
            'is_selected' => $this->tinyInteger(1)->defaultValue(0),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%post_lang}}', [
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

        $this->createTable('{{%post_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'language' => $this->string(16)->notNull(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'count' => $this->integer()->defaultValue(0)
        ]);

        $this->createTable('{{%post_category}}', [
            'category_id' => $this->integer()->notNull(),
            'post_id' => $this->integer()->notNull()
        ]);

        $this->createTable('{{%post_tag}}', [
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_post_category_lang',     'post_category_lang',    'model_id', 'post_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_post_lang',     'post_lang',    'model_id', 'posts', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_post_category', 'post_category', 'category_id, post_id');
        $this->addForeignKey('fk_post_category_category',     'post_category',    'category_id', 'post_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_post_category_post',     'post_category',    'post_id', 'posts', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_post_tag', 'post_tag', 'post_id, tag_id');
        $this->addForeignKey('fk_post_tag_post',     'post_tag',    'post_id', 'posts', 'id', 'CASCADE');
        $this->addForeignKey('fk_post_tag_tag',     'post_tag',    'tag_id', 'post_tags', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_post_category_lang', 'post_category_lang');
        $this->dropForeignKey('fk_post_lang', 'post_lang');

        $this->dropForeignKey('fk_post_category_category', 'post_category');
        $this->dropForeignKey('fk_post_category_post', 'post_category');

        $this->dropForeignKey('fk_post_tag_post', 'post_tag');
        $this->dropForeignKey('fk_post_tag_tag', 'post_tag');

        $this->dropTable('{{%post_category}}');
        $this->dropTable('{{%post_tag}}');
        $this->dropTable('{{%post_categories}}');
        $this->dropTable('{{%posts}}');
        $this->dropTable('{{%post_category_lang}}');
        $this->dropTable('{{%post_lang}}');
        $this->dropTable('{{%post_tags}}');
    }
}