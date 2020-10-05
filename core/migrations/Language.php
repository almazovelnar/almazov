<?php

namespace core\migrations;


use yii\db\Migration;

class Language
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%languages}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string(32)->notNull(),
            'alias' => $this->migration->string(16)->notNull(),
            'image' => $this->migration->string()->null(),
            'sort' => $this->migration->smallInteger(),
            'default' => $this->migration->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'code' => $this->migration->string(16)->null(),
            'user_id' => $this->migration->tinyInteger(4)
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%languages}}');
    }
}