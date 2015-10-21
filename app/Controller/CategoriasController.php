<?php

class CategoriasController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Categoria','Subcategoria','Articulo');
	
    function admin_index() {
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		foreach ($categorias as $cat) {
			if (!empty($cat['Subcategoria'])){
				foreach($cat['Subcategoria'] as $sub) {
					$articulos = $this->Articulo->find('all',array(
						'conditions' => array('Articulo.subcategoria_id' => $sub['id'])
					));
					if (!empty($articulos)) {
						$eliminar_cat[$cat['Categoria']['id']] = 1;
					} else {
						$eliminar_cat[$cat['Categoria']['id']] = 0;
					}
					
				}
			} else {
				$eliminar_cat[$cat['Categoria']['id']] = 0;
			}
		}
	
		$this->set(compact('categorias','eliminar_cat'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			} else {
				$titulo = "";
			}
		} elseif (!empty($id)) {
			$this->data = $this->Categoria->findById($id);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Categoria->delete($id);
		$this->Session->setFlash("La categoria se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}

}

?>