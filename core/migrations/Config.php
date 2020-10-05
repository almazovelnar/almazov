<?php

namespace core\migrations;

use yii\db\Migration;

class Config
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%configs}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string()->notNull(),
            'value' => $this->migration->string()->null(),
            'label' => $this->migration->string()->null()
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%configs}}');
    }
}