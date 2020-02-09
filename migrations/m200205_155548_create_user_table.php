<?php

use yii\db\Migration;


class m200205_155548_create_user_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'password' => $this->string(),
            'isAdmin' => $this->integer(),
        ]);
    }


    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
