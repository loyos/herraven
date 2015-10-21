<?php
class Bano extends AppModel {
    var $name = 'Bano';
	
	public $hasMany = array(
		'BanosMateriasprimasgalvanica' => array(
			'className'  => 'BanosMateriasprimasgalvanica',
			'foreignKey'    => 'bano_id',
		),
    );
	
	public $belongsTo = array(
        'Lineasgalvanica' => array(
            'className'    => 'Lineasgalvanica',
            'foreignKey'   => 'lineasgalvanica_id'
        ),
    );
}
?>