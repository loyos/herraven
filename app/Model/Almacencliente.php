<?php
class Almacencliente extends AppModel {
    var $name = 'Almacencliente';

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
}
?>