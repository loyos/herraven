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

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'rif' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'representante' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'ciudad' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'direccion' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'direccion_despacho' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'telefono_uno' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'email_representante' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'precio_id' => array(

			'rule' => 'notEmpty',

			'message' => 'Este campo no puede quedar vac�o.'

		),

		'codigo_uno' => array(

			'rule' => 'notEmpty',

			'message' => 'Debes colocar un c�digo, por ejemplo 0212.'

		),

    );

	public function findRegistered(){
		$clientes = $this->find('all',array(
            'fields' => array('Cliente.*'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'Users',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Cliente.id = Users.cliente_id',
                    )
                ),

            ),
            
        ));

        // echo "<pre>";print_r($clientes);echo "</pre>";die;
        return $clientes;
	}

}







?>