<?php
class BloquesRol extends AppModel {
    var $name = 'BloquesRol';
	
	public $belongsTo = array(
        'Bloque' => array(
            'className'    => 'Bloque',
            'foreignKey'   => 'bloque_id'
        ),
		 'Rol' => array(
            'className'    => 'Rol',
            'foreignKey'   => 'rol_id'
        ),
    );
}



?>