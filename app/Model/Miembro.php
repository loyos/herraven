<?php

class Miembro extends AppModel {

    var $name = 'Miembro';

	

	 public $belongsTo = array(

        'User' => array(

            'className'    => 'User',

            'foreignKey'   => 'user_id'

        ),

		'Unidad' => array(

            'className'    => 'Unidad',

            'foreignKey'   => 'unidad_id'

        ),

    );

	

	public $hasMany = array(

		'Asistencia' => array(

			'className'  => 'Asistencia',

			'foreignKey'    => 'miembro_id',

		),

    );

    function findMembers() {

        $miembros = $this->find('all',array(

                'conditions' => array(

                    'Miembro.status !=' => 'Retirado',

                )

            ));

        return $miembros;  

    }

}







?>