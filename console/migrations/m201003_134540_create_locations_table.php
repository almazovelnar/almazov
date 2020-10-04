<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%locations}}`.
 */
class m201003_134540_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'sort' => $this->integer()->notNull(),
            'longitude' => $this->string()->null(),
            'latitude' => $this->string()->null(),
            'phones' => $this->string()->null(),
            'emails' => $this->string()->null(),
            'slug' => $this->string()->notNull(),
            'fax' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->notNull(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%location_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->notNull(),
            'address' => $this->text()->null(),
        ]);

        $this->addForeignKey('fk_location_lang',     'location_lang',    'model_id', 'locations', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_location_lang', 'location_lang');

        $this->dropTable('{{%location_lang}}');
        $this->dropTable('{{%locations}}');
    }
}
