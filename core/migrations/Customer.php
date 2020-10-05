<?php

namespace core\migrations;


use yii\db\Migration;

class Customer
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%customers}}', [
            'id' => $this->migration->primaryKey(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'username' => $this->migration->string()->unique(),
            'email' => $this->migration->string()->unique(),
            'name' => $this->migration->string()->notNull(),
            'surname' => $this->migration->string()->null(),
            'middle_name' => $this->migration->string()->null(),
            'birthday' => $this->migration->date()->null(),
            'mob' => $this->migration->string()->null(),
            'phone' => $this->migration->string()->null(),
            'location_id' => $this->migration->string()->null(),
            'country' => $this->migration->string()->null(),
            'city' => $this->migration->string()->null(),
            'address' => $this->migration->string()->notNull(),
            'post' => $this->migration->string()->null(),
            'status' => $this->migration->tinyInteger(1)->notNull()
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%customers}}');
    }
}