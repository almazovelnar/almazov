<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Location
 * @package console\models\migrations
 */
class Location extends Migration
{
    public function up()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'sort' => $this->integer()->notNull(),
            'longitude' => $this->string()->null(),
            'latitude' => $this->string()->null(),
            'phones' => $this->string()->null(),
            'emails' => $this->string()->null(),
            'slug' => $this->string()->notNull(),
            'fax' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->notNull(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%location_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->notNull(),
            'address' => $this->text()->null(),
        ]);

        $this->addForeignKey('fk_location_lang',     'location_lang',    'model_id', 'locations', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_location_lang', 'location_lang');

        $this->dropTable('{{%location_lang}}');
        $this->dropTable('{{%locations}}');
    }
}