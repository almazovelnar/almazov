<?php

namespace core\migrations;


use yii\db\Migration;

class Slider
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%sliders}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string(),
            'image' => $this->migration->string(),
            'sort' => $this->migration->integer()->notNull(),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%slider_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->null(),
            'subtitle' => $this->migration->string()->null(),
            'description' => $this->migration->text()->null(),
            'more' => $this->migration->text()->null(),
            'link' => $this->migration->string()->null(),
            'lang_image' => $this->migration->string()
        ]);

        $this->migration->addForeignKey('fk_slider_lang',     'slider_lang',    'model_id', 'sliders', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_slider_lang', 'slider_lang');

        $this->migration->dropTable('{{%sliders}}');
        $this->migration->dropTable('{{%slider_lang}}');
    }
}