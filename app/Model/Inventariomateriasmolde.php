<?php
class Inventariomateriasmolde extends AppModel {
    var $name = 'Inventariomateriasmolde';

	public $belongsTo = array(
        'Materiasprimasmolde' => array(
            'className'    => 'Materiasprimasmolde',
            'foreignKey'   => 'materiasprimasmolde_id'
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
		$this->Pedido = ClassRegistry::init('Pedidosmolde');
		$pedido = $this->Pedido->findById($pedido_id);
		$cantidad_pzas = $pedido['Pedidosmolde']['cantidad'];
		$cantidad_necesitada = $cantidad_pzas*$pedido['Molde']['cantidad'];
		$materiaprima_id = $pedido['Molde']['materiasprimasmolde_id'];
		
		$inventario_entrada = $this->find('first',array(
			'fields' => array('SUM(Inventariomateriasmolde.cantidad)','Inventariomateriasmolde.tipo'),
			'conditions' => array(
				'Inventariomateriasmolde.materiasprimasmolde_id' => $materiaprima_id,
				'Inventariomateriasmolde.tipo' => 'entrada',
			),
		));
		$inventario_salida = $this->find('first',array(
			'fields' => array('SUM(Inventariomateriasmolde.cantidad)','Inventariomateriasmolde.tipo'),
			'conditions' => array(
				'Inventariomateriasmolde.materiasprimasmolde_id' => $materiaprima_id,
				'Inventariomateriasmolde.tipo' => 'salida',
			),
		));
		if (!empty($inventario_entrada[0]['SUM(`Inventariomateriasmolde`.`cantidad`)'])) {
			if (empty($inventario_salida[0]['SUM(`Inventariomateriasmolde`.`cantidad`)'])) {
				$inventario_salida[0]['SUM(`Inventariomateriasmolde`.`cantidad`)'] = 0;
			}
			$cantidad_total = $inventario_entrada[0]['SUM(`Inventariomateriasmolde`.`cantidad`)'] - $inventario_salida[0]['SUM(`Inventariomateriasmolde`.`cantidad`)'];
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