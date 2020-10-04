<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partners}}`.
 */
class m201003_175227_create_partners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partners}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'sort' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->notNull()
        ]);

        $this->createTable('{{%partner_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->null(),
            'description' => $this->text()->null(),
            'link' => $this->string()->null(),
            'meta_json' => $this->text()->null()
        ]);

        $this->addForeignKey('fk_partner_lang',     'partner_lang',    'model_id', 'partners', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_partner_lang', 'partner_lang');

        $this->dropTable('{{%partner_lang}}');
        $this->dropTable('{{%partners}}');
    }
}
