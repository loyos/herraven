<?php

class InventarioarticulosproduccionsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Inventarioarticulosproduccion','Config','Articulosproduccion','Materiasprimasproduccion');
	
    function admin_index() {
		$articulos = $this->Articulosproduccion->find('all');
		$ano = date ("Y");
		foreach ($articulos as $articulo) {
			$entradas_articulo[$articulo['Articulosproduccion']['id']] = $this->Inventarioarticulosproduccion->find('all',array(
				'fields' => array('SUM(Inventarioarticulosproduccion.cantidad)'),
				'conditions' => array(
					'Inventarioarticulosproduccion.articulosproduccion_id' => $articulo['Articulosproduccion']['id'],
					'Inventarioarticulosproduccion.tipo' => 'entrada',
					//'Inventariomateriasproduccion.ano' => $ano
				)
			));
			$salidas_articulo[$articulo['Articulosproduccion']['id']] = $this->Inventarioarticulosproduccion->find('all',array(
				'fields' => array('SUM(Inventarioarticulosproduccion.cantidad)'),
				'conditions' => array(
					'Inventarioarticulosproduccion.articulosproduccion_id' => $articulo['Articulosproduccion']['id'],
					'Inventarioarticulosproduccion.tipo' => 'salida',
					//'Inventariomateriasproduccion.ano' => $ano 
				)
			));
		} 
		$this->set(compact('ano','entradas_articulo','salidas_articulo','articulos'));
	}
	
	function admin_editar() {
		if (!empty($this->data)) {
			$data = $this->data;
			$hoy = date('Y-m-d H:i:s');
			$data['Inventarioarticulosproduccion']['trimestre'] = $this->Config->obtenerTrimestre($hoy);
			$data['Inventarioarticulosproduccion']['ano'] = $this->Config->obtenerAno($hoy);
			$data['Inventarioarticulosproduccion']['semana'] = $this->Config->obtenerSemana($hoy);
			$data['Inventarioarticulosproduccion']['mes'] = $this->Config->obtenerMes($hoy);
			$data['Inventarioarticulosproduccion']['tipo'] = 'salida';
			if ($this->Inventarioarticulosproduccion->save($data)) {
				$this->Session->setFlash("La salida del artículo se realizó con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} 
		
		$articulos_all = $this->Articulosproduccion->find('all',array(
			'fields' => array('id','codigo')
		));
		foreach ($articulos_all as $m) {
			$articulosproduccions[$m['Articulosproduccion']['id']] = $m['Articulosproduccion']['codigo'];
		}
		$this->set(compact('articulosproduccions'));
	}
}

?>