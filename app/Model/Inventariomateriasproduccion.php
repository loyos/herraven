<?php
class Inventariomateriasproduccion extends AppModel {
    var $name = 'Inventariomateriasproduccion';

	public $belongsTo = array(
        'Materiasprimasproduccion' => array(
            'className'    => 'Materiasprimasproduccion',
            'foreignKey'   => 'materiasprimasproduccion_id'
        ),
    );
	
	var $validate = array( 
		'cantidad' => array(
			'not_Empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'mayor_cero' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Este campo no puede tener valores negativos.'
			),
		),
    ); 
	
	function suficienteMateria($pedido_id) {
		$this->Pedido = ClassRegistry::init('Pedidosproduccion');
		$pedido = $this->Pedido->findById($pedido_id);
		$cantidad_pzas = $pedido['Pedidosproduccion']['cantidad'];
		$cantidad_necesitada = $cantidad_pzas*$pedido['Articulosproduccion']['cantidad'];
		$materiaprima_id = $pedido['Articulosproduccion']['materiasprimasproduccion_id'];
		
		$inventario_entrada = $this->find('first',array(
			'fields' => array('SUM(Inventariomateriasproduccion.cantidad)','Inventariomateriasproduccion.tipo'),
			'conditions' => array(
				'Inventariomateriasproduccion.materiasprimasproduccion_id' => $materiaprima_id,
				'Inventariomateriasproduccion.tipo' => 'entrada',
			),
		));
		$inventario_salida = $this->find('first',array(
			'fields' => array('SUM(Inventariomateriasproduccion.cantidad)','Inventariomateriasproduccion.tipo'),
			'conditions' => array(
				'Inventariomateriasproduccion.materiasprimasproduccion_id' => $materiaprima_id,
				'Inventariomateriasproduccion.tipo' => 'salida',
			),
		));
		if (!empty($inventario_entrada[0]['SUM(`Inventariomateriasproduccion`.`cantidad`)'])) {
			if (empty($inventario_salida[0]['SUM(`Inventariomateriasproduccion`.`cantidad`)'])) {
				$inventario_salida[0]['SUM(`Inventariomateriasproduccion`.`cantidad`)'] = 0;
			}
			$cantidad_total = $inventario_entrada[0]['SUM(`Inventariomateriasproduccion`.`cantidad`)'] - $inventario_salida[0]['SUM(`Inventariomateriasproduccion`.`cantidad`)'];
		} else {
			return false;
		}
		if ($cantidad_necesitada <= $cantidad_total) {
			return true;
		}
		return false;
	}
}
?>