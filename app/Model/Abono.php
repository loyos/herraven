<?php
class Abono extends AppModel {
    var $name = 'Abono';
	
	public $belongsTo = array(
        'Cuenta' => array(
            'className'    => 'Cuenta',
            'foreignKey'   => 'cuenta_id'
        ),
    );
}



?>