<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%languages}}`.
 */
class m201003_173015_create_languages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%languages}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'alias' => $this->string(16)->notNull(),
            'image' => $this->string()->null(),
            'sort' => $this->smallInteger(),
            'default' => $this->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'code' => $this->string(16)->null(),
            'user_id' => $this->tinyInteger(4)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%languages}}');
    }
}
