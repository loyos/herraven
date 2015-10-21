<?php
class Insumo extends AppModel {
    var $name = 'Insumo';
	
   public $belongsTo = array(
		'Lote' => array(
            'className'    => 'Lote',
            'foreignKey'   => 'lote_id'
        ),
    );
	public $hasMany = array(
		'Inventarioinsumo' => array(
            'className'    => 'Inventarioinsumo',
            'foreignKey'   => 'insumo_id'
        ),
    );

}



?>