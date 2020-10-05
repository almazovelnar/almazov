<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class CvRequest
 * @package console\models\migrations
 */
class CvRequest extends Migration
{
    public function up()
    {
        $this->createTable('{{%cv_requests}}', [
            'id' => $this->primaryKey(),
            'vacancy_id' => $this->integer()->null(),
            'vacancy_name' => $this->string()->null(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->null(),
            'middle_name' => $this->string()->null(),
            'file' => $this->string()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->string(),
            'message' => $this->text(),
            'email' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'birthday' => $this->string()->null(),
            'address' => $this->string()->null(),
            'country' => $this->string()->null(),
            'city' => $this->string()->null()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%cv_requests}}');
    }
}