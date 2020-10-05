<?php

namespace core\migrations;


use yii\db\Migration;

class Project
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%project_categories}}', [
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

        $this->migration->createTable('{{%project_category_lang}}', [
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

        $this->migration->createTable('{{%projects}}', [
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

        $this->migration->createTable('{{%project_lang}}', [
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


        $this->migration->createTable('{{%project_category}}', [
            'category_id' => $this->migration->integer()->notNull(),
            'project_id' => $this->migration->integer()->notNull()
        ]);

        $this->migration->addForeignKey('fk_project_category_lang',     'project_category_lang',    'model_id', 'project_categories', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_project_lang',     'project_lang',    'model_id', 'projects', 'id', 'CASCADE');

        $this->migration->addPrimaryKey('pk_project_category', 'project_category', 'category_id, project_id');
        $this->migration->addForeignKey('fk_project_category_category',     'project_category',    'category_id', 'project_categories', 'id', 'CASCADE');
        $this->migration->addForeignKey('fk_project_category_project',     'project_category',    'project_id', 'projects', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_project_category_lang', 'project_category_lang');
        $this->migration->dropForeignKey('fk_project_lang', 'project_lang');

        $this->migration->dropForeignKey('fk_project_category_category', 'project_category');
        $this->migration->dropForeignKey('fk_project_category_project', 'project_category');

        $this->migration->dropTable('{{%project_categories}}');
        $this->migration->dropTable('{{%project_category_lang}}');
        $this->migration->dropTable('{{%projects}}');
        $this->migration->dropTable('{{%project_lang}}');
        $this->migration->dropTable('{{%project_category}}');
    }
}