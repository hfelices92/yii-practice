<?php

class m260130_150716_create_posts_table extends CDbMigration
{
	public function up()
	{
		 $this->createTable('posts', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'content' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
        ), 'ENGINE=InnoDB');
	}

	public function down()
	{
		 $this->dropTable('posts');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}