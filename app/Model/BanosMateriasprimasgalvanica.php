<?php
class BanosMateriasprimasgalvanica extends AppModel {
    var $name = 'BanosMateriasprimasgalvanica';
	
	public $belongsTo = array(
        'Bano' => array(
            'className'    => 'Bano',
            'foreignKey'   => 'bano_id'
        ),
		'Materiasprimasgalvanica' => array(
            'className'    => 'Materiasprimasgalvanica',
            'foreignKey'   => 'materiasprimasgalvanica_id'
        ),
    );
}
?>