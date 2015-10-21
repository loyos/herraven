<?php
class Inventariomaterial extends AppModel {
    var $name = 'Inventariomaterial';

	public $belongsTo = array(
        'Materiasprima' => array(
            'className'    => 'Materiasprima',
            'foreignKey'   => 'materiasprima_id'
        ),
    );
	
	var $validate = array( 
		'cantidad' => array(
			'not_Empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'mayor_cero' => array(
				'rule' => array('comparison', '>', 0),
				'message' => 'Este campo no puede tener valores negativos.'
			),
		),
    ); 
}
?>