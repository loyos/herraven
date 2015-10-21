<?php
class Molde extends AppModel {
    var $name = 'Molde';
	
	public $actsAs = array('Search.Searchable');
	
	public $hasMany = array(
		'Pedidosmolde' => array(
			'className'  => 'Pedidosmolde',
			'foreignKey'    => 'molde_id',
		),
    );
	
	public $belongsTo = array(
		'Materiasprimasmolde' => array(
			'className'  => 'Materiasprimasmolde',
			'foreignKey'    => 'materiasprimasmolde_id',
		),
    );
	
	var $validate = array( 
		'medidas' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'anotaciones' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		
		'cavidades' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'codigo' => array(
			// 'unico' => array(
				// 'rule' => 'isUnique',
				// 'message' => 'El código debe ser único'
			// )
		),
		'cantidad' => array(
			'not_Empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'mayor_cero' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Este campo no puede tener valores negativos.'
			),
			'separador_punto' => array(
				'rule' => 'decimales',
				'message' => 'Los decimales son expresados despues de un punto.'
			)
		),
		
    );
	
	public $filterArgs = array(
		'ubicacion' => array('type' => 'like', 'field' => 'Molde.ubicacion'),
		'codigo' => array('type' => 'like', 'field' => 'Molde.codigo'),
	);
	
	public function decimales($field){
		$coma = strpos($field['cantidad'], ',');
		if ($coma === false) {
			return true;
		}
		return false;
	}
}
?>