<?php
class Dia extends AppModel {
    var $name = 'Dia';
	
	public $actsAs = array('Search.Searchable');
	
	public $hasMany = array(
        'Asistencia' => array(
            'className'    => 'Asistencia',
            'foreignKey'   => 'dia_id'
        ),

    );
	
	
}
?>