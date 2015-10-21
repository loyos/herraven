<?php

class InventariomateriasmoldesController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Inventariomateriasmolde','Config','Materiasprimasmolde');
	
    function admin_index() {
		$materiasprima = $this->Materiasprimasmolde->find('all');
		$ano = date ("Y");
		foreach ($materiasprima as $materias) {
			$entradas_materia[$materias['Materiasprimasmolde']['id']] = $this->Inventariomateriasmolde->find('all',array(
				'fields' => array('SUM(Inventariomateriasmolde.cantidad)'),
				'conditions' => array(
					'Inventariomateriasmolde.materiasprimasmolde_id' => $materias['Materiasprimasmolde']['id'],
					'Inventariomateriasmolde.tipo' => 'entrada',
					'Inventariomateriasmolde.ano' => $ano
				)
			));
			$salidas_materia[$materias['Materiasprimasmolde']['id']] = $this->Inventariomateriasmolde->find('all',array(
				'fields' => array('SUM(Inventariomateriasmolde.cantidad)'),
				'conditions' => array(
					'Inventariomateriasmolde.materiasprimasmolde_id' => $materias['Materiasprimasmolde']['id'],
					'Inventariomateriasmolde.tipo' => 'salida',
					'Inventariomateriasmolde.ano' => $ano 
				)
			));
		} 
		//debug($entradas_materia);
		$this->set(compact('ano','entradas_materia','salidas_materia','materiasprima'));
	}
	
	function admin_editar() {
		if (!empty($this->data)) {
			$data = $this->data;
			$hoy = date('Y-m-d H:i:s');
			$data['Inventariomateriasmolde']['trimestre'] = $this->Config->obtenerTrimestre($hoy);
			$data['Inventariomateriasmolde']['ano'] = $this->Config->obtenerAno($hoy);
			$data['Inventariomateriasmolde']['semana'] = $this->Config->obtenerSemana($hoy);
			$data['Inventariomateriasmolde']['mes'] = $this->Config->obtenerMes($hoy);
			$data['Inventariomateriasmolde']['tipo'] = 'entrada';
			if ($this->Inventariomateriasmolde->save($data,array('validate' => 'first'))) {
				$this->Session->setFlash("El ingreso de materia prima se realizó con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} 
		
		$materiasprimas_all = $this->Materiasprimasmolde->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		foreach ($materiasprimas_all as $m) {
			$materiasprimasmoldes[$m['Materiasprimasmolde']['id']] = $m['Materiasprimasmolde']['descripcion'].' ('.$m['Materiasprimasmolde']['unidad'].')';
		}
		$this->set(compact('materiasprimasmoldes'));
	}
	
	
}

?>