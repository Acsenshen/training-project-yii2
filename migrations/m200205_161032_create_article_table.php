<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%category}}`
 */
class m200205_161032_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'annotation' => $this->string(),
            'content' => $this->string(),
            'article_date' => $this->date(),
            'preview' => $this->string(),
            'viewed' => $this->integer(),
            'author' => $this->integer(),
            'status' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        // creates index for column `author`
        $this->createIndex(
            '{{%idx-article-author}}',
            '{{%article}}',
            'author'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-article-author}}',
            '{{%article}}',
            'author',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `status`
        $this->createIndex(
            '{{%idx-article-status}}',
            '{{%article}}',
            'status'
        );
                
        // add foreign key for table `{{%status}}`
        $this->addForeignKey(
            '{{%fk-article-status}}',
            '{{%article}}',
            'status',
            '{{%status}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-article-category_id}}',
            '{{%article}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-article-category_id}}',
            '{{%article}}',
            'category_id',
            '{{%category}}',
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
            '{{%fk-article-author}}',
            '{{%article}}'
        );

        // drops index for column `author`
        $this->dropIndex(
            '{{%idx-article-author}}',
            '{{%article}}'
        );

        // drops foreign key for table `{{%status}}`
        $this->dropForeignKey(
            '{{%fk-article-status}}',
            '{{%article}}'
        );

        // drops index for column `status`
        $this->dropIndex(
            '{{%idx-article-status}}',
            '{{%article}}'
        );

        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-article-category_id}}',
            '{{%article}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-article-category_id}}',
            '{{%article}}'
        );

        $this->dropTable('{{%article}}');
    }
}
