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
            'status' => $this->tinyInteger(1)->notNull()
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
