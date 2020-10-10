<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Page
 * @package console\models\migrations
 */
class Page extends Migration
{
    public function up()
    {
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'depth' => $this->integer()->defaultValue(0),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'parent' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'module' => $this->string()->notNull(),
            'image' => $this->string()->null(),
            'images' => $this->text()->null(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%page_lang}}', [
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

        $this->addForeignKey('fk_page_lang',     'page_lang',    'model_id', 'pages', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_page_lang', 'page_lang');

        $this->dropTable('{{%page_lang}}');
        $this->dropTable('{{%pages}}');
    }
}