<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Config
 * @package console\models\migrations
 */
class Config extends Migration
{
    public function up()
    {
        $this->createTable('{{%configs}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'value' => $this->string()->null(),
            'label' => $this->string()->null()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%configs}}');
    }
}