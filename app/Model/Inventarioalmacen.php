<?php
class Inventarioalmacen extends AppModel {
    var $name = 'Inventarioalmacen';

	public $belongsTo = array(
        'Articulo' => array(
            'className'    => 'Articulo',
            'foreignKey'   => 'articulo_id'
        ),
		'Acabado' => array(
			'className'    => 'Acabado',
            'foreignKey'   => 'acabado_id'
		),
		'Pedido' => array(
			'className'    => 'Pedido',
            'foreignKey'   => 'pedido_id'
		)
    );
	
	public $hasMany = array(
        'Caja' => array(
            'className'  => 'Caja',
			'foreignKey'    => 'inventarioalmacen_id',
        )
    );
	var $validate = array( 
		'cajas' => array(
			'not_Empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'mayor_cero' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Este campo no puede tener valores negativos.'
			),
			'menor_veinticinco' => array(
				'rule' => array('comparison', '<=', 25),
				'message' => 'Se puede hacer un ingreso de máximo 25 cajas.'
			),
		),
    ); 
}
?>