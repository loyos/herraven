<?php



class SubcategoriaminumetsController extends AppController {

    

	public $helpers = array ('Html','Form');

	var $uses = array('Subcategoriaminumet','Articuloproduccion','Lineasminumet');

	

    function admin_index() {

		$subcategorias = $this->Subcategoriaminumet->find('all',array(

			'contain' => array('Articulosproduccion')

		));

		foreach ($subcategorias as $cat) {

			if (!empty($cat['Articulosproduccion'])){

				$eliminar_cat[$cat['Subcategoriaminumet']['id']] = 1;

			} else {

				$eliminar_cat[$cat['Subcategoriaminumet']['id']] = 0;

			}

		} 

		$this->set(compact('subcategorias','eliminar_cat'));

    }

	

	function admin_editar($id = null) {

		if (!empty($this->data)) {

			if ($this->Subcategoriaminumet->save($this->data)) {

				$this->Session->setFlash("Los datos se guardaron con éxito");

				$this->redirect(array('action' => 'admin_index'));

			} else {

				$titulo = "";

			}

		} elseif (!empty($id)) {

			$this->data = $this->Subcategoriaminumet->findById($id);

			$titulo = 'Editar';

		} else {

			$titulo = 'Agregar';

		}

		$lineasminumets = $this->Lineasminumet->find('list',array(

			'fields' => array('id','descripcion')

		));

		$this->set(compact('id','titulo','lineasminumets'));

	}

	

	function admin_eliminar($id) {

		$this->Subcategoriaminumet->delete($id);

		$this->Session->setFlash("La categoria se eliminó con éxito");

		$this->redirect(array('action' => 'admin_index'));

	}

	

}



?>