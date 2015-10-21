<?php
class Inventarioinsumo extends AppModel {
    var $name = 'Inventarioinsumo';

	public $belongsTo = array(
        'Insumo' => array(
            'className'    => 'Insumo',
            'foreignKey'   => 'insumo_id'
        ),
    ); 
	
	function obtenerSaldo($insumo_id) {
		$entradas_insumo = $this->find('all',array(
				'fields' => array('SUM(Inventarioinsumo.cantidad)'),
				'conditions' => array(
					'Inventarioinsumo.insumo_id' => $insumo_id,
					'Inventarioinsumo.tipo' => 'entrada',
				)
			));
		$salidas_insumo = $this->find('all',array(
				'fields' => array('SUM(Inventarioinsumo.cantidad)'),
				'conditions' => array(
					'Inventarioinsumo.insumo_id' => $insumo_id,
					'Inventarioinsumo.tipo' => 'salida',
				)
		));
		$saldo['entrada'] = $entradas_insumo[0][0]['SUM(`Inventarioinsumo`.`cantidad`)'];
		$saldo['salida'] = $salidas_insumo[0][0]['SUM(`Inventarioinsumo`.`cantidad`)'];
		$saldo['total'] = $saldo['entrada']-$saldo['salida'];
		return $saldo;	
	}
}
?>