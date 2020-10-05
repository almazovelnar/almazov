<?php

namespace core\migrations;

use yii\db\Migration;

class MainInfo
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%main_info}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string()->notNull(),
            'longitude' => $this->migration->string()->null(),
            'latitude' => $this->migration->string()->null(),
            'phones' => $this->migration->string()->null(),
            'emails' => $this->migration->string()->null(),
            'fax' => $this->migration->string()->null(),
            'logo' => $this->migration->string()->null(),
            'second_logo' => $this->migration->string()->null(),
            'favicon' => $this->migration->string()->null()
        ]);

        $this->migration->createTable('{{%main_info_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->null(),
            'description' => $this->migration->text()->null(),
            'address' => $this->migration->text()->null(),
            'meta_json' => $this->migration->text()->null(),
        ]);

        $this->migration->addForeignKey('fk_main_info_lang',     'main_info_lang',    'model_id', 'main_info', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_main_info_lang', 'main_info_lang');

        $this->migration->dropTable('{{%main_info_lang}}');
        $this->migration->dropTable('{{%main_info}}');
    }
}