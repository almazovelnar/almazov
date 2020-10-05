<?php

namespace core\migrations;


use yii\db\Migration;

class Page
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%pages}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string()->notNull(),
            'depth' => $this->migration->integer()->defaultValue(0),
            'lft' => $this->migration->integer()->notNull(),
            'rgt' => $this->migration->integer()->notNull(),
            'parent' => $this->migration->integer()->defaultValue(0),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'module' => $this->migration->string()->notNull(),
            'image' => $this->migration->string()->null(),
            'images' => $this->migration->text()->null(),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%page_lang}}', [
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

        $this->migration->addForeignKey('fk_page_lang',     'page_lang',    'model_id', 'pages', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_page_lang', 'page_lang');

        $this->migration->dropTable('{{%page_lang}}');
        $this->migration->dropTable('{{%pages}}');
    }
}