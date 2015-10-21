<?php
class Lineasgalvanica extends AppModel {
    var $name = 'Lineasgalvanica';
	
	public $hasMany = array(
        'Bano' => array(
            'className'    => 'Bano',
            'foreignKey'   => 'lineasgalvanica_id'
        ),
    );
}
?>