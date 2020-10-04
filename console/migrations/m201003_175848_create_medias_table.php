<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medias}}`.
 */
class m201003_175848_create_medias_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%media_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'depth' => $this->integer()->defaultValue(0),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'parent' => $this->integer()->defaultValue(0),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->string()->null(),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%media_category_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'more' => $this->text()->null(),
            'meta_json' => $this->text()->null()
        ]);

        $this->createTable('{{%medias}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'type' => $this->string()->null(),
            'image' => $this->string()->null(),
            'images' => $this->text()->null(),
            'video' => $this->string()->null(),
            'author' => $this->string()->null(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'sort' => $this->integer()->notNull(),
            'see' => $this->integer()->defaultValue(0),
            'is_selected' => $this->tinyInteger(1)->defaultValue(0),
            'user_id' => $this->tinyInteger(4)
        ]);

        $this->createTable('{{%media_lang}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'title' => $this->string()->notNull(),
            'subtitle' => $this->string()->notNull(),
            'slug' => $this->string()->null(),
            'link' => $this->string()->null(),
            'description' => $this->text()->null(),
            'more' => $this->text()->null(),
            'meta_json' => $this->text()->null()
        ]);


        $this->createTable('{{%media_category}}', [
            'category_id' => $this->integer()->notNull(),
            'media_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_media_category_lang',     'media_category_lang',    'model_id', 'media_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_media_lang',     'media_lang',    'model_id', 'medias', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_media_category', 'media_category', 'category_id, media_id');
        $this->addForeignKey('fk_media_category_category',     'media_category',    'category_id', 'media_categories', 'id', 'CASCADE');
        $this->addForeignKey('fk_media_category_media',     'media_category',    'media_id', 'medias', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_media_category_lang', 'media_category_lang');
        $this->dropForeignKey('fk_media_lang', 'media_lang');

        $this->dropForeignKey('fk_media_category_category', 'media_category');
        $this->dropForeignKey('fk_media_category_media', 'media_category');

        $this->dropTable('{{%media_categories}}');
        $this->dropTable('{{%media_category_lang}}');
        $this->dropTable('{{%medias}}');
        $this->dropTable('{{%media_lang}}');
        $this->dropTable('{{%media_category}}');
    }
}
