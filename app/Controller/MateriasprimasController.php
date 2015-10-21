<?php

class MateriasprimasController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Materiasprima','MateriasprimasPrecio','Precio');
	
    function admin_index() {
		$materias = $this->Materiasprima->find('all');
		foreach ($materias as $m) {
			if (empty($m['Articulo'])){
				$borrar[$m['Materiasprima']['id']] = 1;
			} else {
				$borrar[$m['Materiasprima']['id']] = 0;
			}
		}
		//var_dump($materias);die();
		$this->set(compact('materias','precios','borrar'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$data = $this->data;
			$i = 0;
			
			if ($this->Materiasprima->save($data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('controller'=>'inventariomaterials','action' => 'admin_index'));
			}
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Materiasprima->findById($id);
		} else {
			$titulo = "Agregar";
		}
		
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Materiasprima->delete($id);
		$this->MateriasprimasPrecio->deleteAll(array(
			'materiasprima_id' => $id
		));
		$this->Session->setFlash("La materia prima se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	
}

?>