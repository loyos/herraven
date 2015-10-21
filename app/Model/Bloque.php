<?php
class Bloque extends AppModel {
    var $name = 'Bloque';
	
	public $hasMany = array(
		'Modulo' => array(
            'className'    => 'Modulo',
            'foreignKey'   => 'modulo_id'
        ),
		'ModulosRol' => array(
            'className'    => 'Modulo',
            'foreignKey'   => 'modulo_id'
        )
    );
	
	var $hasAndBelongsToMany = array(
        'Rol' =>
            array('className'            => 'Rol',
                 'joinTable'              => 'bloques_rols',
                 'foreignKey'             => 'bloque_id',
                 'associationForeignKey'  => 'rol_id',
            )
    );
}



?>