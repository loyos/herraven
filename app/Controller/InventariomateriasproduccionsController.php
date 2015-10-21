<?php

class InventariomateriasproduccionsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Inventariomateriasproduccion','Config','Materiasprimasproduccion');
	
    function admin_index() {
		$materiasprima = $this->Materiasprimasproduccion->find('all');
		$ano = date ("Y");
		foreach ($materiasprima as $materias) {
			$entradas_materia[$materias['Materiasprimasproduccion']['id']] = $this->Inventariomateriasproduccion->find('all',array(
				'fields' => array('SUM(Inventariomateriasproduccion.cantidad)'),
				'conditions' => array(
					'Inventariomateriasproduccion.materiasprimasproduccion_id' => $materias['Materiasprimasproduccion']['id'],
					'Inventariomateriasproduccion.tipo' => 'entrada',
					'Inventariomateriasproduccion.ano' => $ano
				)
			));
			$salidas_materia[$materias['Materiasprimasproduccion']['id']] = $this->Inventariomateriasproduccion->find('all',array(
				'fields' => array('SUM(Inventariomateriasproduccion.cantidad)'),
				'conditions' => array(
					'Inventariomateriasproduccion.materiasprimasproduccion_id' => $materias['Materiasprimasproduccion']['id'],
					'Inventariomateriasproduccion.tipo' => 'salida',
					'Inventariomateriasproduccion.ano' => $ano 
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
			$data['Inventariomateriasproduccion']['trimestre'] = $this->Config->obtenerTrimestre($hoy);
			$data['Inventariomateriasproduccion']['ano'] = $this->Config->obtenerAno($hoy);
			$data['Inventariomateriasproduccion']['semana'] = $this->Config->obtenerSemana($hoy);
			$data['Inventariomateriasproduccion']['mes'] = $this->Config->obtenerMes($hoy);
			$data['Inventariomateriasproduccion']['tipo'] = 'entrada';
			if ($this->Inventariomateriasproduccion->save($data)) {
				$this->Session->setFlash("El ingreso de materia prima se realizó con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} 
		
		$materiasprimas_all = $this->Materiasprimasproduccion->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		foreach ($materiasprimas_all as $m) {
			$materiasprimasproduccions[$m['Materiasprimasproduccion']['id']] = $m['Materiasprimasproduccion']['descripcion'].' ('.$m['Materiasprimasproduccion']['unidad'].')';
		}
		$this->set(compact('materiasprimasproduccions'));
	}
	
	
}

?>