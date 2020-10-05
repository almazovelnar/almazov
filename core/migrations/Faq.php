<?php

namespace core\migrations;


use yii\db\Migration;

class Faq
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%faqs}}', [
            'id' => $this->migration->primaryKey(),
            'question' => $this->migration->string(),
            'answer' => $this->migration->string(),
            'language' => $this->migration->string(16)->notNull(),
            'created_at' => $this->migration->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->migration->tinyInteger(4)
        ]);
    }

    public function down()
    {
        $this->migration->dropTable('{{%faqs}}');
    }
}