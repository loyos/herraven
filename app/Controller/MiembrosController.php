<?php
App::uses('CakeEmail', 'Network/Email');
class MiembrosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	var $uses = array('User','Miembro','Config','Unidad','Departamento','Division');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$miembros = $this->Miembro->find('all',array(
			'recursive' => 3,
			'conditions' => array('Miembro.status <>' => 'Retirado' )
		));
		//Busco los jefes de depto. para asignarselo en la vista
		// $jefes_d = $this->Departamento->find('all');
		// $usuarios_d[] = 0;
		// foreach ($jefes_d as $d){
			// $usuarios_d[] = $d['Departamento']['user_id'];
		// }
		// $miembros_jefes_d = $this->Miembro->find('all',array(
			// 'conditions' => array('Miembro.user_id' => $usuarios_d)
		// ));
		// foreach ($miembros_jefes_d as $d) {
			// $buscar_d = $this->Departamento->find('first',array(
				// 'conditions' => array('Departamento.user_id' => $d['Miembro']['user_id'])
			// ));
			// $departamento_miembros[$d['Miembro']['id']] =  $buscar_d['Departamento']['nombre'];
		// }
		
		// //Busco los jefes de division. para asignarselo en la vista
		// $jefes_di = $this->Division->find('all');
		// $usuarios_di[] = 0;
		// foreach ($jefes_di as $d){
			// $usuarios_di[] = $d['Division']['user_id'];
		// }
		// $miembros_jefes_di = $this->Miembro->find('all',array(
			// 'conditions' => array('Miembro.user_id' => $usuarios_di)
		// ));
		// foreach ($miembros_jefes_di as $d) {
			// $buscar_di = $this->Division->find('first',array(
				// 'conditions' => array('Division.user_id' => $d['Miembro']['user_id'])
			// ));
			// $division_miembros[$d['Miembro']['id']] =  $buscar_d['Division']['nombre'];
		// }
		
		$this->set(compact('miembros'));
    }
	
	 function admin_retirados() {
		$miembros = $this->Miembro->find('all',array(
			'recursive' => 3,
			'conditions' => array('Miembro.status' => 'Retirado' )
		));
		$this->set(compact('miembros'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($data['Miembro']['telefono_uno'])) {
				$data['Miembro']['telefono'] = $data['Miembro']['codigo_uno'].'-'.$data['Miembro']['telefono_uno'];
			}
			if (!empty($data['Miembro']['telefono_celular'])) {
				$data['Miembro']['celular'] = $data['Miembro']['codigo_celular'].'-'.$data['Miembro']['telefono_celular'];
			}
			if (!empty($data['Miembro']['telefono_t1c1'])) {
				$data['Miembro']['tlf1_contacto1'] = $data['Miembro']['codigo_t1c1'].'-'.$data['Miembro']['telefono_t1c1'];
			}
			if (!empty($data['Miembro']['telefono_t2c1'])) {
				$data['Miembro']['tlf2_contacto1'] = $data['Miembro']['codigo_t2c1'].'-'.$data['Miembro']['telefono_t2c1'];
			}
			if (!empty($data['Miembro']['telefono_t1c2'])) {
				$data['Miembro']['tlf1_contacto2'] = $data['Miembro']['codigo_t1c2'].'-'.$data['Miembro']['telefono_t1c2'];
			}
			if (!empty($data['Miembro']['telefono_t2c2'])) {
				$data['Miembro']['tlf2_contacto2'] = $data['Miembro']['codigo_t2c2'].'-'.$data['Miembro']['telefono_t2c2'];
			}
			if (!empty($data['Miembro']['telefono_t1c3'])) {
				$data['Miembro']['tlf1_contacto3'] = $data['Miembro']['codigo_t1c3'].'-'.$data['Miembro']['telefono_t1c3'];
			}
			if (!empty($data['Miembro']['telefono_t2c1'])) {
				$data['Miembro']['tlf2_contacto3'] = $data['Miembro']['codigo_t2c3'].'-'.$data['Miembro']['telefono_t2c3'];
			}
			if ($this->data['Miembro']['es_usuario'] == 0){
				$data['User']['username'] = 'no_usuario';
				$data['User']['usuario'] = 0;
			} else {
				$data['User']['usuario'] = 1;
			}
			if (!empty($this->data['User']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['User']['Foto'], 'img/users', '')) {
					$data['User']['imagen'] = $this->data['User']['Foto']['name'];
				}
			} elseif (!empty($id)) {
				$m = $this->Miembro->findById($id);
				$u = $this->User->findById($m['Miembro']['user_id']);
				$data['User']['imagen'] = $u['User']['imagen'];
			}
			if (!empty($data['User']['imagen'])) {
				if (!empty($this->data['Miembro']['Test']['name'])) {
					if ($this->JqImgcrop->uploadImage($this->data['Miembro']['Test'], 'img/users/test', '')) {
						$data['Miembro']['imagen_test'] = $this->data['Miembro']['Test']['name'];
					}
				}
				$this->Miembro->set($data);
				if ($this->Miembro->validates()) {	
					if ($this->User->save($data,array('validate' => 'first'))) {	
						//var_dump($data);die();
						$id_user = $this->User->id;
						$data['Miembro']['user_id'] = $id_user;
						if (empty($data['Miembro']['id'])) {
							$data['Miembro']['unidad_id'] = 1;
						}
						$this->Miembro->save($data);
						$this->Session->setFlash("Los datos se guardaron con éxito");
						$this->redirect(array('action' => 'admin_index'));
					}
				} else {
					$titulo = '';
				}
			} else {
				$this->Session->setFlash("Debes seleccionar una foto");
				$this->redirect(array('action' => 'admin_editar',$id));
			}
		} elseif (!empty($id)) {
			$this->data = $this->Miembro->findById($id);
			$m = $this->Miembro->findById($id);
			$u = $this->User->findById($m['Miembro']['user_id']);
			$id_user = $u['User']['id'];
			$titulo = 'Editar miembro del personal';
			$data = $this->data;
			if (!empty($data['Miembro']['telefono'])) {
				$codigo_uno = explode('-',$data['Miembro']['telefono']);
				$data['Miembro']['codigo_uno'] = $codigo_uno[0];
				$data['Miembro']['telefono_uno'] = $codigo_uno[1];
			}
			if (!empty($data['Miembro']['celular'])) {
				$codigo_celular = explode('-',$data['Miembro']['celular']);
				$data['Miembro']['codigo_celular'] = $codigo_celular[0];
				$data['Miembro']['telefono_celular'] = $codigo_celular[1];
			}
			if (!empty($data['Miembro']['tlf1_contacto1'])) {
				$codigo_t1c1 = explode('-',$data['Miembro']['tlf1_contacto1']);
				$data['Miembro']['codigo_t1c1'] = $codigo_t1c1[0];
				$data['Miembro']['telefono_t1c1'] = $codigo_t1c1[1];
			}
			if (!empty($data['Miembro']['tlf2_contacto1'])) {
				$codigo_t2c1 = explode('-',$data['Miembro']['tlf2_contacto1']);
				$data['Miembro']['codigo_t2c1'] = $codigo_t2c1[0];
				$data['Miembro']['telefono_t2c1'] = $codigo_t2c1[1];
			}
			if (!empty($data['Miembro']['tlf1_contacto2'])) {
				$codigo_t1c2 = explode('-',$data['Miembro']['tlf1_contacto2']);
				$data['Miembro']['codigo_t1c2'] = $codigo_t1c2[0];
				$data['Miembro']['telefono_t1c2'] = $codigo_t1c2[1];
			}
			if (!empty($data['Miembro']['tlf2_contacto2'])) {
				$codigo_t2c2 = explode('-',$data['Miembro']['tlf2_contacto2']);
				$data['Miembro']['codigo_t2c2'] = $codigo_t2c2[0];
				$data['Miembro']['telefono_t2c2'] = $codigo_t2c2[1];
			}
			if (!empty($data['Miembro']['tlf1_contacto3'])) {
				$codigo_t1c3 = explode('-',$data['Miembro']['tlf1_contacto3']);
				$data['Miembro']['codigo_t1c3'] = $codigo_t1c3[0];
				$data['Miembro']['telefono_t1c3'] = $codigo_t1c3[1];
			}
			if (!empty($data['Miembro']['tlf2_contacto3'])) {
				$codigo_t2c3 = explode('-',$data['Miembro']['tlf2_contacto3']);
				$data['Miembro']['codigo_t2c3'] = $codigo_t2c3[0];
				$data['Miembro']['telefono_t2c3'] = $codigo_t2c3[1];
			}
			$this->data = $data;
		} else {
			$titulo = 'Agrega un miembro al personal';
		}
		
		$this->set(compact('id','titulo','id_user'));
	}
	
	function admin_eliminar($id) {
		$this->Miembro->delete($id);
		$this->Session->setFlash("El miembro del personal se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$hoy = date('d-m-Y');
		$miembro = $this->Miembro->find('first',array(
			'conditions' => array(
				'Miembro.id' => $id
			),
			'recursive' => 3
		));
		if ($miembro['Miembro']['fecha_retiro'] == '0000-00-00 00:00:00') {
			$tiempo_trabajo = $this->Config->obtenerIntervaloFechas($miembro['Miembro']['fecha_ingreso']);
		} else {
			$tiempo_trabajo = $this->Config->obtenerIntervaloFechas($miembro['Miembro']['fecha_ingreso'],$miembro['Miembro']['fecha_retiro']);
		}
		$edad = $this->Config->obtenerIntervaloFechas($miembro['Miembro']['fecha_nacimiento']);
		$this->set(compact('miembro','tiempo_trabajo','edad','hoy','id'));
	}
	
	function reset_password(){
		$menu = $this->Contenido->find('all');
		$this->set(compact('menu'));		
		$this->layout = 'home';
		
		if (!empty($this->data)) {
			$existe = $this->User->find('first',array(
				'conditions' => array('User.username' => $this->data['User']['username'])
			));
			if (!empty($existe)){
				$clave = $this->generaPass();
				$username = $existe['User']['username'];
				$nombre = $existe['User']['nombre'];
				$apellido = $existe['User']['apellido'];
				$update = array('User'=>array(
					'id' => $existe['User']['id'],
					'password' => $clave
				));
				$this->User->save($update);
				$Email = new CakeEmail();
				$Email->from(array('me@example.com' => 'Herraven.com'));
				$Email->emailFormat('html');
				$Email->to($existe['User']['email']);
				$Email->subject('Nueva clave');
				$Email->template('cambiar_password');
				$Email->viewVars(compact('username','apellido','nombre','clave'));
				$Email->send();
				$this->Session->setFlash('En breve recibirás un correo para restablecer tu contraseña');
				$this->redirect(array('controller'=>'users', 'action'=>'login'));
			} else {
				$this->Session->setFlash('No existe un usuario registrado con este username', 'login_flash');
				$this->redirect(array('action' => 'reset_password'));
			}
		}
	}
	
	function generaPass(){
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$longitudCadena=strlen($cadena);
		$pass = "";
		$longitudPass=10;
		for($i=1 ; $i<=$longitudPass ; $i++){
			$pos=rand(0,$longitudCadena-1);
			$pass .= substr($cadena,$pos,1);
		}
		return $pass;
	}
	
	function admin_finalizar($id){
		if (!empty($this->data)) {
			$data = $this->data;
			$data['Miembro']['status'] = 'Retirado';
			$hoy = date('Y-m-d H:i:s');
			$data['Miembro']['fecha_retiro'] = $hoy;
			$this->Miembro->save($data);
			$this->Session->setFlash("El miembro del personal ha sido retirado");
			$this->redirect(array('action' => "admin_index"));
		}
		$this->set(compact('id'));
	}
}

?>