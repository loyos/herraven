<?php
class Pedidosproduccion extends AppModel {
    var $name = 'Pedidosproduccion';
	
	public $actsAs = array('Search.Searchable');
	
	public $belongsTo = array(
        'Articulosproduccion' => array(
            'className'    => 'Articulosproduccion',
            'foreignKey'   => 'articulosproduccion_id'
        ),
		'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
    );
	
	
}



?>