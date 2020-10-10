<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Project
 * @package console\models\migrations
 */
class Project extends Migration
{
    public function up()
    {
        $this->createTable('{{%project_categories}}', [
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

        $this->createTable('{{%project_category_lang}}', [
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

        $this->createTable('{{%projects}}', [
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

        $this->createTable('{{%project_lang}}', [
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


        $this->createTable('{{%project_category}}', [
            'category_id' => $this->integer()->notNull(),
            'project_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_project_category_lang',     'project_category_lang',    'model_id', 'project_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_project_lang',     'project_lang',    'model_id', 'projects', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_project_category', 'project_category', 'category_id, project_id');
        $this->addForeignKey('fk_project_category_category',     'project_category',    'category_id', 'project_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_project_category_project',     'project_category',    'project_id', 'projects', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_project_category_lang', 'project_category_lang');
        $this->dropForeignKey('fk_project_lang', 'project_lang');

        $this->dropForeignKey('fk_project_category_category', 'project_category');
        $this->dropForeignKey('fk_project_category_project', 'project_category');

        $this->dropTable('{{%project_categories}}');
        $this->dropTable('{{%project_category_lang}}');
        $this->dropTable('{{%projects}}');
        $this->dropTable('{{%project_lang}}');
        $this->dropTable('{{%project_category}}');
    }
}