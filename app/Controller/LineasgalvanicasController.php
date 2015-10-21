<?php

class LineasgalvanicasController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	public $uses = array('Lineasgalvanica');
	
    function admin_index() {
		$lineas = $this->Lineasgalvanica->find('all');
		foreach ($lineas as $m) {
			// if (empty($m['Articulosproduccion'])){
				// $borrar[$m['Materiasprimasproduccion']['id']] = 1;
			// } else {
				// $borrar[$m['Materiasprimasproduccion']['id']] = 0;
			// }
		}
		$this->set(compact('lineas'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			$data = $this->data;
			$i = 0;
			
			if ($this->Lineasgalvanica->save($data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Lineasgalvanica->findById($id);
		} else {
			$titulo = "Agregar";
		}
		
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Lineasgalvanica->delete($id);
		$this->Session->setFlash("La Linea se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	
}

?>