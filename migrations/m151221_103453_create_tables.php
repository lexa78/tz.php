<?php

use yii\db\Schema;
use yii\db\Migration;

class m151221_103453_create_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . ' NOT NULL',
            'token' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);

        $this->createTable('{{%author}}', [
            'id' => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING . ' NOT NULL',
            'last_name' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
        $this->insert('{{%author}}', [
            'first_name' => 'Александр Сергеевич',
            'last_name' => 'Пушкин'
        ]);
        $this->insert('{{%author}}', [
            'first_name' => 'Лев Николаевич',
            'last_name' => 'Толстой'
        ]);
        $this->insert('{{%author}}', [
            'first_name' => 'Николай Васильевич',
            'last_name' => 'Гоголь'
        ]);

        $this->createTable('{{%book}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'preview' => Schema::TYPE_STRING . ' NOT NULL',
            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('author_id','{{%book}}','author_id','{{%author}}','id','cascade','cascade');
    }

    public function down()
    {
        echo "m151221_103453_create_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
