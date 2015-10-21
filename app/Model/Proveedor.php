<?php
class Proveedor extends AppModel {
    var $name = 'Proveedor';
	
	var $hasAndBelongsToMany = array(
        'Lotesherramienta' =>
            array('className'            => 'Lotesherramienta',
                 'joinTable'              => 'lotesherramientas_proveedors',
                 'foreignKey'             => 'proveedor_id',
                 'associationForeignKey'  => 'lotesherramienta_id',
        ),
		'Lote' =>
            array('className'            => 'Lote',
                 'joinTable'              => 'lotes_proveedors',
                 'foreignKey'             => 'proveedor_id',
                 'associationForeignKey'  => 'lote_id',
        ),
		'Materiasprima' =>
            array('className'            => 'Materiasprima',
                 'joinTable'              => 'materiasprimas_proveedors',
                 'foreignKey'             => 'proveedor_id',
                 'associationForeignKey'  => 'materiasprima_id',
        ),
    );
}
?>