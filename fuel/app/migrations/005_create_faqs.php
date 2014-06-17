<?php

namespace Fuel\Migrations;

class Create_faqs
{
	public function up()
	{
		\DBUtil::create_table('faqs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'question' => array('type' => 'text'),
			'answer' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('faqs');
	}
}