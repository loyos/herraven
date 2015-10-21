<?php

class ContenidosController extends AppController {
    
	public $helpers = array ('Html','Form','Herra');
	var $uses = array('Contenido','Imagen', 'Config');
	public $components = array('Session','JqImgcrop','RequestHandler', 'Search.Prg');
	
    function admin_index() {
		$contenidos = $this->Contenido->find('all',array(
			'conditions' => array('Contenido.ubicacion' => '')
		));
		$this->set(compact('contenidos'));
    }
	
	function admin_footer() {
		$contenidos = $this->Contenido->find('all',array(
			'conditions' => array('Contenido.ubicacion' => 'abajo')
		));
		$this->set(compact('contenidos'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)){
			$data = $this->data;
			if (!empty($this->data['Contenido']['Imagen']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Contenido']['Imagen'], 'img/contenido', '')) {
					$data['Contenido']['imagen'] = $this->data['Contenido']['Imagen']['name'];
				}
			}
			$this->Contenido->save($data);
			$this->Session->setFlash("El contenido se guardó con éxito");
			$this->redirect(array('action' => 'admin_index'));
		}
		if (!empty($id)) {
			$this->data = $this->Contenido->findById($id);
			//var_dump($this->data);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$this->set(compact('id','titulo'));
	}
	
	function admin_editar_footer($id = null) {
		if (!empty($this->data)){	
			$data = $this->data;
			if (!empty($this->data['Imagen']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Imagen']['Foto'], 'img/contenido', '')) {
					$data['Imagen']['imagen'] = $this->data['Imagen']['Foto']['name'];
					$data['Imagen']['contenido_id'] = $data['Contenido']['id'];
					$this->Imagen->save($data);
				}
			}
			$this->Contenido->save($data);
			$this->Session->setFlash("El contenido se guardó con éxito");
			$this->redirect(array('action' => 'admin_footer'));
		}
		if (!empty($id)) {
			$this->data = $this->Contenido->findById($id);
			//var_dump($this->data);
			$imagen = $this->Imagen->find('first',array(
				'conditions' => array('Imagen.contenido_id' => $id)
			));
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$this->set(compact('id','titulo','imagen'));
	}
	
	function admin_eliminar($id) {
		$this->Contenido->delete($id);
		$this->Session->setFlash("El contenido se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_home() {
		$imagenes = $this->Imagen->find('all');
		$this->set(compact('imagenes'));
	}
	
	function admin_agregar_imagen(){
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['Imagen']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Imagen']['Foto'], 'img/home', '')) {
					$data['Imagen']['imagen'] = $this->data['Imagen']['Foto']['name'];
					$this->Imagen->save($data);
					$this->Session->setFlash("Se agrego una imagen con éxito");
					$this->redirect(array('action' => 'admin_home'));
				}
			}
		}
	}
	
	function admin_agregar_imagen_contenido($id){
		if (!empty($this->data)) {
			$data = $this->data;
			$id =$data['Imagen']['contenido'];
			if (!empty($this->data['Imagen']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Imagen']['Foto'], 'img/contenido', '')) {
					$data['Imagen']['imagen'] = $this->data['Imagen']['Foto']['name'];
					$data['Imagen']['contenido_id'] = $data['Imagen']['contenido'];
					$this->Imagen->save($data);
					$this->Session->setFlash("Se agregó una imagen con éxito");
					$this->redirect(array('action' => 'admin_agregar_imagen_contenido',$id));
				}
			}
		}
		$imagenes = $this->Imagen->find('all',array(
			'conditions' => array('Imagen.contenido_id' => $id)
		));
		$this->set(compact('id','imagenes'));
	}
	
	function admin_eliminar_imagen($id,$accion=null,$id_contenido=null) {
		$this->Imagen->delete($id);
		$this->Session->setFlash("La imagen eliminó con éxito");
		if (empty($accion)) {
			$accion = 'admin_home';
		}
		$this->redirect(array('action' => $accion,$id_contenido));
	}
	
	function admin_social_network(){
		$config = $this->Config->find('first');
		if(!empty($this->data)){
			$this->Config->id = 1;
			$saved = $this->Config->save($this->data);
			if($saved) { 
				$this->Session->setFlash("URLs actualizadas con exito");
			}else{
				$this->Session->setFlash("URLs no han sido actualizadas, intente nuevamente");
			}
		}else{
			$this->data = $config;
		}
	}
	
	function admin_home_message(){
		$config = $this->Config->find('first');
		if(!empty($this->data)){
			$this->Config->id = 1;
			$saved = $this->Config->save($this->data);
			if($saved) { 
				$this->Session->setFlash("El mensaje ha sido actualizado con éxito");
			}else{
				$this->Session->setFlash("El mensaje no ha sido actualizado, intente nuevamente");
			}
		}else{
			$this->data = $config;
		}
	}
}

?>