<?php

class MateriasprimasproduccionsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Materiasprimasproduccion');
	
    function admin_index() {
		$materias = $this->Materiasprimasproduccion->find('all');
		foreach ($materias as $m) {
			if (empty($m['Articulosproduccion'])){
				$borrar[$m['Materiasprimasproduccion']['id']] = 1;
			} else {
				$borrar[$m['Materiasprimasproduccion']['id']] = 0;
			}
		}
		$this->set(compact('materias','borrar'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$data = $this->data;
			$i = 0;
			
			if ($this->Materiasprimasproduccion->save($data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('controller' =>'inventariomateriasproduccions', 'action' => 'admin_index'));
			}
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Materiasprimasproduccion->findById($id);
		} else {
			$titulo = "Agregar";
		}
		
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Materiasprimasproduccion->delete($id);
		$this->Session->setFlash("La materia prima se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	
}

?>