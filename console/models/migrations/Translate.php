<?php

namespace console\models\migrations;


use yii\db\Migration;

/**
 * Class Translate
 * @package console\models\migrations
 */
class Translate extends Migration
{
    public function up()
    {
        $this->createTable('{{%translates}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'translate' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%translates}}');
    }
}