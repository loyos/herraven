<?php
class Caja extends AppModel {
    var $name = 'Caja';
	
   public $belongsTo = array(
        'Inventarioalmacen' => array(
            'className'    => 'Inventarioalmacen',
            'foreignKey'   => 'inventarioalmacen_id'
        ),
    );
	
	var $hasAndBelongsToMany = array(
        'Pedido' =>
            array('className'            => 'Pedido',
                 'joinTable'              => 'cajas_pedidos',
                 'foreignKey'             => 'caja_id',
                 'associationForeignKey'  => 'pedido_id',
            )
    );
	public $hasMany = array(
		'CajasPedido' => array(
			'className'  => 'CajasPedido',
			'foreignKey'    => 'caja_id',
		),
    );
	
	function generar_codigo() {
	$codigo = '';
		for ($i=1; $i<=8; $i++) {
			$numero_aleatorio = rand(1,9);
			$codigo = $codigo.$numero_aleatorio;
		}
		return($codigo);
	}
}




?>