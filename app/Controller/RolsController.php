<?php

class RolsController extends AppController {
    
	public $helpers = array ('Html','Form', 'Herra');
	public $components = array('Session','JqImgcrop','RequestHandler', 'Search.Prg');
	public $uses = array('Rol','Modulo','ModulosRol','BloquesRol');
    public $presetVars = true; // using the model configuration
	public $paginate = array();
	
    function admin_index() {
		$roles = $this->Rol->find('all');
		//Busco que bloques tiene cada rol
		foreach ($roles as $r) {
			$bloques[$r['Rol']['id']] = Set::combine($r['Bloque'], '{n}.id', '{n}.id');
		}
		$this->set(compact('roles','bloques'));
    }
	
	function admin_permisologia() {
		if (!empty($this->data['Rol']['bloque_cliente']) || !empty($this->data['Rol']['bloque_administrador']) || !empty($this->data['Rol']['bloque_produccion']) || !empty($this->data['Rol']['bloque_configuracion'])) {	
			$rol = $this->Rol->findById($this->data['Rol']['rol']);
			//borro todos los bloques que existen
			$this->BloquesRol->deleteAll(array('BloquesRol.rol_id' => $rol['Rol']['id']));
			$modulos_rol = $this->ModulosRol->find('all',array(
				'conditions' => array(
					'ModulosRol.rol_id' => $rol['Rol']['id'],
					'Modulo.activo' => 1
				)
			));
			$modulos_rol = Set::combine($modulos_rol, '{n}.ModulosRol.modulo_id', '{n}.ModulosRol.modulo_id');
			if($this->data['Rol']['bloque_cliente'] == 1) {
				$add = array('BloquesRol' => array(
					'rol_id' => $rol['Rol']['id'],
					'bloque_id' => 1
				));
				$this->BloquesRol->create();
				$this->BloquesRol->save($add);
				$bloques['Clientes']['modulos'] = $this->Modulo->find('all',array(
					'conditions' => array(
						'Modulo.bloque_id' => 1,
						'Modulo.modulo_id' => 0,
						'Modulo.activo' => 1
					)
				));
				$result = Set::combine($bloques['Clientes']['modulos'], '{n}.Modulo.id', '{n}.Modulo.id');
				$num_submodulo = 0;
				foreach ($result as $r) {
					$bloques['Clientes']['submodulos'][$r] = $this->Modulo->find('all',array(
						'conditions' => array(
							'Modulo.bloque_id' => 1,
							'Modulo.modulo_id' => $r,
							'Modulo.activo' => 1
						),
					));
					$submodulos = count($bloques['Clientes']['submodulos'][$r]);
					if ( $submodulos > $num_submodulo) {
						$num_submodulo = $submodulos;
					}
				}
				$bloques['Clientes']['num_submodulos'] = $num_submodulo;
			}
			if($this->data['Rol']['bloque_administrador'] == 1) {
				$bloques['Administracion']['modulos'] = $this->Modulo->find('all',array(
					'conditions' => array(
						'Modulo.bloque_id' => 2,
						'Modulo.modulo_id' => 0,
						'Modulo.activo' => 1
						)
				));
				$result = Set::combine($bloques['Administracion']['modulos'], '{n}.Modulo.id', '{n}.Modulo.id');
				$add = array('BloquesRol' => array(
					'rol_id' => $rol['Rol']['id'],
					'bloque_id' => 2
				));
				$this->BloquesRol->create();
				$this->BloquesRol->save($add);
				$num_submodulo = 0;
				foreach ($result as $r) {
					$bloques['Administracion']['submodulos'][$r] = $this->Modulo->find('all',array(
						'conditions' => array(
							'Modulo.bloque_id' => 2,
							'Modulo.modulo_id' => $r,
							'Modulo.activo' => 1
						),
					));
					$submodulos = count($bloques['Administracion']['submodulos'][$r]);
					if ( $submodulos > $num_submodulo) {
						$num_submodulo = $submodulos;
					}
				}
				$bloques['Administracion']['num_submodulos'] = $num_submodulo;
			}
			if($this->data['Rol']['bloque_produccion'] == 1) {
				$bloques['Produccion']['modulos'] = $this->Modulo->find('all',array(
					'conditions' => array(
						'Modulo.bloque_id' => 3,
						'Modulo.modulo_id' => 0,
						'Modulo.activo' => 1
					)
				));
				$add = array('BloquesRol' => array(
					'rol_id' => $rol['Rol']['id'],
					'bloque_id' => 3
				));
				$this->BloquesRol->create();
				$this->BloquesRol->save($add);
				$result = Set::combine($bloques['Produccion']['modulos'], '{n}.Modulo.id', '{n}.Modulo.id');
				$num_submodulo = 0;
				foreach ($result as $r) {
					$bloques['Produccion']['submodulos'][$r] = $this->Modulo->find('all',array(
						'conditions' => array(
							'Modulo.bloque_id' => 3,
							'Modulo.modulo_id' => $r,
							'Modulo.activo' => 1
						),
					));
					$submodulos = count($bloques['Produccion']['submodulos'][$r]);
					if ( $submodulos > $num_submodulo) {
						$num_submodulo = $submodulos;
					}
				}
				$bloques['Produccion']['num_submodulos'] = $num_submodulo;
			}
			if($this->data['Rol']['bloque_configuracion'] == 1) {
				$bloques['Configuracion']['modulos'] = $this->Modulo->find('all',array(
					'conditions' => array(
						'Modulo.bloque_id' => 4,
						'Modulo.modulo_id' => 0,
						'Modulo.activo' => 1
						)
				));
				$add = array('BloquesRol' => array(
					'rol_id' =>$rol['Rol']['id'],
					'bloque_id' => 4
				));
				$this->BloquesRol->create();
				$this->BloquesRol->save($add);
				$result = Set::combine($bloques['Configuracion']['modulos'], '{n}.Modulo.id', '{n}.Modulo.id');
				$num_submodulo = 0;
				foreach ($result as $r) {
					$bloques['Configuracion']['submodulos'][$r] = $this->Modulo->find('all',array(
						'conditions' => array(
							'Modulo.bloque_id' => 4,
							'Modulo.modulo_id' => $r,
							'Modulo.activo' => 1
						),
					));
					$submodulos = count($bloques['Configuracion']['submodulos'][$r]);
					if ( $submodulos > $num_submodulo) {
						$num_submodulo = $submodulos;
					}
				}
				$bloques['Configuracion']['num_submodulos'] = $num_submodulo;
			}
			$this->set(compact('rol','bloques','modulos_rol'));
		} else {
			$data = $this->data;
			//borro todos los modulos que existen en el rol
			$this->ModulosRol->deleteAll(array('ModulosRol.rol_id' => $data['Rol']['rol']));
			if (!empty($this->data['modulos_sel'])) {
				//debug($data['Rol']['modulos']);die();
				foreach ($data['modulos_sel'] as $id_m => $d) {
					if ($d == 1){
						$add = array('ModulosRol' => array(
							'modulo_id' => $id_m,
							'rol_id' => $data['Rol']['rol'],
						));
						$this->ModulosRol->create();
						$this->ModulosRol->save($add);
					}
				}
			}
			if (!empty($this->data['submodulos_sel'])) {
				foreach ($data['submodulos_sel'] as $id_m => $d) {
					if ($d == 1) {
						$add = array('ModulosRol' => array(
							'modulo_id' => $id_m,
							'rol_id' => $data['Rol']['rol'],
						));
						$this->ModulosRol->create();
						$this->ModulosRol->save($add);
					}
				}
			}
			$this->Session->setFlash('Los cambios se han guardado con éxito');
			$this->redirect(array('action' => 'admin_index'));
		}
	}
	
	function admin_editar($id = null,$array = null) {
		if (!empty($this->data)) {
			$this->Rol->save($this->data);
			$this->Session->setFlash('El rol se ha guardado con éxito');
			$this->redirect(array('action' => 'admin_index'));
		}
		$titulo = 'Agregar Rol';
		if (!empty($id)) {
			$this->data = $this->Rol->findById($id);
			$titulo = 'Editar Rol';
			$this->set(compact('id'));
		}
		$this->set(compact('titulo'));
	}
}

?>