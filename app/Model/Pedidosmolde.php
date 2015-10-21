<?php
class Pedidosmolde extends AppModel {
    var $name = 'Pedidosmolde';
	
	public $actsAs = array('Search.Searchable');
	
	public $belongsTo = array(
        'Molde' => array(
            'className'    => 'Molde',
            'foreignKey'   => 'molde_id'
        ),
		'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
    );
	
	
}



?>