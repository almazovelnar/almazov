<?php

namespace core\migrations;


use yii\db\Migration;

class Request
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%requests}}', [
            'id' => $this->migration->primaryKey(),
            'type' => $this->migration->string(),
            'name' => $this->migration->string()->notNull(),
            'surname' => $this->migration->string()->null(),
            'middle_name' => $this->migration->string()->null(),
            'file' => $this->migration->string()->null(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->migration->string(),
            'message' => $this->migration->text(),
            'email' => $this->migration->string()->null(),
            'phone' => $this->migration->string()->null()
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%requests}}');
    }
}