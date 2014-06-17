<?php
use Orm\Model;

class Model_Material extends Model
{
	protected static $_properties = array(
		'id',
		'image',
		'title',
		'description',
		'price',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('image', 'Image', 'max_length[70]');
		$val->add_field('title', 'Title', 'required|max_length[70]');
		$val->add_field('description', 'Description', 'required');
		$val->add_field('price', 'Price', 'required');

		return $val;
	}

}
