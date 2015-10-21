<?php

class MateriasprimasmoldesController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Materiasprimasmolde');
	
    function admin_index() {
		$materias = $this->Materiasprimasmoldes->find('all');
		foreach ($materias as $m) {
			if (empty($m['Moldes'])){
				$borrar[$m['Materiasprimasmoldes']['id']] = 1;
			} else {
				$borrar[$m['Materiasprimasmoldes']['id']] = 0;
			}
		}
		$this->set(compact('materias','borrar'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$data = $this->data;
			$i = 0;
			if ($this->Materiasprimasmolde->save($data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('controller' =>'inventariomateriasmoldes', 'action' => 'admin_index'));
			}
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Materiasprimasmolde->findById($id);
		} else {
			$titulo = "Agregar";
		}
		
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Materiasprimasmolde->delete($id);
		$this->Session->setFlash("La materia prima se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	
}

?>