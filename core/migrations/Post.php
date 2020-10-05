<?php

namespace core\migrations;


use yii\db\Migration;

class Post
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%post_categories}}', [
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

        $this->migration->createTable('{{%post_category_lang}}', [
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

        $this->migration->createTable('{{%posts}}', [
            'id' => $this->migration->primaryKey(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'type' => $this->migration->string()->null(),
            'image' => $this->migration->string()->null(),
            'images' => $this->migration->text()->null(),
            'video' => $this->migration->string()->null(),
            'author' => $this->migration->string()->null(),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'sort' => $this->migration->integer()->notNull(),
            'see' => $this->migration->integer()->defaultValue(0),
            'is_selected' => $this->migration->tinyInteger(1)->defaultValue(0),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%post_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->notNull(),
            'subtitle' => $this->migration->string()->notNull(),
            'slug' => $this->migration->string()->null(),
            'link' => $this->migration->string()->null(),
            'description' => $this->migration->text()->null(),
            'more' => $this->migration->text()->null(),
            'meta_json' => $this->migration->text()->null()
        ]);

        $this->migration->createTable('{{%post_tags}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'count' => $this->migration->integer()->defaultValue(0)
        ]);

        $this->migration->createTable('{{%post_category}}', [
            'category_id' => $this->migration->integer()->notNull(),
            'post_id' => $this->migration->integer()->notNull()
        ]);

        $this->migration->createTable('{{%post_tag}}', [
            'post_id' => $this->migration->integer()->notNull(),
            'tag_id' => $this->migration->integer()->notNull()
        ]);

        $this->migration->addForeignKey('fk_post_category_lang',     'post_category_lang',    'model_id', 'post_categories', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_post_lang',     'post_lang',    'model_id', 'posts', 'id', 'CASCADE');

        $this->migration->addPrimaryKey('pk_post_category', 'post_category', 'category_id, post_id');
        $this->migration->addForeignKey('fk_post_category_category',     'post_category',    'category_id', 'post_categories', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_post_category_post',     'post_category',    'post_id', 'posts', 'id', 'CASCADE');

        $this->migration->addPrimaryKey('pk_post_tag', 'post_tag', 'post_id, tag_id');
        $this->migration->addForeignKey('fk_post_tag_post',     'post_tag',    'post_id', 'posts', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_post_tag_tag',     'post_tag',    'tag_id', 'post_tags', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_post_category_lang', 'post_category_lang');
        $this->migration->dropForeignKey('fk_post_lang', 'post_lang');

        $this->migration->dropForeignKey('fk_post_category_category', 'post_category');
        $this->migration->dropForeignKey('fk_post_category_post', 'post_category');

        $this->migration->dropForeignKey('fk_post_tag_post', 'post_tag');
        $this->migration->dropForeignKey('fk_post_tag_tag', 'post_tag');

        $this->migration->dropTable('{{%post_category}}');
        $this->migration->dropTable('{{%post_tag}}');
        $this->migration->dropTable('{{%post_categories}}');
        $this->migration->dropTable('{{%posts}}');
        $this->migration->dropTable('{{%post_category_lang}}');
        $this->migration->dropTable('{{%post_lang}}');
        $this->migration->dropTable('{{%post_tags}}');
    }
}