<?php

namespace core\migrations;


use yii\db\Migration;

class Vacancy
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%vacancies}}', [
            'id' => $this->migration->primaryKey(),
            'image' => $this->migration->string(),
            'sort' => $this->migration->integer()->notNull(),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%vacancy_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->null(),
            'subtitle' => $this->migration->string()->null(),
            'description' => $this->migration->text()->null(),
            'more' => $this->migration->text()->null(),
            'meta_json' => $this->migration->text()->null()
        ]);

        $this->migration->addForeignKey('fk_vacancy_lang',     'vacancy_lang',    'model_id', 'vacancies', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_vacancy_lang', 'vacancy_lang');

        $this->migration->dropTable('{{%vacancy_lang}}');
        $this->migration->dropTable('{{%vacancies}}');
    }
}