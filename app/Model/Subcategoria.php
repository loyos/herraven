<?php
class Subcategoria extends AppModel {
    var $name = 'Subcategoria';
	
   public $belongsTo = array(
        'Categoria' => array(
            'className'    => 'Categoria',
            'foreignKey'   => 'categoria_id'
        ),
    );
	public $hasMany = array(
        'Articulo' => array(
            'className'  => 'Articulo',
			'foreignKey'    => 'subcategoria_id',
        )
    );
	
	// var $validate = array(
        // 'descripcion' => array(
			// 'rule' => 'notEmpty',
			// 'message' => 'Este campo no puede quedar vacío.'
		// ),
		// 'categoria_id' => array(
			// 'rule' => 'notEmpty',
			// 'message' => 'Este campo no puede quedar vacío.'
		// ),
    // );
}



?>