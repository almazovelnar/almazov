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
