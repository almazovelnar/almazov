<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faqs}}`.
 */
class m201003_173136_create_faqs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%faqs}}');
    }
}
