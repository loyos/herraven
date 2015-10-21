<?php

class InventariomaterialsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Inventariomaterial','Config','Materiasprima');
	
    function admin_index() {
		$materiasprima = $this->Materiasprima->find('all');
		$ano = date ("Y");
		foreach ($materiasprima as $materias) {
			$entradas_materia[$materias['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $materias['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'entrada',
					'Inventariomaterial.ano' => $ano
				)
			));
			$salidas_materia[$materias['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $materias['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'salida',
					'Inventariomaterial.ano' => $ano 
				)
			));
		} 
		$this->set(compact('ano','entradas_materia','salidas_materia','materiasprima','id_m'));
	}
	
	function admin_movimientos($materiaprima = null) {
		$ano = date ("Y");
		if (!empty($this->data) || !empty($materiaprima)) {
			if (!empty($materiaprima)) {
				$m = $this->Materiasprima->find('first',array(
					'conditions' => array('Materiasprima.descripcion' => $materiaprima)
				));
				$id_m = $m['Materiasprima']['id'];	
			} else {
				$id_m = $this->data['Inventariomaterial']['materiasprima_id'];
				$m = $this->Materiasprima->findById($id_m);
			}
			$unidad = $m['Materiasprima']['unidad'];
			$materia = $m['Materiasprima']['descripcion'];
			$hoy = date('Y-m-d H:i:s');
			$trimestre = $this->Config->obtenerTrimestre($hoy);
			$trimestres_entradas = $this->Inventariomaterial->find('all',array(
				'fields' => array('DISTINCT(Inventariomaterial.trimestre)'),
				'conditions' => array(
					'Inventariomaterial.ano' => $ano,
					'Inventariomaterial.tipo' => 'entrada'
				),
				'order' => array('Inventariomaterial.trimestre')
			));
			foreach ($trimestres_entradas as $e) {
				$entradas[$e['Inventariomaterial']['trimestre']] = $this->Inventariomaterial->find('all',array(
					'fields' => array('Inventariomaterial.trimestre','SUM(Inventariomaterial.cantidad)','Materiasprima.descripcion','Materiasprima.unidad'),
					'conditions' => array(
						'Inventariomaterial.materiasprima_id' => $id_m,
						'Inventariomaterial.tipo' => 'entrada',
						'Inventariomaterial.ano' => $ano,
						'Inventariomaterial.trimestre' => $e['Inventariomaterial']['trimestre']
					),
				));
				$salidas[$e['Inventariomaterial']['trimestre']] = $this->Inventariomaterial->find('all',array(
					'fields' => array('Inventariomaterial.trimestre','SUM(Inventariomaterial.cantidad)'),
					'conditions' => array(
						'Inventariomaterial.materiasprima_id' => $id_m,
						'Inventariomaterial.tipo' => 'salida',
						'Inventariomaterial.ano' => $ano,
						'Inventariomaterial.trimestre' => $e['Inventariomaterial']['trimestre']
					),
				));
			}
		
			$this->set(compact('id_m','entradas','salidas','trimestre','ano','unidad','materia'));
		}
		
		$materiasprimas = $this->Materiasprima->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = 'Selecciona una materia prima';
		$this->set(compact('materiasprimas'));
	}
	
	function admin_consultar_movimientos($materiaprima, $trimestre, $ano) {
		$entradas = $this->Inventariomaterial->find('all',array(
			'conditions' => array(
				'Inventariomaterial.trimestre' => $trimestre,
				'Materiasprima.descripcion' => $materiaprima,
				'Inventariomaterial.tipo' => 'entrada',
				'Inventariomaterial.ano' => $ano
			)
		));
		$salidas = $this->Inventariomaterial->find('all',array(
			'fields' => array('Inventariomaterial.semana','Inventariomaterial.mes','SUM(Inventariomaterial.cantidad)'),
			'conditions' => array(
				'Materiasprima.descripcion' => $materiaprima,
				'Inventariomaterial.tipo' => 'salida',
				'Inventariomaterial.trimestre' => $trimestre,
				'Inventariomaterial.ano' => $ano
			),
			'group' => array('Inventariomaterial.mes', 'Inventariomaterial.semana'),
			'order' => array('Inventariomaterial.mes', 'Inventariomaterial.semana')
		));
		$this->set(compact('entradas','materiaprima','trimestre','salidas','ano'));
	}	
	
	function admin_editar() {
		if (!empty($this->data)) {
			$data = $this->data;
			$hoy = date('Y-m-d H:i:s');
			$data['Inventariomaterial']['trimestre'] = $this->Config->obtenerTrimestre($hoy);
			$data['Inventariomaterial']['ano'] = $this->Config->obtenerAno($hoy);
			$data['Inventariomaterial']['semana'] = $this->Config->obtenerSemana($hoy);
			$data['Inventariomaterial']['mes'] = $this->Config->obtenerMes($hoy);
			$data['Inventariomaterial']['tipo'] = 'entrada';
			if ($this->Inventariomaterial->save($data)) {
				$this->Session->setFlash("El ingreso de materia prima se realizó con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} 
		
		$materiasprimas_all = $this->Materiasprima->find('all',array(
			'fields' => array('id','descripcion','unidad')
		));
		foreach ($materiasprimas_all as $m) {
			$materiasprimas[$m['Materiasprima']['id']] = $m['Materiasprima']['descripcion'].' ('.$m['Materiasprima']['unidad'].')';
		}
		$this->set(compact('materiasprimas'));
	}
	
	function admin_eliminar($id) {
		$this->Materiasprima->delete($id);
		$this->MateriasprimasPrecio->deleteAll(array(
			'materiasprima_id' => $id
		));
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_reporte() {
		//Inventario de materias primas
		$materiasprima = $this->Materiasprima->find('all');
		$ano = date ("Y");
		foreach ($materiasprima as $materias) {
			$entradas_materia[$materias['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $materias['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'entrada',
					'Inventariomaterial.ano' => $ano
				)
			));
			$salidas_materia[$materias['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Inventariomaterial.materiasprima_id' => $materias['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'salida',
					'Inventariomaterial.ano' => $ano 
				)
			));
		} 
		$this->set(compact('ano','entradas_materia','salidas_materia','materiasprima'));
		//Fin inventario
		
		//Movimientos
		foreach ($materiasprima as $m){
			$entradas[$m['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'conditions' => array(
					'Materiasprima.id' => $m['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'entrada',
					'Inventariomaterial.ano' => $ano
				)
			));
			$salidas[$m['Materiasprima']['id']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('Inventariomaterial.semana','Inventariomaterial.mes','SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Materiasprima.id' => $m['Materiasprima']['id'],
					'Inventariomaterial.tipo' => 'salida',
					'Inventariomaterial.ano' => $ano
				),
				'group' => array('Inventariomaterial.mes', 'Inventariomaterial.semana'),
				'order' => array('Inventariomaterial.mes', 'Inventariomaterial.semana')
			));
		}
		$this->set(compact('entradas','salidas'));
	}
	function admin_reporte_movimientos($id_materia) {
		//Inventario de materias primas
		$ano = date ("Y");
		$trimestres = $this->Inventariomaterial->find('all',array(
			'fields' => array('DISTINCT trimestre'),
			'conditions' => array(
				'Materiasprima.id' => $id_materia,
			),
			'order' => array('Inventariomaterial.trimestre DESC')
		));
		$materia_prima = $this->Materiasprima->findById($id_materia);
		foreach ($trimestres as $t) { 
			$entradas[$t['Inventariomaterial']['trimestre']] = $this->Inventariomaterial->find('all',array(
				'conditions' => array(
					'Materiasprima.id' => $id_materia,
					'Inventariomaterial.tipo' => 'entrada',
					'Inventariomaterial.ano' => $ano,
					'Inventariomaterial.trimestre' => $t['Inventariomaterial']['trimestre']
				),
				'order' => array('Inventariomaterial.trimestre')
			));
			$salidas[$t['Inventariomaterial']['trimestre']] = $this->Inventariomaterial->find('all',array(
				'fields' => array('Inventariomaterial.semana','Inventariomaterial.mes','SUM(Inventariomaterial.cantidad)'),
				'conditions' => array(
					'Materiasprima.id' => $id_materia,
					'Inventariomaterial.tipo' => 'salida',
					'Inventariomaterial.ano' => $ano,
					'Inventariomaterial.trimestre' => $t['Inventariomaterial']['trimestre']
				),
				'group' => array('Inventariomaterial.mes', 'Inventariomaterial.semana'),
				'order' => array('Inventariomaterial.trimestre','Inventariomaterial.mes', 'Inventariomaterial.semana')
			));
			
		}
		
		foreach ($entradas as $key=>$entrada) {
			$saldo_entradas = 0;
			foreach ($entrada as $e) {
				$saldo_entradas = $saldo_entradas + floatval($e['Inventariomaterial']['cantidad']);
			}
			$saldo_e[$key] = $saldo_entradas;
		}
		foreach ($salidas as $key2=>$salida) {
			$saldo_salida = 0;
			foreach ($salida as $s) {
				$saldo_salida = $saldo_salida + floatval($s[0]['SUM(`Inventariomaterial`.`cantidad`)']);
			}
			$saldo_s[$key2] = $saldo_salida;
		}
		$hoy = date('Y-m-d H:i:s');
		$trimestre_actual = $this->Config->obtenerTrimestre($hoy);
		$this->set(compact('entradas','salidas','trimestres','materia_prima','saldo_e','saldo_s','trimestre_actual','ano'));
	}
}

?>