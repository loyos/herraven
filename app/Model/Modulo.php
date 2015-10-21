<?php
class Modulo extends AppModel {
    var $name = 'Modulo';
	
	public $belongsTo = array(
		'Bloque' => array(
            'className'    => 'Bloque',
            'foreignKey'   => 'bloque_id'
        ),
    );
	
	public $hasMany = array(
		'Modulo' => array(
            'className'    => 'Modulo',
            'foreignKey'   => 'modulo_id'
        )
    );
}



?>