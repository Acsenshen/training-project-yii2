<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_tags}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%article}}`
 * - `{{%tags}}`
 */
class m200205_161610_create_article_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_tags}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        // creates index for column `article_id`
        $this->createIndex(
            '{{%idx-article_tags-article_id}}',
            '{{%article_tags}}',
            'article_id'
        );

        // add foreign key for table `{{%article}}`
        $this->addForeignKey(
            '{{%fk-article_tags-article_id}}',
            '{{%article_tags}}',
            'article_id',
            '{{%article}}',
            'id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            '{{%idx-article_tags-tag_id}}',
            '{{%article_tags}}',
            'tag_id'
        );

        // add foreign key for table `{{%tags}}`
        $this->addForeignKey(
            '{{%fk-article_tags-tag_id}}',
            '{{%article_tags}}',
            'tag_id',
            '{{%tags}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%article}}`
        $this->dropForeignKey(
            '{{%fk-article_tags-article_id}}',
            '{{%article_tags}}'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            '{{%idx-article_tags-article_id}}',
            '{{%article_tags}}'
        );

        // drops foreign key for table `{{%tags}}`
        $this->dropForeignKey(
            '{{%fk-article_tags-tag_id}}',
            '{{%article_tags}}'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            '{{%idx-article_tags-tag_id}}',
            '{{%article_tags}}'
        );

        $this->dropTable('{{%article_tags}}');
    }
}
