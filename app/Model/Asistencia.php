<?php
class Asistencia extends AppModel {
    var $name = 'Asistencia';
	
	public $actsAs = array('Search.Searchable');
	
	public $belongsTo = array(
        'Miembro' => array(
            'className'    => 'Miembro',
            'foreignKey'   => 'miembro_id'
        ),
		'Dia' => array(
            'className'    => 'Dia',
            'foreignKey'   => 'dia_id'
        ),
    );
	
	
}



?>