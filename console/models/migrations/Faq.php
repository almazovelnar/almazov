<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Faq
 * @package console\models\migrations
 */
class Faq extends Migration
{
    public function up()
    {
        $this->createTable('{{%faqs}}', [
            'id' => $this->primaryKey(),
            'question' => $this->string(),
            'answer' => $this->string(),
            'language' => $this->string(16)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->tinyInteger(4)
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%faqs}}');
    }
}