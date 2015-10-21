<?php

class PedidosmoldesController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','Search.Prg','RequestHandler');
	public $uses = array('Pedidosmolde','Molde','User','Inventariomateriasmolde','');
    public $presetVars = true; // using the model configuration
	public $paginate = array();

	function admin_index(){
		$pedidos = $this->Pedidosmolde->find('all',array(
			'conditions' => array('Pedidosmolde.status <>' => 'Finalizado'),
			'order' => array('Pedidosmolde.status', 'Pedidosmolde.fecha')
		));
		$count_nuevos = 0;
		$count_produccion = 0;
		foreach ($pedidos as $p) {
			if ($p['Pedidosmolde']['status'] == 'En Producción') {
				$count_produccion++;
			}
			if ($p['Pedidosmolde']['status'] == 'Nueva Orden') {
				$count_nuevos++;
				
				$disponible = array();
				$hay_suficiente = $this->Inventariomateriasmolde->suficienteMateria($p['Pedidosmolde']['id']);
				if ($hay_suficiente) {
					$disponible[] = $p['Pedidosmolde']['id'];
				}
			}
		}
		$this->set(compact('pedidos','count_nuevos','count_produccion','disponible'));
	}

	function cambiar_status($pedido_id,$status) {
		//Busco el pedido para obtener la cantidad de materia prima y articulo y poder hacer arreglos en los inventarios
		$pedido = $this->Pedidosmolde->findById($pedido_id);
		$cantidad_pzas = $pedido['Pedidosmolde']['cantidad'];
		$cantidad_necesitada = $cantidad_pzas*$pedido['Molde']['cantidad'];
		$materiaprima_id = $pedido['Molde']['materiasprimasmolde_id'];
		$molde_id = $pedido['Pedidosmolde']['molde_id'];
		
		//Fecha de hoy para luego obtener ano, mes semana etc
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$trimestre = $this->Config->obtenerTrimestre($hoy);
		$semana = $this->Config->Semana($ano);
		$semana = $semana['week'];
	
		$mes = $this->Config->obtenerMes($hoy);

		if ($status == 'Finalizado') {
			$user_id = $this->Auth->User('id');
			$update = array('Pedidosmolde' => array(
			'id'=>$pedido_id,
			'status' => $status,
			'user_id_finalizo' => $user_id
			));
		} else {
			$update = array('Pedidosmolde' => array(
				'id'=>$pedido_id,
				'status' => $status,
			));
			$salida = array('Inventariomateriasmolde' => array(
				'materiasprimasmolde_id' => $materiaprima_id,
				'ano' => $ano,
				'mes' => $mes,
				'semana' => $semana,
				'trimestre' => $trimestre,
				'tipo' => 'salida',
				'cantidad' => $cantidad_necesitada
			));
			$this->Inventariomateriasmolde->save($salida);
		}
		$this->Pedidosmolde->save($update);
		$this->Session->setFlash('La cambio el estatus con exito');
		$this->redirect(array('action'=>'admin_index'));
	}
	
	function admin_historico(){
		$pedidos = $this->Pedidosmolde->find('all',array(
			'conditions' => array(
				'Pedidosmolde.status' => 'Finalizado'
			)
		));
		foreach ($pedidos as $p) {
			$user = $this->User->findById($p['Pedidosmolde']['user_id_finalizo']);
			$users[$p['Pedidosmolde']['id']] = $user['User']['username'];
		}
		$this->set(compact('pedidos','users'));
	}
}

?>