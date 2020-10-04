<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacancies}}`.
 */
class m201003_175338_create_vacancies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancies}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'sort' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%vacancy_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->null(),
            'subtitle' => $this->string()->null(),
            'description' => $this->text()->null(),
            'more' => $this->text()->null(),
            'meta_json' => $this->text()->null()
        ]);

        $this->addForeignKey('fk_vacancy_lang',     'vacancy_lang',    'model_id', 'vacancies', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_vacancy_lang', 'vacancy_lang');

        $this->dropTable('{{%vacancy_lang}}');
        $this->dropTable('{{%vacancies}}');
    }
}
