<?php
App::uses('CakeEmail', 'Network/Email');
class InsumosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	var $uses = array('User','Lote','Config','Insumo','Departamento','Lote','Division','Unidad','LotesProveedor');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
	function admin_index_lotes() {
		$lotes = $this->Lote->find('all');
		$this->set(compact('lotes'));
	}
	
	function admin_editar_lote($id=null){
		$titulo = 'Lote de Insumos';
		if (!empty($this->data)) {
			$this->Lote->save($this->data);
			$this->Session->setFlash("Los datos se guardaron con éxito");
			$this->redirect(array('controller' => 'herramientas','action' => 'admin_index_lotes'));
		}
		if (!empty($id)) {
			$this->data = $this->Lote->findById($id);
			$titulo = 'Editar Lote de Insumos';
			
			//Busco si tiene unidad para llenar los campos depto y division
			if (!empty($this->data['Lote']['unidad_id'])) {
				$unidad = $this->Unidad->findById($this->data['Lote']['unidad_id']);
				$id_unidad = $this->data['Lote']['unidad_id'];
				$id_departamento = $unidad['Unidad']['departamento_id'];
				$id_division = $unidad['Departamento']['division_id'];
				$unidads = $this->Unidad->find('list',array(
					'fields' => array('Unidad.id','Unidad.nombre'),
					'conditions' => array('Unidad.departamento_id' => $id_departamento )
				));
				$departamentos = $this->Departamento->find('list',array(
					'fields' => array('Departamento.id','Departamento.nombre'),
					'conditions' => array('Departamento.division_id' => $id_division )
				));
			}
		} else {
			$titulo = 'Agregar Lote de Insumos';
		}
		
		$divisions = $this->Division->find('list',array(
			'fields' => array('Division.id','Division.nombre'),
			'conditions' => array('Division.id <>' => 1 )
		));
		$divisions[0] = 'Escoge una división';
		$this->set(compact('id','titulo','divisions','departamentos','unidads','id_division','id_departamento','id_unidad'));
	}
	
	 function admin_index() {
		$insumos = $this->Insumo->find('all');
		$this->set(compact('insumos'));
    }
	
	function admin_editar($lote_id,$id = null) {	
		$titulo = 'Insumo';
		if (!empty($this->data)) {
			$this->Insumo->save($this->data);
			$this->Session->setFlash("Los datos se guardaron con éxito");
			$this->redirect(array('controller' => 'inventarioinsumos', 'action' => 'admin_index',$lote_id));
		}
		if (!empty($id)) {
			$this->data = $this->Insumo->findById($id);
			$titulo = 'Editar Insumo';
		} else {
			$titulo = 'Agregar Insumo';
		}
		$lotes = $this->Lote->find('list',array(
			'fields'=> array('Lote.id','Lote.nombre')
		));
		$this->set(compact('id','titulo','lotes'));
	}
	
	function admin_eliminar($lote_id,$id) {
		$this->Insumo->delete($id);
		$this->Session->setFlash("El insumo se eliminó con éxito");
		$this->redirect(array('controller' => 'inventarioinsumos', 'action' => 'admin_index',$lote_id));
	}
	
	function admin_eliminar_lote($id) {
		$this->Lote->delete($id);
		
		//Borrar los insumos del lote
		$insumos = $this->Insumo->find('all',array(
			'conditions' => array('Insumo.lote_id' => $id)
		));
		$aux[]=0;
		foreach ($insumos as $h) {
			$this->Insumo->delete($h['Insumo']['id']);
			$aux[] = $h['Insumo']['id'];
		}
		
		//Eliminar la relacion con los proveedores
		$insumos_proveedores = $this->LotesProveedor->find('all',array(
			'conditions' => array(
				'LotesProveedor.insumo_id' => $aux
			)
		));
		foreach ($insumos_proveedores as $h){
			$this->LotesProveedor->delete($h['LotesProveedor']['id']);
		}
		$this->Session->setFlash("El lote se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index_lotes'));
	}
	
	function buscar_departamentos(){
		$departamento = $this->Departamento->find('all', array(
			'conditions' => array('Departamento.division_id' => $_POST['division']),
		));
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($departamento);
	}
	
	function buscar_unidades(){
		$unidad = $this->Unidad->find('all', array(
			'conditions' => array('Unidad.departamento_id' => $_POST['departamento']),
		));
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($unidad);
	}
}

?>