<?php
class User extends AppModel {
    var $name = 'User';
	
	public $belongsTo = array(
        'Cliente' => array(
            'className'    => 'Cliente',
            'foreignKey'   => 'cliente_id'
        ),
		'Rol' => array(
            'className'    => 'Rol',
            'foreignKey'   => 'rol_id'
        ),
    );
	
	public $hasMany = array(
		'Pedidosmolde' => array(
			'className'  => 'Pedidosmolde',
			'foreignKey'    => 'user_id',
		),
		'Pedidosproduccion' => array(
			'className'  => 'Pedidosproduccion',
			'foreignKey'    => 'user_id',
		),
    );
	
	public static $roles = array(
		'cliente' => 'Cliente',
		'admin' => 'Administrador'
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	var $validate = array(
        'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'unico' => array(
				'rule' => 'isUnique_user',
				'message' => 'Este nombre de usuario ya ha sido asignado.'
			)
		),
		'password' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'email' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'nombre' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'apellido' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'rol' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'cliente_id' => array(
			'rule' => 'notEmpty_f',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'imagen' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
    );

	
	function notEmpty_f($field){
		if ($this->data['User']['rol'] == 'cliente') {
			if (empty($field['cliente_id'])) {
				return false;
			}
			return true;
		}
		return true;
	}
	
	
	
	function isUnique_user($field) {
		if ($field['username'] != 'no_usuario') {
			$user_id = $this->data['User']['id'];
			$user = $this->find('first',array(
				'conditions' => array(
					'username' => $field['username'],
					'User.id !=' => $user_id
				)
			));
			if (!empty($user)) {
				return false;
			}
		} 
		return true;
	}
}



?>