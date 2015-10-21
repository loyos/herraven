<?php
class CajasPedido extends AppModel {
    var $name = 'CajasPedido';
	
	public $belongsTo = array(
        'Caja' => array(
            'className'    => 'Caja',
            'foreignKey'   => 'caja_id'
        ),
		 'Pedido' => array(
            'className'    => 'Pedido',
            'foreignKey'   => 'pedido_id'
        ),
    );
}



?>