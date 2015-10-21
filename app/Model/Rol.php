<?php
class Rol extends AppModel {
    var $name = 'Rol';
	
	public $hasMany = array(
		'User' => array(
			'className'  => 'User',
			'foreignKey'    => 'rol_id',
		),
    );
	
	var $hasAndBelongsToMany = array(
        'Bloque' =>
            array('className'            => 'Bloque',
                 'joinTable'              => 'bloques_rols',
                 'foreignKey'             => 'rol_id',
                 'associationForeignKey'  => 'bloque_id',
          ),
		 'Modulo' =>
            array('className'            => 'Modulo',
                 'joinTable'              => 'modulos_rols',
                 'foreignKey'             => 'rol_id',
                 'associationForeignKey'  => 'modulo_id',
          )
    );
}



?>