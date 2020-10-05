<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Slider
 * @package console\models\migrations
 */
class Slider extends Migration
{
    public function up()
    {
        $this->createTable('{{%sliders}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'image' => $this->string(),
            'sort' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%slider_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->null(),
            'subtitle' => $this->string()->null(),
            'description' => $this->text()->null(),
            'more' => $this->text()->null(),
            'link' => $this->string()->null(),
            'lang_image' => $this->string()
        ]);

        $this->addForeignKey('fk_slider_lang',     'slider_lang',    'model_id', 'sliders', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_slider_lang', 'slider_lang');

        $this->dropTable('{{%sliders}}');
        $this->dropTable('{{%slider_lang}}');
    }
}