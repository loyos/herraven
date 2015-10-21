<?php
class Cliente extends AppModel {
    var $name = 'Cliente';
	
	public $belongsTo = array(
        'Precio' => array(
            'className'    => 'Precio',
            'foreignKey'   => 'precio_id'
        ),
    );
	
	public $hasMany = array(
		'Pedido' => array(
			'className'  => 'Pedido',
			'foreignKey'    => 'cliente_id',
		),
		'User' => array(
			'className'  => 'User',
			'foreignKey'    => 'cliente_id',
		),
    );
	
	var $hasAndBelongsToMany = array(
		 'Articulo' =>
            array('className'            => 'Articulo',
                 'joinTable'              => 'articulos_clientes',
                 'foreignKey'             => 'cliente_id',
                 'associationForeignKey'  => 'articulo_id',
            )
    );
	
	 var $validate = array(
        'denominacion_legal' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'rif' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'representante' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'ciudad' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'direccion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'direccion_despacho' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'telefono_uno' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'email_representante' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'precio_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'codigo_uno' => array(
			'rule' => 'notEmpty',
			'message' => 'Debes colocar un código, por ejemplo 0212.'
		),
    );
}



?>