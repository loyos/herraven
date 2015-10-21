<?php

class SubcategoriasController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Subcategoria','Articulo','Categoria');
	
    function admin_index() {
		$subcategorias = $this->Subcategoria->find('all',array(
			'contain' => array('Articulo')
		));
		foreach ($subcategorias as $cat) {
			if (!empty($cat['Articulo'])){
				$eliminar_cat[$cat['Subcategoria']['id']] = 1;
			} else {
				$eliminar_cat[$cat['Subcategoria']['id']] = 0;
			}
		} 
		$this->set(compact('subcategorias','eliminar_cat'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			if ($this->Subcategoria->save($this->data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			} else {
				$titulo = "";
			}
		} elseif (!empty($id)) {
			$this->data = $this->Subcategoria->findById($id);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$categorias = $this->Categoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$this->set(compact('id','titulo','categorias'));
	}
	
	function admin_eliminar($id) {
		$this->Subcategoria->delete($id);
		$this->Session->setFlash("La subcategoria se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
}

?>