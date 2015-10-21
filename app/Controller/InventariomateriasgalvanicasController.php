<?php

class InventariomateriasgalvanicasController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Inventariomateriasgalvanica','Config','Materiasprimasgalvanica','BanosMateriasprimasgalvanica','Bano');
	
    function admin_index() {
		$materiasprima = $this->Materiasprimasgalvanica->find('all');
		$ano = date ("Y");
		foreach ($materiasprima as $materias) {
			$entradas_materia[$materias['Materiasprimasgalvanica']['id']] = $this->Inventariomateriasgalvanica->find('all',array(
				'fields' => array('SUM(Inventariomateriasgalvanica.cantidad)'),
				'conditions' => array(
					'Inventariomateriasgalvanica.materiasprimasgalvanica_id' => $materias['Materiasprimasgalvanica']['id'],
					'Inventariomateriasgalvanica.tipo' => 'entrada',
					'Inventariomateriasgalvanica.ano' => $ano
				)
			));
			$salidas_materia[$materias['Materiasprimasgalvanica']['id']] = $this->Inventariomateriasgalvanica->find('all',array(
				'fields' => array('SUM(Inventariomateriasgalvanica.cantidad)'),
				'conditions' => array(
					'Inventariomateriasgalvanica.materiasprimasgalvanica_id' => $materias['Materiasprimasgalvanica']['id'],
					'Inventariomateriasgalvanica.tipo' => 'salida',
					'Inventariomateriasgalvanica.ano' => $ano 
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
			$data['Inventariomateriasgalvanica']['trimestre'] = $this->Config->obtenerTrimestre($hoy);
			$data['Inventariomateriasgalvanica']['ano'] = $this->Config->obtenerAno($hoy);
			$data['Inventariomateriasgalvanica']['semana'] = $this->Config->obtenerSemana($hoy);
			$data['Inventariomateriasgalvanica']['mes'] = $this->Config->obtenerMes($hoy);
			$data['Inventariomateriasgalvanica']['tipo'] = 'entrada';
			if ($this->Inventariomateriasgalvanica->save($data)) {
				$this->Session->setFlash("El ingreso de materia prima se realizó con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} 
		
		$materiasprimas_all = $this->Materiasprimasgalvanica->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		foreach ($materiasprimas_all as $m) {
			$materiasprimasgalvanicas[$m['Materiasprimasgalvanica']['id']] = $m['Materiasprimasgalvanica']['descripcion'].' ('.$m['Materiasprimasgalvanica']['unidad'].')';
		}
		$this->set(compact('materiasprimasgalvanicas'));
	}
	
	function admin_egreso($id){
		if (!empty($this->data)) {
			$id = $this->data['Bano']['id'];
			$hoy = date('Y-m-d H:i:s');
			$entro = 0;
			$valido = true;
			//Verifico que todos los montos sean validos
			foreach ($this->data['materias'] as $k=>$c) {
				if (!empty($c) && $c<0) {
					$valido = false;
				}
			}
			if ($valido) {
				foreach ($this->data['materias'] as $k=>$c) {
					if (!empty($c)) {
						if ($c > 0) {
							$entro++;
							$salida = array('Inventariomateriasgalvanica' => array(
								'cantidad' => $c,
								'materiasprimasgalvanica_id' => $k,
								'trimestre' => $this->Config->obtenerTrimestre($hoy),
								'ano' =>$this->Config->obtenerAno($hoy),
								'mes' => $this->Config->obtenerMes($hoy),
								'semana' => $this->Config->obtenerSemana($hoy),
								'tipo' => 'salida'
							));
							$this->Inventariomateriasgalvanica->create();
							$this->Inventariomateriasgalvanica->save($salida);
						} else {
							
						}
					}
				}
			}
			if ($entro > 0) {
				$this->Session->setFlash('El egreso fue realizado con éxito');
				$this->redirect(array('controller' => 'banos','action'=>'admin_seleccionar',$id));
			}
		}
		$bano = $this->Bano->findById($id);
		$materias = $this->BanosMateriasprimasgalvanica->find('all',array(
			'conditions' => array('BanosMateriasprimasgalvanica.bano_id' => $id),
		));
		$this->set(compact('materias','bano','id'));
	}
	
}

?>