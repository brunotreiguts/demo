<?php
use Orm\Model;

class Model_Imagegallery extends Model
{
	protected static $_properties = array(
		'id',
		'file',
		'description',
		'created_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('file', 'File', 'max_length[36]');
		$val->add_field('description', 'Description', 'required');

		return $val;
	}
        

}
