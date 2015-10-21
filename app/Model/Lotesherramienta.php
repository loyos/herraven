<?php
class Lotesherramienta extends AppModel {
    var $name = 'Lotesherramienta';
	
	public $hasMany = array(
        'Herramienta' => array(
            'className'  => 'Herramienta',
			'foreignKey'    => 'lotesherramienta_id',
        )
    );
	
	public $belongsTo = array(
        'Unidad' => array(
            'className'    => 'Unidad',
            'foreignKey'   => 'unidad_id'
        ),
    );
	
	public $hasAndBelongsToMany = array(
        'Proveedor' =>
            array('className'            => 'Proveedor',
                 'joinTable'              => 'lotesherramientas_proveedors',
                 'foreignKey'             => 'lotesherramienta_id',
                 'associationForeignKey'  => 'proveedor_id',
        ),
    );
	
}



?>