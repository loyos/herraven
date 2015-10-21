<?php
class Categoria extends AppModel {
    var $name = 'Categoria';
	
	public $hasMany = array(
        'Subcategoria' => array(
            'className'  => 'Subcategoria',
			'foreignKey'    => 'categoria_id',
        )
    );
	var $validate = array(
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
    );
}



?>