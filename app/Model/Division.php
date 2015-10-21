<?php
class Division extends AppModel {
    var $name = 'Division';
	
	public $hasMany = array(
        'Departamento' => array(
            'className'  => 'Departamento',
			'foreignKey'    => 'division_id',
        )
    );
	
	public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
    );
	
	var $validate = array( 
		'user_id' => array(
			'required' => array(
				'rule' => array('no_empty_jefe'),
				'message' => 'Este campo no puede quedar vacío'
			)
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
		
		'numero' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
		),
	);
	
	function no_empty_jefe($data){ 
		if(!empty($data["user_id"])) {
			return true;
		} 
		
	}
	
}



?>