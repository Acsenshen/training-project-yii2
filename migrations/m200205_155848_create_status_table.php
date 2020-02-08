<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m200205_155848_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);

        $this->insert('status', [
            'title' => 'Опубликован',
        ]);

        $this->insert('status', [
            'title' => 'На стадии публикации',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('status', ['id' => 1]);
        $this->delete('status', ['id' => 2]);
        $this->dropTable('{{%status}}');
    }
}
