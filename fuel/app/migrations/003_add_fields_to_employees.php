<?php

namespace Fuel\Migrations;

class Add_fields_to_employees
{
	public function up()
	{
		\DBUtil::add_fields('employees', array(
			'fields' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('employees', array(
			'fields'

		));
	}
}