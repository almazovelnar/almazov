<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customers}}`.
 */
class m201003_134523_create_customers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customers}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'username' => $this->string()->unique(),
            'email' => $this->string()->unique(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->null(),
            'middle_name' => $this->string()->null(),
            'birthday' => $this->date()->null(),
            'mob' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'location_id' => $this->string()->null(),
            'country' => $this->string()->null(),
            'city' => $this->string()->null(),
            'address' => $this->string()->notNull(),
            'post' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customers}}');
    }
}
