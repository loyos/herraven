<?php
class Materiasprimasproduccion extends AppModel {
    var $name = 'Materiasprimasproduccion';
	
	public $hasMany = array(
        'Articulosproduccion' => array(
            'className'    => 'Articulosproduccion',
            'foreignKey'   => 'materiasprimasproduccion_id'
        ),
    );
}
?>