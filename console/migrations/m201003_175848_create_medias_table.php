<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medias}}`.
 */
class m201003_175848_create_medias_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medias}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%medias}}');
    }
}
