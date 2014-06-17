<?php

namespace Fuel\Migrations;

class Create_employees
{
	public function up()
	{
		\DBUtil::create_table('employees', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 70, 'type' => 'varchar'),
			'surname' => array('constraint' => 70, 'type' => 'varchar'),
			'email' => array('constraint' => 254, 'type' => 'varchar'),
			'phonenumber' => array('constraint' => 8, 'type' => 'varchar'),
			'description' => array('type' => 'text'),
			'avatar' => array('constraint' => 100, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('employees');
	}
}