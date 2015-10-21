<?php

class MoldesController extends AppController {
    
	public $helpers = array ('Html','Form','Herra');
	var $uses = array('Molde','Pedidosmolde','Materiasprimasmolde');
	public $components = array('Search.Prg','JqImgcrop','RequestHandler');
	public $presetVars = true; // using the model configuration
	public $paginate = array();
	
	function admin_index(){
		$moldes = $this->Molde->find('all');
		$this->set(compact('moldes'));
	}
	
	function admin_editar($id = null){
		$titulo = 'Agregar Molde';
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['Molde']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Molde']['Foto'], 'img/moldes', '')) {
					$data['Molde']['imagen_1'] = $this->data['Molde']['Foto']['name'];
				}
			}
			if (!empty($this->data['Molde']['Foto1']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Molde']['Foto1'], 'img/moldes', '')) {
					$data['Molde']['imagen_2'] = $this->data['Molde']['Foto1']['name'];
				}
			}
			if (!empty($this->data['Molde']['Foto2']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Molde']['Foto2'], 'img/moldes', '')) {
					$data['Molde']['imagen_3'] = $this->data['Molde']['Foto2']['name'];
				}
			}
			if (empty($data['Molde']['imagen_1'])) {
				$this->Session->setFlash("Debes seleccionar una foto");
			} else {
				if ($this->Molde->save($data)) {
					$this->Session->setFlash("El molde se ha guardado con éxito");
					$this->redirect(array('action' => 'admin_index'));
				} else {
					$this->Session->setFlash("Corrija los errores");
				}
			}
		}
		if(!empty($id)) {
			$this->data = $this->Molde->findById($id);
			$titulo = 'Editar Molde';
		}
		$materiasprimasmoldes = $this->Materiasprimasmolde->find('list',array(
			'fields' => array('Materiasprimasmolde.id','Materiasprimasmolde.descripcion')
		));
		$this->set(compact('titulo','materiasprimasmoldes'));
	}
	
	function admin_catalogo() {
		if (empty($this->data['activo'])) {
			$this->Prg->commonProcess();
			$parametros = $this->Prg->parsedParams();
		}
		if (!empty($paramentros) && $parametros && empty($this->data['activo'])){
			$this->paginate['conditions'] = $this->Molde->parseCriteria($this->Prg->parsedParams());
			$moldes = $this->paginate();
		}else{
			$moldes = $this->Molde->find('all');
		}
		$this->set(compact('moldes'));
		if (!empty($this->data['activo'])) {
			$data = $this->data;
			foreach ($data['activo'] as $key => $d) {
				if ($d == '1'){
					$molde_id = $key;
				}
			}
			if (!empty($data['cantidad'][$molde_id]) && $data['cantidad'][$molde_id] > 0) {
				$user_id = $this->Auth->User('id');
				$ultimo_pedido = $this->Pedidosmolde->find('first',array(
					'order' => array('Pedidosmolde.fecha DESC')
				));
				if (!empty($ultimo_pedido)) {
					$numero = $ultimo_pedido['Pedidosmolde']['numero'] +1;
				} else {
					$numero = 1;
				}
				$nuevo = array('Pedidosmolde' => array(
					'molde_id' => $molde_id,
					'cantidad' => $data['cantidad'][$molde_id],
					'user_id' => $user_id,
					'numero' => $numero,
					'comentario' => $data['comentario'][$molde_id],
				));
				$this->Pedidosmolde->save($nuevo);
				$this->Session->setFlash('La orden se creó con exito');
				$this->redirect(array('controller' => 'pedidosmoldes','action'=>'admin_index'));
			} else {
				$this->Session->setFlash('La cantidad debe ser mayor a 0');
			}
		}
	}
	
	function buscar_unidad() {
		$this->loadModel('Materiasprimasmolde');
		$m = $this->Materiasprimasmolde->findById($_POST['mp']);
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($m['Materiasprimasmolde']['unidad']);
	}
}

?>