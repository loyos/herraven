<?php
class Articulosproduccion extends AppModel {
    var $name = 'Articulosproduccion';
	
	public $belongsTo = array(
        'Materiasprimasproduccion' => array(
            'className'    => 'Materiasprimasproduccion',
            'foreignKey'   => 'materiasprimasproduccion_id'
        ),
    );
		
	public $hasMany = array(
		'Pedidosproduccion' => array(
			'className'  => 'Pedidosproduccion',
			'foreignKey'    => 'articulosproduccion_id',
		),
    );	
}

?>