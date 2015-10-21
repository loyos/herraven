<?php
class Unidad extends AppModel {
    var $name = 'Unidad';
	
	public $hasMany = array(
        'Lote' => array(
            'className'  => 'Lote',
			'foreignKey'    => 'unidad_id',
        ),
		'Materiasprima' => array(
            'className'  => 'Materiasprima',
			'foreignKey'    => 'unidad_id',
        ),
		'Miembro' => array(
            'className'  => 'Miembro',
			'foreignKey'    => 'unidad_id',
        ),
    );
	
	 public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
		'Departamento' => array(
            'className'    => 'Departamento',
            'foreignKey'   => 'departamento_id'
        ),
    );
	
	var $validate = array( 
		'user_id' => array(
			'required' => array(
				'rule' => array('no_empty_jefe'),
				'message' => 'Este campo no puede quedar vacío.g'
			)
		),
		
		'numero' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
		),
		
		'nombre' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
		),
		
		'descripcion' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
		),
	);
	
	function no_empty_jefe($data){ 
		if($data["user_id"] != 0) {
			return true;
		} 
		return false;
	}
	
}



?>