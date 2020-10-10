<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Currency
 * @package console\models\migrations
 */
class Currency extends Migration
{
    public function up()
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey(),
            'alias' => $this->string(32),
            'code' => $this->string(16),
            'icon' => $this->string(),
            'default' => $this->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'value' => $this->double()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%currencies}}');
    }
}