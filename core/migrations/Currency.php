<?php

namespace core\migrations;


use yii\db\Migration;

class Currency
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%currencies}}', [
            'id' => $this->migration->primaryKey(),
            'alias' => $this->migration->string(32),
            'code' => $this->migration->string(16),
            'icon' => $this->migration->string(),
            'default' => $this->migration->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'value' => $this->migration->double()
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%currencies}}');
    }
}