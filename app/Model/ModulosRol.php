<?php
class ModulosRol extends AppModel {
    var $name = 'ModulosRol';
	
	public $belongsTo = array(
        'Modulo' => array(
            'className'    => 'Modulo',
            'foreignKey'   => 'modulo_id'
        ),
		 'Rol' => array(
            'className'    => 'Rol',
            'foreignKey'   => 'rol_id'
        ),
    );
}



?>