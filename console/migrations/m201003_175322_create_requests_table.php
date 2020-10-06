<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%requests}}`.
 */
class m201003_175322_create_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%requests}}');
    }
}
