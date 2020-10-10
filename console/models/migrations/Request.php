<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Request
 * @package console\models\migrations
 */
class Request extends Migration
{
    public function up()
    {
        $this->createTable('{{%requests}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->null(),
            'middle_name' => $this->string()->null(),
            'file' => $this->string()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->string(),
            'message' => $this->text(),
            'email' => $this->string()->null(),
            'phone' => $this->string()->null()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%requests}}');
    }
}