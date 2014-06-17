<?php

namespace Fuel\Migrations;

class Create_materials
{
	public function up()
	{
		\DBUtil::create_table('materials', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'image' => array('constraint' => 70, 'type' => 'varchar'),
			'title' => array('constraint' => 70, 'type' => 'varchar'),
			'description' => array('type' => 'text'),
			'price' => array('constraint' => '6,2', 'type' => 'decimal'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('materials');
	}
}