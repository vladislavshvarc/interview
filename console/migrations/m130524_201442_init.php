<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' 			=> $this->primaryKey(),
            'username' 		=> $this->string()->notNull()->unique(),
			'password' 		=> $this->string()->notNull(),
			'auth_key' 		=> $this->string(32)->notNull(),
            'created_at' 	=> $this->integer()->notNull(),
            'updated_at' 	=> $this->integer()->notNull(),
        ], $tableOptions);

        $createdAt = time();

        $this->insert('{{%user}}', [
        	'username'		 => 'admin',
			'password'		 => Yii::$app->security->generatePasswordHash('password'),
			'auth_key'		 => Yii::$app->security->generateRandomString(),
			'created_at'	 => $createdAt,
			'updated_at'	 => $createdAt
		]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
