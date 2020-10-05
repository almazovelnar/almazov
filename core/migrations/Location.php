<?php

namespace core\migrations;

use yii\db\Migration;

class Location
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%locations}}', [
            'id' => $this->migration->primaryKey(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'sort' => $this->migration->integer()->notNull(),
            'longitude' => $this->migration->string()->null(),
            'latitude' => $this->migration->string()->null(),
            'phones' => $this->migration->string()->null(),
            'emails' => $this->migration->string()->null(),
            'slug' => $this->migration->string()->notNull(),
            'fax' => $this->migration->string()->null(),
            'status' => $this->migration->tinyInteger(1)->notNull(),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%location_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->notNull(),
            'address' => $this->migration->text()->null(),
        ]);

        $this->migration->addForeignKey('fk_location_lang',     'location_lang',    'model_id', 'locations', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_location_lang', 'location_lang');

        $this->migration->dropTable('{{%location_lang}}');
        $this->migration->dropTable('{{%locations}}');
    }
}