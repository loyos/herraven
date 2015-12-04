<?php

class Lineasminumet extends AppModel {

    var $name = 'Lineasminumet';

	

	public $hasMany = array(

        'Subcategoriaminumet' => array(

            'className'  => 'Subcategoriaminumet',

			'foreignKey'    => 'lineasminumet_id',

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