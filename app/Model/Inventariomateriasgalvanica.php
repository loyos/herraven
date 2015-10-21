<?php
class Inventariomateriasgalvanica extends AppModel {
    var $name = 'Inventariomateriasgalvanica';

	public $belongsTo = array(
        'Materiasprimasgalvanica' => array(
            'className'    => 'Materiasprimasgalvanica',
            'foreignKey'   => 'materiasprimasgalvanica_id'
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