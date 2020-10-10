<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Partner
 * @package console\models\migrations
 */
class Partner extends Migration
{
    public function up()
    {
        $this->createTable('{{%partners}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'sort' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%partner_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->null(),
            'subtitle' => $this->string()->null(),
            'description' => $this->text()->null(),
            'link' => $this->string()->null(),
            'meta_json' => $this->text()->null()
        ]);

        $this->addForeignKey('fk_partner_lang',     'partner_lang',    'model_id', 'partners', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_partner_lang', 'partner_lang');

        $this->dropTable('{{%partner_lang}}');
        $this->dropTable('{{%partners}}');
    }
}