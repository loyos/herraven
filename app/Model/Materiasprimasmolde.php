<?php
class Materiasprimasmolde extends AppModel {
    var $name = 'Materiasprimasmolde';
	
	public $hasMany = array(
        'Molde' => array(
            'className'    => 'Molde',
            'foreignKey'   => 'materiasprimasmolde_id'
        ),
		'Inventariomateriasmolde' => array(
            'className'    => 'Inventariomateriasmolde',
            'foreignKey'   => 'materiasprimasmolde_id'
        ),
    );
}
?>