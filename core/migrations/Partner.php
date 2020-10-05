<?php


namespace core\migrations;


use yii\db\Migration;

class Partner
{
    private $migration;

    public function __construct(Migration $migration)
    {
        $this->migration = $migration;
    }

    public function up()
    {
        $this->migration->createTable('{{%partners}}', [
            'id' => $this->migration->primaryKey(),
            'name' => $this->migration->string()->notNull(),
            'image' => $this->migration->string(),
            'sort' => $this->migration->integer()->notNull(),
            'status' => $this->migration->tinyInteger(1)->defaultValue(1),
            'user_id' => $this->migration->tinyInteger(4)
        ]);

        $this->migration->createTable('{{%partner_lang}}', [
            'id' => $this->migration->primaryKey(),
            'model_id' => $this->migration->integer()->notNull(),
            'language' => $this->migration->string(16)->notNull(),
            'title' => $this->migration->string()->null(),
            'subtitle' => $this->migration->string()->null(),
            'description' => $this->migration->text()->null(),
            'link' => $this->migration->string()->null(),
            'meta_json' => $this->migration->text()->null()
        ]);

        $this->migration->addForeignKey('fk_partner_lang',     'partner_lang',    'model_id', 'partners', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->migration->dropForeignKey('fk_partner_lang', 'partner_lang');

        $this->migration->dropTable('{{%partner_lang}}');
        $this->migration->dropTable('{{%partners}}');
    }
}