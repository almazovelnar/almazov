<?php

namespace core\migrations;


use yii\db\Migration;

class Translate
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%translates}}', [
            'id' => $this->migration->primaryKey(),
            'code' => $this->migration->string()->notNull(),
            'translate' => $this->migration->string()->null(),
            'status' => $this->migration->tinyInteger(1)->notNull()
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%translates}}');
    }
}