<?php

class BanosController extends AppController {
    
	public $helpers = array ('Html','Form', 'Herra');
	public $components = array('Session','JqImgcrop','RequestHandler', 'Search.Prg');
	public $uses = array('Bano','Materiasprimasgalvanica','BanosMateriasprimasgalvanica','Lineasgalvanica');
    public $presetVars = true; // using the model configuration
	public $paginate = array();
	
    function admin_index() {
		$banos = $this->Bano->find('all');
		$this->set(compact('banos'));
    }
	
	 function admin_index2() {
		$banos = $this->Bano->find('all');
		$this->set(compact('banos'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$guardo = true;
			$data = $this->data;
			if ($this->Bano->save($data, array('validate' => 'first'))) {
				$id = $this->Bano->id;
				$this->BanosMateriasprimasgalvanica->deleteAll(array(
					'bano_id' => $id
				));

				foreach ($data['materiasgalvanicas'] as $m) {
					if ($m != 0) {
						$nuevo = array('BanosMateriasprimasgalvanica' => array(
							'bano_id' => $id,
							'materiasprimasgalvanica_id' => $m
						));
						$this->BanosMateriasprimasgalvanica->create();
						$this->BanosMateriasprimasgalvanica->save($nuevo);
					}
				}
				$this->Session->setFlash("El baño ha sido guardado exitósamente");
				$this->redirect(array('action' => 'admin_index'));
			} 
		} 
		if (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Bano->findById($id);
			//Buscar materias asociadas
			$materiasasociadadas = $this->BanosMateriasprimasgalvanica->find('all',array(
				'conditions' => array('BanosMateriasprimasgalvanica.bano_id' => $id)
			));
		} else {
			$titulo = "Agregar";
		}
		$materiasprimasgalvanicas = $this->Materiasprimasgalvanica->find('list',array(
			'fields' => array('Materiasprimasgalvanica.id','Materiasprimasgalvanica.descripcion'),
		));
		$materiasprimasgalvanicas[0] = 'Selecciona una materia prima';
		$lineasgalvanicas = $this->Lineasgalvanica->find('list',array(
			'fields' => array('Lineasgalvanica.id','Lineasgalvanica.nombre')
		));
		$this->set(compact('id','titulo','materiasprimasgalvanicas','materiasasociadadas','lineasgalvanicas'));
	}
	
	function admin_eliminar($id) {
		$this->BanosMateriasprimasgalvanica->deleteAll(array(
			'bano_id' => $id
		));
		$this->Bano->delete($id);
		$this->Session->setFlash("El baño se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_seleccionar($id) {
		$bano = $this->Bano->findById($id);
		$this->set(compact('bano'));
	}
}

?>