<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%article}}`
 * - `{{%status}}`
 */
class m200205_161138_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string(),
            'author_comment' => $this->integer(),
            'article_id' => $this->integer(),
            'comment_date' => $this->date(),
            'status' => $this->integer(),
        ]);

        // creates index for column `author_comment`
        $this->createIndex(
            '{{%idx-comment-author_comment}}',
            '{{%comment}}',
            'author_comment'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-comment-author_comment}}',
            '{{%comment}}',
            'author_comment',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `article_id`
        $this->createIndex(
            '{{%idx-comment-article_id}}',
            '{{%comment}}',
            'article_id'
        );

        // add foreign key for table `{{%article}}`
        $this->addForeignKey(
            '{{%fk-comment-article_id}}',
            '{{%comment}}',
            'article_id',
            '{{%article}}',
            'id',
            'CASCADE'
        );

        // creates index for column `status`
        $this->createIndex(
            '{{%idx-comment-status}}',
            '{{%comment}}',
            'status'
        );

        // add foreign key for table `{{%status}}`
        $this->addForeignKey(
            '{{%fk-comment-status}}',
            '{{%comment}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-comment-author_comment}}',
            '{{%comment}}'
        );

        // drops index for column `author_comment`
        $this->dropIndex(
            '{{%idx-comment-author_comment}}',
            '{{%comment}}'
        );

        // drops foreign key for table `{{%article}}`
        $this->dropForeignKey(
            '{{%fk-comment-article_id}}',
            '{{%comment}}'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            '{{%idx-comment-article_id}}',
            '{{%comment}}'
        );

        // drops foreign key for table `{{%status}}`
        $this->dropForeignKey(
            '{{%fk-comment-status}}',
            '{{%comment}}'
        );

        // drops index for column `status`
        $this->dropIndex(
            '{{%idx-comment-status}}',
            '{{%comment}}'
        );

        $this->dropTable('{{%comment}}');
    }
}
