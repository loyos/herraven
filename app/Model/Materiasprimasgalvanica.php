<?php
class Materiasprimasgalvanica extends AppModel {
    var $name = 'Materiasprimasgalvanica';
	
	public $hasMany = array(
		'BanosMateriasprimasgalvanica' => array(
			'className'  => 'BanosMateriasprimasgalvanica',
			'foreignKey'    => 'materiasprimasgalvanica_id',
		),
    );
}
?>