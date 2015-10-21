<?php
class Precio extends AppModel {
    var $name = 'Precio';
	
	public $hasMany = array(
		'Cliente' => array(
			'className'  => 'Cliente',
			'foreignKey'    => 'precio_id',
		)
    );
	
	// var $hasAndBelongsToMany = array(
        // 'Materiasprima' =>
            // array('className'            => 'Materiasprima',
                 // 'joinTable'              => 'materiasprimas_precios',
                 // 'foreignKey'             => 'precio_id',
                 // 'associationForeignKey'  => 'materiasprima_id',
            // )
    // );
	var $validate = array( 
		'ganancia' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		)
    ); 
}



?>