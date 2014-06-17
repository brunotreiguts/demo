<?php

namespace Fuel\Migrations;

class Create_imagegalleries
{
	public function up()
	{
		\DBUtil::create_table('imagegalleries', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'file' => array('constraint' => 36, 'type' => 'varchar'),
			'description' => array('type' => 'text', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('imagegalleries');
	}
}