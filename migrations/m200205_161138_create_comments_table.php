<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%article}}`
 * - `{{%status}}`
 */
class m200205_161138_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'author_comment' => $this->integer(),
            'article_id' => $this->integer(),
            'comment_date' => $this->date(),
            'status' => $this->integer(),
        ]);

        // creates index for column `author_comment`
        $this->createIndex(
            '{{%idx-comments-author_comment}}',
            '{{%comments}}',
            'author_comment'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-comments-author_comment}}',
            '{{%comments}}',
            'author_comment',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `article_id`
        $this->createIndex(
            '{{%idx-comments-article_id}}',
            '{{%comments}}',
            'article_id'
        );

        // add foreign key for table `{{%article}}`
        $this->addForeignKey(
            '{{%fk-comments-article_id}}',
            '{{%comments}}',
            'article_id',
            '{{%article}}',
            'id',
            'CASCADE'
        );

        // creates index for column `status`
        $this->createIndex(
            '{{%idx-comments-status}}',
            '{{%comments}}',
            'status'
        );

        // add foreign key for table `{{%status}}`
        $this->addForeignKey(
            '{{%fk-comments-status}}',
            '{{%comments}}',
            'status',
            '{{%status}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-comments-author_comment}}',
            '{{%comments}}'
        );

        // drops index for column `author_comment`
        $this->dropIndex(
            '{{%idx-comments-author_comment}}',
            '{{%comments}}'
        );

        // drops foreign key for table `{{%article}}`
        $this->dropForeignKey(
            '{{%fk-comments-article_id}}',
            '{{%comments}}'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            '{{%idx-comments-article_id}}',
            '{{%comments}}'
        );

        // drops foreign key for table `{{%status}}`
        $this->dropForeignKey(
            '{{%fk-comments-status}}',
            '{{%comments}}'
        );

        // drops index for column `status`
        $this->dropIndex(
            '{{%idx-comments-status}}',
            '{{%comments}}'
        );

        $this->dropTable('{{%comments}}');
    }
}
