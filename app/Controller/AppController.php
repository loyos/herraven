<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authorize' => array('controller'),
        )
		
    );
	var $uses = array('ModulosRol', 'Contenido','Config', 'Modulo', 'Pedido');
	function beforeFilter() {
		$this->Auth->authorize = 'Controller'; 
		$user_id = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		$rol = $this->Auth->user('Rol.id');
		
		Security::setHash('md5');
		$this->Auth->allow('*');
		
		$username = $this->Auth->user('username');
		if (!empty($user_id)) {
			$modulos = $this->ModulosRol->find('all',array(
				'conditions' => array(
					'ModulosRol.rol_id' => $rol,
					'Modulo.modulo_id' => 0,
					'Modulo.activo' => 1
				),
				'order' => array('Modulo.orden')
			));
			foreach ($modulos as $m) {
				$modulos_id[] = $m['Modulo']['id'];
			}
			
			if (!empty($modulos_id)) {
				$submodulos = $this->ModulosRol->find('all',array(
					'conditions' => array(
						'ModulosRol.rol_id' => $rol,
						'Modulo.modulo_id' => $modulos_id,
						'Modulo.activo' => 1
					)
				));
				foreach ($submodulos as $s) {
					$submodulos_id[] = $s['Modulo']['id'];
				}
			}
		}
		
		$contacto = $this->Contenido->find('first', array(
			'conditions' => array(
				'alias' => 'contacto'
			) 
		)); // se tiene que tener un contenido con alias contacto a juro para que desde el home se pueda
		// hacer link a contacto desde el botón contáctanos
		$config = $this->Config->find('first');
		
		// hacemos el menu
		
			$menu_principal = $this->Modulo->find('all', array(
				'conditions' => array(
					'modulo_id' => 0
				),
				'recursive' => -1,
				'order' => array('Modulo.orden')
			));
			
			foreach ($menu_principal as $m){
				$sub_modulos = $this->Modulo->find('all', array(
					'conditions' => array(
						'modulo_id' => $m['Modulo']['id']
					), 
					'recursive' => -1,
					'order' => array('Modulo.orden')
				));
				
				$m['Modulo']['Submodulo'] = $sub_modulos;
					
				$menu[] = $m;
			}

			
		// termina el menu
		
		// numerito de pedidos
		$cliente_id = $this->Auth->user('cliente_id');
		$pedidos_pendientes = $this->Pedido->find('all', array(
			'conditions' => array(
				'cliente_id' => $cliente_id,
				'status !=' => array('Despachado', 'Cancelado'),
			)
		));
		$pedidos_despachado = $this->Pedido->find('all', array(
			'conditions' => array(
				'cliente_id' => $cliente_id,
				'status' => array('Despachado'),
			)
		));
		
		
		$this->set(compact('username','user_id','rol','modulos','submodulos','modulos_id','submodulos_id','contacto','config','menu','pedidos_pendientes','pedidos_despachado'));		
	}
	public function isAuthorized($user=null) {
		// if (strpos($this->action,'admin') === false) {
				// return true;
		// } else {
			// if (isset($user['rol']) && $user['rol'] === 'admin') {
				// return true;
			// } else {
				// return false;
			// }
		// }
		return true;
	}
}
