<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Customer
 * @package console\models\migrations
 */
class Customer extends Migration
{
    public function up()
    {
        $this->createTable('{{%customers}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'username' => $this->string()->unique(),
            'email' => $this->string()->unique(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->null(),
            'middle_name' => $this->string()->null(),
            'birthday' => $this->date()->null(),
            'mob' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'location_id' => $this->string()->null(),
            'country' => $this->string()->null(),
            'city' => $this->string()->null(),
            'address' => $this->string()->notNull(),
            'post' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%customers}}');
    }
}