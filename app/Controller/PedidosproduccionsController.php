<?php

class PedidosproduccionsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','Search.Prg','RequestHandler');
	public $uses = array('Pedidosproduccion','Articulosproduccion','User','Inventarioarticulosproduccion','Inventariomateriasproduccion','Config');
    public $presetVars = true; // using the model configuration
	public $paginate = array();

	function admin_index(){
		$pedidos = $this->Pedidosproduccion->find('all',array(
			'conditions' => array('Pedidosproduccion.status <>' => 'Finalizado'),
			'order' => array('Pedidosproduccion.status', 'Pedidosproduccion.fecha'),
			'recursive' => 2
		));
		$count_nuevos = 0;
		$count_produccion = 0;
		$disponible = array();
		foreach ($pedidos as $p) {
			if ($p['Pedidosproduccion']['status'] == 'En Producción') {
				$count_produccion++;
			}
			if ($p['Pedidosproduccion']['status'] == 'Nueva Orden') {
				$count_nuevos++;
				//Verifico si hay materia prima suficiente para esta orden, sino hay suficiente no puede pasar a "En Produccion"
				$hay_suficiente = $this->Inventariomateriasproduccion->suficienteMateria($p['Pedidosproduccion']['id']);
				if ($hay_suficiente) {
					$disponible[] = $p['Pedidosproduccion']['id'];
				}
			}
		}
		$this->set(compact('pedidos','count_nuevos','count_produccion','disponible'));
	}

	function cambiar_status($pedido_id,$status) {
		//Busco el pedido para obtener la cantidad de materia prima y articulo y poder hacer arreglos en los inventarios
		$pedido = $this->Pedidosproduccion->findById($pedido_id);
		$cantidad_pzas = $pedido['Pedidosproduccion']['cantidad'];
		$cantidad_necesitada = $cantidad_pzas*$pedido['Articulosproduccion']['cantidad'];
		$materiaprima_id = $pedido['Articulosproduccion']['materiasprimasproduccion_id'];
		$articulo_id = $pedido['Pedidosproduccion']['articulosproduccion_id'];
		
		//Fecha de hoy para luego obtener ano, mes semana etc
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$trimestre = $this->Config->obtenerTrimestre($hoy);
		$semana = $this->Config->Semana($ano);
		$semana = $semana['week'];
	
		$mes = $this->Config->obtenerMes($hoy);
		
		if ($status == 'Finalizado') {
			$user_id = $this->Auth->User('id');
			$update = array('Pedidosproduccion' => array(
			'id'=>$pedido_id,
			'status' => $status,
			'user_id_finalizo' => $user_id
			));
			//Cuando el articulo finaliza se ingresa articulos al inventario de articulos
			$entrada = array('Inventarioarticulosproduccion' => array(
				'articulosproduccion_id' => $articulo_id,
				'ano' => $ano,
				'mes' => $mes,
				'semana' => $semana,
				'trimestre' => $trimestre,
				'tipo' => 'entrada',
				'cantidad' => $cantidad_pzas
			));
			$this->Inventarioarticulosproduccion->save($entrada);
		} else {
			$update = array('Pedidosproduccion' => array(
				'id'=>$pedido_id,
				'status' => $status,
			));
			//Cuando el articulo pasa a produccion se resta la materia prima del inventario
			$salida = array('Inventariomateriasproduccion' => array(
				'materiasprimasproduccion_id' => $materiaprima_id,
				'ano' => $ano,
				'mes' => $mes,
				'semana' => $semana,
				'trimestre' => $trimestre,
				'tipo' => 'salida',
				'cantidad' => $cantidad_necesitada
			));
			$this->Inventariomateriasproduccion->save($salida);
		}
		$this->Pedidosproduccion->save($update);
		$this->Session->setFlash('La cambio el estatus con exito');
		$this->redirect(array('action'=>'admin_index'));
	}
	
	function admin_historico(){
		$pedidos = $this->Pedidosproduccion->find('all',array(
			'conditions' => array(
				'Pedidosproduccion.status' => 'Finalizado'
			)
		));
		foreach ($pedidos as $p) {
			$user = $this->User->findById($p['Pedidosproduccion']['user_id_finalizo']);
			$users[$p['Pedidosproduccion']['id']] = $user['User']['username'];
		}
		$this->set(compact('pedidos','users'));
	}
}

?>