<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Language
 * @package console\models\migrations
 */
class Language extends Migration
{
    public function up()
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

    public function down()
    {
        $this->dropTable('{{%languages}}');
    }
}