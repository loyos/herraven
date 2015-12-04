<?php

class Subcategoriaminumet extends AppModel {

    var $name = 'Subcategoriaminumet';

	

   public $belongsTo = array(

        'Lineasminumet' => array(

            'className'    => 'Lineasminumet',

            'foreignKey'   => 'lineasminumet_id'

        ),

    );

	public $hasMany = array(

        'Articulosproduccion' => array(

            'className'  => 'Articulosproduccion',

			'foreignKey'    => 'subcategoriaminumet_id',

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