<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class MainInfo
 * @package console\models\migrations
 */
class MainInfo extends Migration
{
    public function up()
    {
        $this->createTable('{{%main_info}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'longitude' => $this->string()->null(),
            'latitude' => $this->string()->null(),
            'phones' => $this->string()->null(),
            'emails' => $this->string()->null(),
            'fax' => $this->string()->null(),
            'logo' => $this->string()->null(),
            'second_logo' => $this->string()->null(),
            'favicon' => $this->string()->null()
        ]);

        $this->createTable('{{%main_info_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->null(),
            'description' => $this->text()->null(),
            'address' => $this->text()->null(),
            'meta_json' => $this->text()->null(),
        ]);

        $this->addForeignKey('fk_main_info_lang',     'main_info_lang',    'model_id', 'main_info', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_main_info_lang', 'main_info_lang');

        $this->dropTable('{{%main_info_lang}}');
        $this->dropTable('{{%main_info}}');
    }
}