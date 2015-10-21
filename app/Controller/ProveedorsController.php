<?php
App::uses('CakeEmail', 'Network/Email');
class ProveedorsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Herramienta','Config','Proveedor','Materiasprima','Insumo','LotesHerramientasProveedor','LotesProveedor','MateriasprimasProveedor','Herramienta','Insumo','Lote','Lotesherramienta','LotesherramientasProveedor','LotesProveedor');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$proveedores = $this->Proveedor->find('all',array(
			'recursive' => 1
		));
		$this->set(compact('proveedores'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			$data['Proveedor']['telefono'] = $data['Proveedor']['codigo_uno'].'-'.$data['Proveedor']['telefono_uno'];
			if (!empty($data['Proveedor']['telefono_dos'])) {
				$data['Proveedor']['telefono2'] = $data['Proveedor']['codigo_dos'].'-'.$data['Proveedor']['telefono_dos'];
			}
			if (!empty($data['Proveedor']['fax'])) {
				$data['Proveedor']['fax'] = $data['Proveedor']['codigo_fax'].'-'.$data['Proveedor']['fax'];
			}
			if ($this->Proveedor->validates()) {	
				if (!empty($data['Proveedor']['tipo_id'])) {
					$data['Proveedor']['tipo']= $data['Proveedor']['tipo_id'];
					if ($this->Proveedor->save($data,array('validate' => 'first'))) {
						if (!empty($data['Proveedor']['id'])) {
							$id_p = $data['Proveedor']['id'];
						} else {
							$id_p = $this->Proveedor->id;
						}
						if (!empty($data['Proveedor']['id'])) {
							//Borro todos los suministros viejos
							$this->LotesherramientasProveedor->deleteAll(array('LotesherramientasProveedor.proveedor_id' => $data['Proveedor']['id']));
							$this->LotesProveedor->deleteAll(array('LotesProveedor.proveedor_id' => $data['Proveedor']['id']));
							$this->MateriasprimasProveedor->deleteAll(array('MateriasprimasProveedor.proveedor_id' => $data['Proveedor']['id']));
						}
						if ($data['Proveedor']['tipo_id'] == 'herramientas' && !empty($data['Proveedor']['lotesherramienta_id'])) {
							$nuevo = array('LotesherramientasProveedor' => array(
								'lotesherramienta_id' => $data['Proveedor']['lotesherramienta_id'],
								'proveedor_id' => $id_p
							));
							$this->LotesherramientasProveedor->save($nuevo);
						}
						if ($data['Proveedor']['tipo_id'] == 'insumos' && !empty($data['Proveedor']['lote_id'])) {
							$nuevo = array('LotesProveedor' => array(
								'lote_id' => $data['Proveedor']['lote_id'],
								'proveedor_id' => $id_p
							));
							$this->LotesProveedor->save($nuevo);
						}
						if ($data['Proveedor']['tipo_id'] == 'materiasprimas' && !empty($data['materias'])) {
							foreach ($data['materias'] as $a) {
								if ($a != 0) {
									$nuevo = array('MateriasprimasProveedor' => array(
										'materiasprima_id' => $a,
										'proveedor_id' => $id_p
									));
									$this->MateriasprimasProveedor->create();
									$this->MateriasprimasProveedor->save($nuevo);
								}
							}
						}
					}
				}
					$this->Session->setFlash("Los datos se guardaron con éxito");
					$this->redirect(array('action' => 'admin_index'));
			} else {
				$titulo = '';
			}
		} 
		if (!empty($id)) {
			$this->data = $this->Proveedor->findById($id);
			$data = $this->data;
			$titulo = 'Editar proveedor';
			$codigo_uno = explode('-',$data['Proveedor']['telefono']);
			$data['Proveedor']['codigo_uno'] = $codigo_uno[0];
			$data['Proveedor']['telefono_uno'] = $codigo_uno[1];
			if (!empty($data['Proveedor']['telefono2'])) {
				$codigo_dos = explode('-',$data['Proveedor']['telefono_dos']);
				$data['Proveedor']['codigo_dos'] = $codigo_dos[0];
				$data['Proveedor']['telefono_dos'] = $codigo_dos[1];
			}
			if (!empty($data['Proveedor']['fax'])) {
				$codigo_fax = explode('-',$data['Proveedor']['fax']);
				$data['Proveedor']['codigo_fax'] = $codigo_fax[0];
				$data['Proveedor']['fax'] = $codigo_fax[1];
			}
			$this->data = $data;
			$proveedor = $this->data;
			$tipo = $proveedor['Proveedor']['tipo'];
			if ($tipo == 'herramientas') {
				$herramientas_b = $this->LotesherramientasProveedor->find('first',array(
					'conditions' => array('LotesherramientasProveedor.proveedor_id' => $proveedor['Proveedor']['id'])
				));
				if (!empty($herramientas_b)) {
					$herramientas = $herramientas_b['LotesherramientasProveedor']['lotesherramienta_id'];
				}
			}
			if ($tipo == 'insumos') {
				$insumos_b = $this->LotesProveedor->find('first',array(
					'conditions' => array('LotesProveedor.proveedor_id' => $proveedor['Proveedor']['id'])
				));
				if (!empty($insumos_b)) {
					$insumos = $insumos_b['LotesProveedor']['lote_id'];
				}
			}
			if ($tipo == 'materiasprimas') {
				$materias = $this->MateriasprimasProveedor->find('all',array(
					'conditions' => array('MateriasprimasProveedor.proveedor_id' => $proveedor['Proveedor']['id'])
				));
			}
		} else {
			$titulo = 'Agregar proveedor';
		}
		$tipos = array('0' => "",'herramientas' => 'Herramientas','insumos' => 'Insumos','materiasprimas' => 'Materias Prima');
		$lotesherramientas = $this->Lotesherramienta->find('list',array(
			'fields' => array('id','nombre')
		));
		$lotes = $this->Lote->find('list',array(
			'fields' => array('id','nombre')
		));
		$materiasprimas = $this->Materiasprima->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = "";
		$this->set(compact('id','titulo','tipos','tipo','lotesherramientas','lotes','materiasprimas','herramientas','insumos','materias'));
	}
	
	function admin_eliminar($id) {
		$this->Proveedor->delete($id);
		//Busco en las tablas asociadas al proveedor
		$this->LotesherramientasProveedor->deleteAll(array(
			'LotesherramientasProveedor.proveedor_id' => $id
		));
		$this->LotesProveedor->deleteAll(array(
			'LotesProveedor.proveedor_id' => $id
		));
		$this->MateriasprimasProveedor->deleteAll(array(
			'MateriasprimasProveedor.proveedor_id' => $id
		));
		
		$this->Session->setFlash("El proveedor se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$proveedor = $this->Proveedor->findById($id);
		$this->set(compact('proveedor'));
	}
	
	function admin_agregar_herramientas($id){
		if (!empty($this->data)){
			$this->HerramientasProveedor->save($this->data);
			$this->Session->setFlash("Se agregó una herramienta");
			$this->redirect(array('action' => 'admin_agregar_herramientas',$this->data['HerramientasProveedor']['proveedor_id']));
		}
		$herramientas_proveedor = $this->Proveedor->find('first',array(
			'conditions' => array(
				'Proveedor.id' => $id
			),
			'recursive' => 2
		));

		$herr[] = 0;
		foreach ($herramientas_proveedor['Herramienta'] as $h) {
			$herr[]=$h['id'];
		}
		$herramientas = $this->Herramienta->find('list',array(
			'fields' => array('Herramienta.id','Herramienta.nombre'),
			'conditions' => array(
				'NOT' => array( 'Herramienta.id' => $herr)
			)
		));
		$this->set(compact('herramientas_proveedor','herramientas','id'));
	}
	
	function admin_eliminar_herramienta($id,$h_id) {
		//Eliminar la relacion con el proveedor
		$herramientas_proveedores = $this->HerramientasProveedor->find('first',array(
			'conditions' => array(
				'HerramientasProveedor.herramienta_id' => $h_id,
				'HerramientasProveedor.proveedor_id' => $id,
			)
		));
		$this->HerramientasProveedor->delete($herramientas_proveedores['HerramientasProveedor']['id']);
		$this->Session->setFlash("La herramienta se eliminó con éxito");
		$this->redirect(array('action' => 'admin_agregar_herramientas',$id));
	}
	
	function admin_agregar_insumos($id){
		if (!empty($this->data)){
			$this->InsumosProveedor->save($this->data);
			$this->Session->setFlash("Se agregó un insumo");
			$this->redirect(array('action' => 'admin_agregar_insumos',$this->data['InsumosProveedor']['proveedor_id']));
		}
		$insumos_proveedor = $this->Proveedor->find('first',array(
			'conditions' => array(
				'Proveedor.id' => $id
			),
			'recursive' => 2
		));

		$herr[] = 0;
		foreach ($insumos_proveedor['Insumo'] as $h) {
			$herr[]=$h['id'];
		}
		$insumos = $this->Insumo->find('list',array(
			'fields' => array('Insumo.id','Insumo.nombre'),
			'conditions' => array(
				'NOT' => array( 'Insumo.id' => $herr)
			)
		));
		$this->set(compact('insumos_proveedor','insumos','id'));
	}
	
	function admin_eliminar_insumo($id,$h_id) {
		//Eliminar la relacion con el proveedor
		$insumos_proveedores = $this->InsumosProveedor->find('first',array(
			'conditions' => array(
				'InsumosProveedor.insumo_id' => $h_id,
				'InsumosProveedor.proveedor_id' => $id,
			)
		));
		$this->InsumosProveedor->delete($insumos_proveedores['InsumosProveedor']['id']);
		$this->Session->setFlash("El insumo se eliminó con éxito");
		$this->redirect(array('action' => 'admin_agregar_insumos',$id));
	}
	
	function admin_agregar_materiasprima($id){
		if (!empty($this->data)){
			$this->MateriasprimasProveedor->save($this->data);
			$this->Session->setFlash("Se agregó una materia prima");
			$this->redirect(array('action' => 'admin_agregar_materiasprima',$this->data['MateriasprimasProveedor']['proveedor_id']));
		}
		$materias_proveedor = $this->Proveedor->find('first',array(
			'conditions' => array(
				'Proveedor.id' => $id
			),
			'recursive' => 2
		));

		$mat[] = 0;
		foreach ($materias_proveedor['Materiasprima'] as $h) {
			$mat[]=$h['id'];
		}
		$materiasprimas = $this->Materiasprima->find('list',array(
			'fields' => array('Materiasprima.id','Materiasprima.descripcion'),
			'conditions' => array(
				'NOT' => array( 'Materiasprima.id' => $mat)
			)
		));
		$this->set(compact('materias_proveedor','materiasprimas','id'));
	}
	
	function admin_eliminar_materiasprima($id,$h_id) {
		//Eliminar la relacion con el proveedor
		$materias_proveedores = $this->MateriasprimasProveedor->find('first',array(
			'conditions' => array(
				'MateriasprimasProveedor.materiasprima_id' => $h_id,
				'MateriasprimasProveedor.proveedor_id' => $id,
			)
		));
		$this->MateriasprimasProveedor->delete($materias_proveedores['MateriasprimasProveedor']['id']);
		$this->Session->setFlash("El insumo se eliminó con éxito");
		$this->redirect(array('action' => 'admin_agregar_materiasprima',$id));
	}
}

?>