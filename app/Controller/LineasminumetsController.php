<?php
class LineasminumetsController extends AppController {

    

	public $helpers = array ('Html','Form');

	var $uses = array('Lineasminumet','Articulosproduccion','Subcategoriaminumet');

	

    function admin_index() {

		$categorias = $this->Lineasminumet->find('all',array(

			'contain' => array('Subcategoriaminumet')

		));

		foreach ($categorias as $cat) {

			if (!empty($cat['Subcategoriaminumet'])){

				foreach($cat['Subcategoriaminumet'] as $sub) {

					$articulos = $this->Articulosproduccion->find('all',array(

						'conditions' => array('Articulo.subcategoria_id' => $sub['id'])

					));

					if (!empty($articulos)) {

						$eliminar_cat[$cat['Lineasminumet']['id']] = 1;

					} else {

						$eliminar_cat[$cat['Lineasminumet']['id']] = 0;

					}
					

				}

			} else {

				$eliminar_cat[$cat['Lineasminumet']['id']] = 0;

			}

		}

	

		$this->set(compact('categorias','eliminar_cat'));

    }

	

	function admin_editar($id = null) {

		if (!empty($this->data)) {

			if ($this->Lineasminumet->save($this->data)) {

				$this->Session->setFlash("Los datos se guardaron con éxito");

				$this->redirect(array('action' => 'admin_index'));

			} else {

				$titulo = "";

			}

		} elseif (!empty($id)) {

			$this->data = $this->Lineasminumet->findById($id);

			$titulo = 'Editar';

		} else {

			$titulo = 'Agregar';

		}

		$this->set(compact('id','titulo'));

	}

	

	function admin_eliminar($id) {

		$this->Lineasminumet->delete($id);

		$this->Session->setFlash("La linea se eliminó con éxito");

		$this->redirect(array('action' => 'admin_index'));

	}



}



?>