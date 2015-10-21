<?php

class PedidosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','Search.Prg','RequestHandler');
	public $uses = array('Pedido','Articulo','Subcategoria','Materiasprima','ArticulosMateriasprima','Config','Inventarioalmacen','CajasPedido','Caja','Cuenta','Almacencliente','Cliente');
    public $presetVars = true; // using the model configuration
	public $paginate = array();

	
    function admin_index() {
		$this->Prg->commonProcess();
		$parametros = $this->Prg->parsedParams();
		if ($parametros){
			$this->paginate['conditions'] = $this->Pedido->parseCriteria($this->Prg->parsedParams());
			if (empty($this->paginate['conditions']['Pedido.status LIKE'])) {
				$this->paginate['conditions']['Pedido.status <>'] = array('Despachado','Cancelado');
			}
			$this->paginate['recursive'] = 2;
			$pedidos = $this->paginate();
		}else{
			$pedidos = $this->Pedido->find('all',array(
				'recursive' => 2,
				'conditions' => array('Pedido.status <>' => array('Despachado','Cancelado'))
			));
		}
		$count = 0;
		foreach ($pedidos as $p) {
			$entradas = 0;
			$salidas = 0;
			$ano = $this->Config->obtenerAno($p['Pedido']['fecha']);
			$pedidos[$count]['Pedido']['num_pedido'] = $pedidos[$count]['Pedido']['num_pedido'].$ano[2].$ano[3];
			if(!empty($p['Articulo']['Inventarioalmacen'])) {
				foreach ($p['Articulo']['Inventarioalmacen'] as $ia) {
					if ($ia['tipo'] == 'entrada' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
						$entradas = $entradas + $ia['cajas'];
					} elseif ($ia['tipo'] == 'salida' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
						$salidas = $salidas + $ia['cajas'];
					}
				}
				$saldo = $entradas - $salidas;
				if ($saldo >= $p['Pedido']['cantidad_cajas'] && ($p['Pedido']['status'] == 'pendiente' || $p['Pedido']['status'] == 'No disponible')) {
					$status[$p['Pedido']['id']] = 'Disponible';
				} elseif ($saldo <= $p['Pedido']['cantidad_cajas'] && ($p['Pedido']['status'] == 'pendiente' || $p['Pedido']['status'] == 'Disponible')) {
					$status[$p['Pedido']['id']] = 'No disponible';
				} else {
					$status[$p['Pedido']['id']] = $p['Pedido']['status'];
				}
			} else {
				if ($p['Pedido']['status'] == 'pendiente') {
					$status[$p['Pedido']['id']] = 'No disponible';
				} else {
					$status[$p['Pedido']['id']] = $p['Pedido']['status'];
				}
			}
			$update = array('Pedido' => array(
				'id' => $p['Pedido']['id'],
				'status' => $status[$p['Pedido']['id']],
			));
			$this->Pedido->save($update);
			$count++;
		}
		$this->loadModel('Acabado');
		$acabados = $this->Acabado->find('list', array(
			'fields' => array('Acabado.acabado', 'Acabado.acabado')
		));
		$clientes = $this->Cliente->find('list', array(
			'fields' => array('Cliente.id', 'Cliente.denominacion_legal')
		));
		$acabados['Sin Acabado'] = 'Sin Acabado';
		$acabados = array_merge(array('Todos'), $acabados);
		
		$pedidos_pendientes = $this->Pedido->find('all', array(
			'conditions' => array(
				'status !=' => array('Despachado', 'Cancelado'),
			)
		));	
		$this->set(compact('status','pedidos', 'acabados','clientes', 'pedidos_pendientes'));
    }

	function admin_pedidos() {
		
		$this->Prg->commonProcess();
		$parametros = $this->Prg->parsedParams();
		if ($parametros){
			$this->paginate['conditions'] = $this->Pedido->parseCriteria($this->Prg->parsedParams());
			if (empty($this->paginate['conditions']['Pedido.status LIKE'])) {
				$this->paginate['conditions']['Pedido.status <>'] = array('Despachado','Cancelado');
			}
			$this->paginate['recursive'] = 2;
			$pedidos = $this->paginate();
		}else{
			$pedidos = $this->Pedido->find('all',array(
				'recursive' => 2,
				'conditions' => array(
					'Pedido.status <>' => array('Despachado','Cancelado')
				)
			));
		}
			$count = 0;
			foreach ($pedidos as $p) {
				$entradas = 0;
				$salidas = 0;
				$ano = $this->Config->obtenerAno($p['Pedido']['fecha']);
				$pedidos[$count]['Pedido']['num_pedido'] = $pedidos[$count]['Pedido']['num_pedido'].$ano[2].$ano[3];
				if ($p['Pedido']['status'] != 'Preparado' || $p['Pedido']['status'] != 'Progreso-Despacho') {
					if(!empty($p['Articulo']['Inventarioalmacen'])) {
						foreach ($p['Articulo']['Inventarioalmacen'] as $ia) {
							if ($ia['tipo'] == 'entrada' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
								$entradas = $entradas + $ia['cajas'];
							} elseif ($ia['tipo'] == 'salida' && $ia['acabado_id'] == $p['Pedido']['acabado_id']) {
								$salidas = $salidas + $ia['cajas'];
							}
						}
						$saldo = $entradas - $salidas;
						if ($saldo >= $p['Pedido']['cantidad_cajas'] && ($p['Pedido']['status'] == 'pendiente' || $p['Pedido']['status'] == 'No disponible')){
							$status[$p['Pedido']['id']] = 'Disponible';
						} else if($saldo <= $p['Pedido']['cantidad_cajas'] && ($p['Pedido']['status'] == 'pendiente' || $p['Pedido']['status'] == 'Disponible')) {
							$status[$p['Pedido']['id']] = 'No disponible';
						} else {
							$status[$p['Pedido']['id']] = $p['Pedido']['status'];
						}
					} else {
						if ($p['Pedido']['status'] == 'pendiente') {
							$status[$p['Pedido']['id']] = 'No disponible';
						} else {
							$status[$p['Pedido']['id']] = $p['Pedido']['status'];
						}
					}
				} else {
					$status[$p['Pedido']['id']] = $p['Pedido']['status'];
				}
				$update = array('Pedido' => array(
					'id' => $p['Pedido']['id'],
					'status' => $status[$p['Pedido']['id']],
				));
			$this->Pedido->save($update);
				$count++;
			}
			
		$pedidos_pendientes = $this->Pedido->find('all', array(
			'conditions' => array(
				'status <>' => array('Despachado', 'Cancelado'),
			)
		));	
			
		$this->loadModel('Acabado');
		$acabados = $this->Acabado->find('list', array(
			'fields' => array('Acabado.acabado', 'Acabado.acabado')
		));
		$clientes = $this->Cliente->find('list', array(
			'fields' => array('Cliente.id', 'Cliente.denominacion_legal')
		));
		$acabados['Sin Acabado'] = 'Sin Acabado';
		$acabados = array_merge(array('Todos'), $acabados);
		$this->set(compact('status','pedidos', 'acabados','clientes', 'pedidos_pendientes'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			if (!empty($this->data['Articulo']['Foto']['name'])) {
				if ($this->JqImgcrop->uploadImage($this->data['Articulo']['Foto'], 'img\articulos', '')) {
					$data['Articulo']['imagen'] = $this->data['Articulo']['Foto']['name'];
				}
			}
			$i = 0;
			$this->Articulo->save($data);
			$id = $this->Articulo->id;
			$this->ArticulosMateriasprima->deleteAll(array(
				'articulo_id' => $id
			));
			foreach($this->data['materias'] as $m){
				if (!empty($m)){
					$existe = $this->ArticulosMateriasprima->find('first',array(
						'conditions' => array(
							'articulo_id' => $id,
							'materiasprima_id' => $m
						)
					));
					if (empty($existe)) {
						$data_m = array(
							'articulo_id' => $id,
							'materiasprima_id' => $m,
							'cantidad' => $this->data['cantidad'][$i]
						);
						$this->ArticulosMateriasprima->saveAll($data_m);
					}
					$i++;
				}
			}
			
			//die("sd");
			$this->Session->setFlash("Los datos se guardaron con éxito");
			$this->redirect(array('action' => 'admin_index'));
		} elseif (!empty($id)) {
			$titulo = "Editar";
			$this->data = $this->Articulo->findById($id);
			$materiales = $this->ArticulosMateriasprima->find('all',array(
				'conditions' => array(
					'articulo_id' => $id
				)
			));
			foreach ($materiales as $mat) {
				$valor_mp[] = $mat['ArticulosMateriasprima']['materiasprima_id'];
				$valor_cant[] = $mat['ArticulosMateriasprima']['cantidad'];
			}
		} else {
			$titulo = "Agregar";
		}
		$costo_produccion = $this->Config->find('first');
		$costo_produccion = $costo_produccion['Config']['costo_produccion'];
		$subcategorias = $this->Subcategoria->find('list',array(
			'fields' => array('id','descripcion')
		));
		$materiasprimas[0] = '';
		$materiasprimas= $materiasprimas + $this->Materiasprima->find('list',array(
			'fields' => array('id','descripcion')
		));
		$this->set(compact('id','subcategorias','titulo','materiasprimas','valor_mp','valor_cant','costo_produccion'));
	}
	
	
	function admin_ver($id) {
		$articulo = $this->Articulo->findById($id);
		$this->set(compact('articulo'));
	}
	
	function admin_forecast(){
		if (!empty($this->data)) {
			$data = $this->data;
			foreach ($data['cantidad'] as $key => $value){
				if ($value == 1){
					$cajas = $data['cajas'][$key];
					$articulo = $this->Articulo->findById($key);
					foreach ($articulo['Materiasprima'] as $mp){
						$datos = array (
							'Articulo' => $articulo['Articulo']['descripcion'],
							'Materiasprima' => $mp['descripcion'],
							'cantidad' =>  $mp['ArticulosMateriasprima']['cantidad'] * $articulo['Articulo']['cantidad_por_caja'] * $cajas,
							'cajas' => $cajas
						);
						$articulos_mp[$key][]= $datos;
					}
				}
			}
			$this->set(compact('articulos_mp'));
		} else {
			$articulos = $this->Articulo->find('all',array(
				'link' => array('Subcategoria' => 'Categoria'),
				'recursive' => 2
			));
			$this->set(compact('articulos'));
		}
	}
	
	function admin_ejecutar_pedido($id) {
		if (!empty($this->data)) {
			$pedido_id = $this->data['Pedido']['id'];
			$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));	
		}
		$pedido = $this->Pedido->findById($id);
		$this->set(compact('pedido','id'));
	}
	
	function admin_ejecutar_despacho($id) {
		if (!empty($this->data)){
			if (!empty($this->data['Pedido']['factura'])) {
				$pedido = $this->Pedido->findById($this->data['Pedido']['id']);
				$hoy = date('Y-m-d H:i:s');
				$update_pedido = array(
					'Pedido' => array(
						'id' => $this->data['Pedido']['id'],
						'status' => 'Progreso-Despacho',
						'factura' => $this->data['Pedido']['factura'],
						'fecha' => $hoy
					)
				);
				$this->Pedido->save($update_pedido);
				$this->redirect(array('action' => 'admin_info_despacho',$this->data['Pedido']['id']));	
			} else {
				$this->Session->setFlash('Se debe introducir un número de factura');
			}
		}
		$pedido = $this->Pedido->findById($id);
		$this->set(compact('pedido','id'));
	}
	
	function admin_info_despacho($pedido_id) {
		$pedido = $this->Pedido->findById($pedido_id);
		$hoy = date('d-m-Y');
		$this->layout = 'sin_menu';
		$ano = $this->Config->obtenerAno($pedido['Pedido']['fecha']);
		$pedido['Pedido']['num_pedido'] = $pedido['Pedido']['num_pedido'].$ano[2].$ano[3];
		$this->set(compact('pedido','hoy'));
	}
	
	function admin_pedido_terminado($id) {
		$pedido = $this->Pedido->findById($id);
		$hoy = date('Y-m-d H:i:s');
		$update_pedido = array(
			'Pedido' => array(
				'id' => $id,
				'status' => 'Despachado',
				'fecha' => $hoy,
				'mes_despacho' => $this->Config->obtenerMes($hoy),
				'semana_despacho' => $this->Config->obtenerSemana($hoy),
			)
		);
		$data = array(
			'Almacencliente' => array(
				'tipo' => 'entrada',
				'articulo_id'=> $pedido['Articulo']['id'],
				'cajas' => $pedido['Pedido']['cantidad_cajas'],
				'acabado_id' => $pedido['Pedido']['acabado_id'],
				'pedido_id' => $id,
				'mes' => $this->Config->obtenerMes($hoy),
			)
		);
		$this->Almacencliente->save($data);
		$this->Pedido->save($update_pedido);
		
		//Crear cuenta
		$cuenta = array(
			'Cuenta' => array(
			'pedido_id' => $id,
			'status' =>'Vigente',
			'mes' => $this->Config->obtenerMes($hoy),
			'semana' => $this->Pedido->numero_semana($hoy),
			'ano' => $this->Config->obtenerAno($hoy),
		));
		$this->Cuenta->save($cuenta);
		$this->Session->setFlash('El pedido ha sido despachado y se creo una cuenta');
		$this->redirect(array('action' => 'admin_pedidos'));	
	}
	
	function admin_asignar_cajas($pedido_id) {
		$cantidad = $this->Pedido->findById($pedido_id);
		$cantidad = $cantidad['Pedido']['cantidad_cajas'];
		if (!empty($this->data)) {
			$data = $this->data;
			foreach ($data['codigo'] as $c) {
				if (!empty($c)) {
					$count = 0;
					 foreach ($data['codigo'] as $d) {
						  $count += substr_count( $d, $c);
					 }
					if ($count > 1){
						$this->Session->setFlash("Cajas repetidas");
						$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
					}
					$caja = $this->Caja->find('first',array(
						'conditions' => array('Caja.codigo'=>$c)
					));
					if (empty($caja)) {
						$this->Session->setFlash("No existe una caja con el código ".$c);
						$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
					} else {
						$existe_codigo = $this->CajasPedido->find('first',array(
							'conditions' => array('CajasPedido.caja_id' => $caja['Caja']['id'])
						));
						if (!empty($existe_codigo)){
							$this->Session->setFlash("El código ".$c." ya ha sido asignado");
							$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
						} else {
							$buscar_en_inventario = $this->Inventarioalmacen->find('first',array(
								'conditions' => array(
									'Inventarioalmacen.id' => $caja['Caja']['inventarioalmacen_id']
								)
							));
							$articulo_id = $buscar_en_inventario['Inventarioalmacen']['articulo_id'];
							$acabado_id = $buscar_en_inventario['Inventarioalmacen']['acabado_id'];
							$pedido  = $this->Pedido->findById($pedido_id);
							if ($articulo_id != $pedido['Pedido']['articulo_id'] || $acabado_id != $pedido['Pedido']['acabado_id']) {
								$this->Session->setFlash("El código ".$c.' no contiene los articulos relacionados con este pedido');
								$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
							}
							$cajas_pedidos[] = array(
								'caja_id' => $caja['Caja']['id'],
								'pedido_id' => $pedido_id,
							);
						}
					}
				} else {
					$this->Session->setFlash("Debe ingresar todas las cajas");
					$this->redirect(array('action' => 'admin_asignar_cajas',$pedido_id));
				}
			}
			if($this->CajasPedido->saveAll($cajas_pedidos)){
				$pedido = $this->Pedido->findById($pedido_id);
				$hoy = date('Y-m-d H:i:s');
				$ultima_entrada = $this->Inventarioalmacen->find('first',array(
					'conditions' => array(
						'tipo' => 'salida'
					),
					'order' => array('Inventarioalmacen.id DESC')
				));
				if (!empty($ultima_entrada['Inventarioalmacen']['numero'])) {
					$numero = 1+$ultima_entrada['Inventarioalmacen']['numero'];
				} else {
					$numero = 1;
				}
				$data = array(
					'Inventarioalmacen' => array(
						'tipo' => 'salida',
						'articulo_id'=> $pedido['Articulo']['id'],
						'cajas' => $pedido['Pedido']['cantidad_cajas'],
						'acabado_id' => $pedido['Pedido']['acabado_id'],
						'pedido_id' => $pedido_id,
						'mes' => $this->Config->obtenerMes($hoy),
						'numero' => $numero,
						'semana' => $this->Pedido->numero_semana($hoy),
						'ano' => $this->Config->obtenerAno($hoy),
					)
				);
				$this->Inventarioalmacen->save($data);
				$update_pedido = array(
					'Pedido' => array(
						'id' => $pedido_id,
						'status' => 'Preparado',
					)
				);
				$this->Pedido->save($update_pedido);
				$this->redirect(array('action' => 'admin_info_egreso',$pedido_id));
			}
			//var_dump($this->data); die();
		}
		$this->set(compact('cantidad'));
	}
	
	function admin_info_egreso($pedido_id) {
		$pedido = $this->Pedido->findById($pedido_id);
		$hoy = date('d-m-Y');
		$this->layout = 'sin_menu';
		$ano = $this->Config->obtenerAno($pedido['Pedido']['fecha']);
		$pedido['Pedido']['num_pedido'] = $pedido['Pedido']['num_pedido'].$ano[2].$ano[3];
		$cajas = $this->CajasPedido->find('all',array(
			'conditions' => array('CajasPedido.pedido_id' => $pedido_id)
		));
		$this->set(compact('pedido','hoy','cajas'));
	}
	
	function admin_eliminar($id,$action) {
		$s = $this->Pedido->deleteAll(array('Pedido.id' => $id));
		$this->Cuenta->deleteAll(array('Cuenta.pedido_id' => $id));
		$this->Session->setFlash('El pedido se borró con éxito');
		$this->redirect(array('action' =>$action));
	}
	
	function admin_cancelar($id,$action) {
		$update = array('Pedido' => array(
			'id' => $id,
			'status' => 'Cancelado'
		));
		$this->Pedido->save($update);
		$this->CajasPedido->deleteAll(array('CajasPedido.pedido_id' => $id),false);
		$cuenta = $this->Cuenta->find('first',array(
			'conditions' => array('Cuenta.pedido_id' => $id)
		));
		
		if (!empty($cuenta)) {
			$update = array('Cuenta' => array(
				'id' => $cuenta['Cuenta']['id'],
				'status' => 'Cancelada' 
			));
			$this->Cuenta->save($update);
		}
		$this->Session->setFlash('El pedido se canceló con éxito');
		$this->redirect(array('action' =>$action));
	}
	
	function admin_ventas(){
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->ObtenerAno($hoy);
		$pedidos = $this->Pedido->find('all',array(
			'fields' => array('Distinct(Pedido.semana)'),
			'conditions' => array('Pedido.ano' => $ano,'Pedido.status' => 'Despachado'),
			'group' => array('Pedido.semana'),
		));
		$semanas = Set::combine($pedidos, '{n}.Pedido.semana', '{n}.Pedido.semana');
		foreach ($semanas as $s) {
			$semana = $this->Config->Semana($ano,$s);
			$mes_semana_start = $this->Config->ObtenerMes($semana['start']);
			$mes_semana_end = $this->Config->ObtenerMes($semana['end']);
			$dia_start = $this->Config->ObtenerDia($semana['start']);
			$dia_end = $this->Config->ObtenerDia($semana['end']);
			if ($mes_semana_start == $mes_semana_end) {
				$cadena = 'del '.$dia_start.' al '.$dia_end.'/'.$mes_semana_end;
			} else {
				$cadena = 'del '.$dia_start.'/'.$mes_semana_start.' al '.$dia_end.'/'.$mes_semana_end;
			}
			$ventas[$cadena] = $this->Pedido->find('all',array(
				'conditions' => array('Pedido.semana' => $s,'Pedido.status' => 'Despachado')
			));
			
			//sumar las cuentas de las semanas <= $s que tengan el $mes_semana_start, si $mes_semana_end es distinto hacer esa suma tambien
			// los arreglos seran $sum[$cadena][$mes_semana_start] y $sum[$cadena][$mes_semana_end] (en caso de que haga falta)
			$suma = $this->Pedido->find('first',array(
				'fields' => array('SUM(Pedido.cuenta)'),
				'conditions' => array('Pedido.semana <=' => $s,'Pedido.mes' => $mes_semana_start,'Pedido.status' => 'Despachado')
			));
			$nombre_mes = $this->Config->obtenerNombreMes($mes_semana_start);
			$sum[$cadena][$nombre_mes] = $suma[0]['SUM(`Pedido`.`cuenta`)'];  
			if($mes_semana_start != $mes_semana_end) {
				$suma = $this->Pedido->find('first',array(
					'fields' => array('SUM(Pedido.cuenta)'),
					'conditions' => array('Pedido.semana <=' => $s,'Pedido.mes' => $mes_semana_end,'Pedido.status' => 'Despachado')
				));
				$nombre_mes = $this->Config->obtenerNombreMes($mes_semana_end);
				$sum[$cadena][$nombre_mes] = $suma[0]['SUM(`Pedido`.`cuenta`)'];  
			}
		}
		
		$total_ventas = $this->Pedido->find('first',array(
			'fields' => array('SUM(Pedido.cuenta)'),
			'conditions' => array('Pedido.ano' => $ano,'Pedido.status' => 'Despachado')
		));
		$total_ventas = $total_ventas[0]['SUM(`Pedido`.`cuenta`)'];
		$this->set(compact('ventas','sum','total_ventas','ano'));
	}
}

?>