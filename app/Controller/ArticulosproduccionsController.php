<?php

class ArticulosproduccionsController extends AppController {
    
	public $helpers = array ('Html','Form', 'Herra');
	public $components = array('Session','JqImgcrop','RequestHandler', 'Search.Prg');
	public $uses = array('Articulosproduccion','Materiasprimasproduccion','Pedidosproduccion');
    public $presetVars = true; // using the model configuration
	public $paginate = array();
	
    function admin_index() {
		$articulos = $this->Articulosproduccion->find('all');
		$this->set(compact('articulos'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$guardo = true;
			$data = $this->data;
			$data['Articulosproduccion']['codigo'] = strtoupper($data['Articulosproduccion']['codigo']);
			if (!empty($this->data['Articulosproduccion']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulosproduccion']['Foto'], 'img/articulosProduccion', '')) {
					$data['Articulosproduccion']['imagen'] = $this->data['Articulosproduccion']['Foto']['name'];
				}
			}
			if (!empty($this->data['Articulosproduccion']['Foto1']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulosproduccion']['Foto1'], 'img/articulosProduccion', '')) {
					$data['Articulosproduccion']['imagen1'] = $this->data['Articulosproduccion']['Foto1']['name'];
				}
			}
			if (!empty($this->data['Articulosproduccion']['Foto2']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulosproduccion']['Foto2'], 'img/articulosProduccion', '')) {
					$data['Articulosproduccion']['imagen2'] = $this->data['Articulosproduccion']['Foto2']['name'];
				}
			}
			if (!empty($data['Articulosproduccion']['imagen'])){
				if (!empty($data['Articulosproduccion']['materiasproduccion_id']) || !empty($data['Articulosproduccion']['cantidad'])) {
					if ($this->Articulosproduccion->save($data, array('validate' => 'first'))) {
						$this->Session->setFlash("El articulo ha sido guardado exitósamente");
						$this->redirect(array('action' => 'admin_index'));
					} 
				} else {
					$this->Session->setFlash("Debes seleccionar una materia prima con cantidad mayor a 0");
				}
			} else {
				$this->Session->setFlash("Debes seleccionar una foto");
			}
		} 
		if (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Articulosproduccion->findById($id);
		} else {
			$titulo = "Agregar";
		}
		$materiasprimasproduccions = $this->Materiasprimasproduccion->find('list',array(
			'fields' => array('Materiasprimasproduccion.id','Materiasprimasproduccion.descripcion'),
		));
		$this->set(compact('id','titulo','materiasprimasproduccions'));
	}
	
	function admin_eliminar($id) {
		$this->Articulosproduccion->delete($id);
		$this->Session->setFlash("El artículo se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_catalogo() {
		$articulos = $this->Articulosproduccion->find('all');
		$this->set(compact('articulos'));
		if (!empty($this->data['activo'])) {
			$data = $this->data;
			foreach ($data['activo'] as $key => $d) {
				if ($d == '1'){
					$articulo_id = $key;
				}
			}
			if (!empty($data['cantidad1'][$articulo_id]) && $data['cantidad1'][$articulo_id] > 0) {
				$user_id = $this->Auth->User('id');
				$ultimo_pedido = $this->Pedidosproduccion->find('first',array(
					'order' => array('Pedidosproduccion.fecha DESC')
				));
				if (!empty($ultimo_pedido)) {
					$numero = $ultimo_pedido['Pedidosproduccion']['numero'] +1;
				} else {
					$numero = 1;
				}
				$articulo = $this->Articulosproduccion->findById($articulo_id);
				$numero_piezas = $data['cantidad1'][$articulo_id]/$articulo['Articulosproduccion']['cantidad'];
				$nuevo = array('Pedidosproduccion' => array(
					'articulosproduccion_id' => $articulo_id,
					'cantidad' => $numero_piezas,
					'user_id' => $user_id,
					'numero' => $numero
				));
				$this->Pedidosproduccion->save($nuevo);
				$this->Session->setFlash('La orden se creó con exito');
				$this->redirect(array('controller' => 'pedidosproduccions','action'=>'admin_index'));
			} else {
				$this->Session->setFlash('La cantidad debe ser mayor a 0');
			}
		}
	}
	
	function admin_ver($id){
		$articulo = $this->Articulosproduccion->findById($id);
		$this->set(compact('articulo'));
	}
	
	function cantidad_piezas(){
		$cantidad = $_POST['cantidad'];
		$articulo_id = $_POST['articulo'];
		$articulo = $this->Articulosproduccion->findById($articulo_id);
		$numero_piezas = number_format($cantidad/$articulo['Articulosproduccion']['cantidad'],0,',','.');
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($numero_piezas);
	}
}

?>