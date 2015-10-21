<?php
class Inventarioarticulosproduccion extends AppModel {
    var $name = 'Inventarioarticulosproduccion';

	public $belongsTo = array(
        'Articulosproduccion' => array(
            'className'    => 'Articulosproduccion',
            'foreignKey'   => 'articulosproduccion_id'
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
}
?>