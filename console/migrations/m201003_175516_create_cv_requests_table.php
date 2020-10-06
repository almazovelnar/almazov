<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cv_requests}}`.
 */
class m201003_175516_create_cv_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cv_requests}}', [
            'id' => $this->primaryKey(),
            'vacancy_id' => $this->integer()->null(),
            'vacancy_name' => $this->string()->null(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->null(),
            'middle_name' => $this->string()->null(),
            'file' => $this->string()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'status' => $this->string(),
            'message' => $this->text(),
            'email' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'birthday' => $this->string()->null(),
            'address' => $this->string()->null(),
            'country' => $this->string()->null(),
            'city' => $this->string()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cv_requests}}');
    }
}
