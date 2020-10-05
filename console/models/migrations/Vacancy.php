<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Vacancy
 * @package console\models\migrations
 */
class Vacancy extends Migration
{
    public function up()
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

    public function down()
    {
        $this->dropForeignKey('fk_vacancy_lang', 'vacancy_lang');

        $this->dropTable('{{%vacancy_lang}}');
        $this->dropTable('{{%vacancies}}');
    }
}