<?php

namespace core\migrations;


use yii\db\Migration;

class CvRequest
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%cv_requests}}', [
            'id' => $this->migration->primaryKey(),
            'vacancy_id' => $this->migration->integer()->null(),
            'vacancy_name' => $this->migration->string()->null(),
            'name' => $this->migration->string()->notNull(),
            'surname' => $this->migration->string()->null(),
            'middle_name' => $this->migration->string()->null(),
            'file' => $this->migration->string()->null(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->migration->string(),
            'message' => $this->migration->text(),
            'email' => $this->migration->string()->null(),
            'phone' => $this->migration->string()->null(),
            'birthday' => $this->migration->string()->null(),
            'address' => $this->migration->string()->null(),
            'country' => $this->migration->string()->null(),
            'city' => $this->migration->string()->null()
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%cv_requests}}');
    }
}