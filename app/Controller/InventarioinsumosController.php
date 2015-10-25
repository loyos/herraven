<?php



class InventarioinsumosController extends AppController {

    

	public $helpers = array ('Html','Form');

	public $components = array('Session','JqImgcrop','RequestHandler');

	public $uses = array('Inventarioinsumo','Config','Insumo','Lote');

	

    function admin_index($lote_id) {

		$insumos = $this->Insumo->find('all',array(

			'conditions' => array('Insumo.lote_id' => $lote_id)

		));

		$lote = $this->Lote->findById($lote_id);

		$lote = $lote['Lote']['nombre'];

		$ano = date ("Y");

		foreach ($insumos as $i) {

			$tiene_inventario = $this->Inventarioinsumo->find('all',array(

				'conditions' => array(

					'Inventarioinsumo.insumo_id' => $i['Insumo']['id'],

				)

			));

			if (empty($tiene_inventario)) {

				$borrar[] = $i['Insumo']['id'];

			}

			$entradas_insumo[$i['Insumo']['id']] = $this->Inventarioinsumo->find('all',array(

				'fields' => array('SUM(Inventarioinsumo.cantidad)'),

				'conditions' => array(

					'Inventarioinsumo.insumo_id' => $i['Insumo']['id'],

					'Inventarioinsumo.tipo' => 'entrada',

					//'Inventariomateriasproduccion.ano' => $ano

				)

			));

			$salidas_insumo[$i['Insumo']['id']] = $this->Inventarioinsumo->find('all',array(

				'fields' => array('SUM(Inventarioinsumo.cantidad)'),

				'conditions' => array(

					'Inventarioinsumo.insumo_id' => $i['Insumo']['id'],

					'Inventarioinsumo.tipo' => 'salida',

					//'Inventariomateriasproduccion.ano' => $ano 

				)

			));

		} 

		$this->set(compact('ano','entradas_insumo','salidas_insumo','insumos','lote','lote_id','borrar'));

	}

	

	function admin_editar($tipo) {

		if (!empty($this->data)) {

			$data = $this->data;

			$puede_guardar = true;

			if ($data['Inventarioinsumo']['tipo'] == 'salida') {

				$saldo = $this->Inventarioinsumo->obtenerSaldo($data['Inventarioinsumo']['insumo_id']);

				if ($saldo['total'] < $data['Inventarioinsumo']['cantidad']) {

					$puede_guardar = false;

				}

			}

			if ($puede_guardar) {

				$hoy = date('Y-m-d H:i:s');

				$data['Inventarioinsumo']['trimestre'] = $this->Config->obtenerTrimestre($hoy);

				$data['Inventarioinsumo']['ano'] = $this->Config->obtenerAno($hoy);

				$data['Inventarioinsumo']['semana'] = $this->Config->obtenerSemana($hoy);

				$data['Inventarioinsumo']['mes'] = $this->Config->obtenerMes($hoy);

				if ($this->Inventarioinsumo->save($data)) {

					$this->Session->setFlash("EL inventario de insumo se actualizó con éxito");

					$this->redirect(array('action' => 'admin_index'));

				}

			} else {

				$this->Session->setFlash("La cantidad de egreso es mayor al saldo del inventario");

			}

		} 

		

		$insumos_all = $this->Insumo->find('all',array(

			'fields' => array('id','nombre')

		));

		foreach ($insumos_all as $m) {

			$insumos[$m['Insumo']['id']] = $m['Insumo']['nombre'];

		}

		$this->set(compact('insumos','tipo'));

	}

	

	function admin_listar_lotes($action){

		$lotes = $this->Lote->find('all');

		$this->set(compact('lotes','action'));

	}

	

	function admin_movimientos($lote_id = null,$insumo = null) {

		$ano = date ("Y");

		if (!empty($this->data) || !empty($insumo)) {

			if(!empty($this->data)){
				$lote_id = $this->data['Inventarioinsumo']['lote_id'];

			}
			

			if (!empty($insumo)) {

				$m = $this->Insumo->find('first',array(

					'conditions' => array(

						'Insumo.nombre' => $insumo

					)

				));
				// echo '<pre>';print_r($insumo);echo "</pre>";die;
				$id_m = $m['Insumo']['id'];	

			} else {

				$id_m = $this->data['Inventarioinsumo']['insumo_id'];

				$m = $this->Insumo->findById($id_m);

			}

			if(!empty($this->data)){
				$id_m = $this->data['Inventarioinsumo']['insumo_id'];
				$m = $this->Insumo->findById($id_m);

			}
			// echo '<pre>';print_r($m);echo "</pre>";die;
			$nombre = $m['Insumo']['nombre'];

			$hoy = date('Y-m-d H:i:s');

			$trimestre = $this->Config->obtenerTrimestre($hoy);

			$trimestres_entradas = $this->Inventarioinsumo->find('all',array(

				'fields' => array('DISTINCT(Inventarioinsumo.trimestre)'),

				'conditions' => array(

					'Inventarioinsumo.ano' => $ano,

					'Inventarioinsumo.tipo' => 'entrada'

				),

				'order' => array('Inventarioinsumo.trimestre')

			));

			foreach ($trimestres_entradas as $e) {

				$entradas[$e['Inventarioinsumo']['trimestre']] = $this->Inventarioinsumo->find('all',array(

					'fields' => array('Inventarioinsumo.trimestre','SUM(Inventarioinsumo.cantidad)'),

					'conditions' => array(

						'Inventarioinsumo.insumo_id' => $id_m,

						'Inventarioinsumo.tipo' => 'entrada',

						'Inventarioinsumo.ano' => $ano,

						'Inventarioinsumo.trimestre' => $e['Inventarioinsumo']['trimestre']

					),

				));

				$salidas[$e['Inventarioinsumo']['trimestre']] = $this->Inventarioinsumo->find('all',array(

					'fields' => array('Inventarioinsumo.trimestre','SUM(Inventarioinsumo.cantidad)'),

					'conditions' => array(

						'Inventarioinsumo.insumo_id' => $id_m,

						'Inventarioinsumo.tipo' => 'salida',

						'Inventarioinsumo.ano' => $ano,

						'Inventarioinsumo.trimestre' => $e['Inventarioinsumo']['trimestre']

					),

				));

			}

		

			$this->set(compact('id_m','entradas','salidas','trimestre','ano','nombre'));

		}

		

		$insumos = $this->Insumo->find('list',array(

			'fields' => array('id','nombre'),

			'conditions' => array('Insumo.lote_id' => $lote_id)

		));

		// $insumos[0] = 'Selecciona un insumo';

		$this->set(compact('insumos','lote_id', 'ano'));

	}

	

	function admin_consultar_movimientos($insumo_id, $trimestre, $ano) {

		$insumo = $this->Insumo->findById($insumo_id);

		$lote_id = $insumo['Insumo']['lote_id'];

		$nombre = $insumo['Insumo']['nombre'];

		$entradas = $this->Inventarioinsumo->find('all',array(

			'conditions' => array(

				'Inventarioinsumo.trimestre' => $trimestre,

				'Inventarioinsumo.insumo_id' => $insumo_id,

				'Inventarioinsumo.tipo' => 'entrada',

				'Inventarioinsumo.ano' => $ano

			)

		));

		$salidas = $this->Inventarioinsumo->find('all',array(

			'conditions' => array(

				'Inventarioinsumo.insumo_id' => $insumo_id,

				'Inventarioinsumo.tipo' => 'salida',

				'Inventarioinsumo.trimestre' => $trimestre,

				'Inventarioinsumo.ano' => $ano

			),

		));

		$this->set(compact('entradas','insumo_id','trimestre','salidas','ano','nombre', 'lote_id'));

	}	

}



?>