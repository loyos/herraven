<?php
class Acabado extends AppModel {
    var $name = 'Acabado';
	
	public $hasMany = array(
		'Inventarioalmacen' => array(
			'className'  => 'Inventarioalmacen',
			'foreignKey'    => 'acabado_id',
		),
		'Pedido' => array(
			'className'  => 'Pedido',
			'foreignKey'    => 'acabado_id',
		)
    );
	var $hasAndBelongsToMany = array(
		'Materiasprima' =>
            array('className'            => 'Materiasprima',
                 'joinTable'              => 'acabados_materiasprimas',
                 'foreignKey'             => 'acabado_id',
                 'associationForeignKey'  => 'materiasprima_id',
        ),
    );
	var $validate = array(
        'acabado' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
    );
	
}
?>