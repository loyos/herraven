<?php
class Herramienta extends AppModel {
    var $name = 'Herramienta';
	
	public $belongsTo = array(
		'Lotesherramienta' => array(
            'className'    => 'Lotesherramienta',
            'foreignKey'   => 'lotesherramienta_id'
        ),
    );
	
}
?>