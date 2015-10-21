<?php
class IndexController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('RequestHandler','HighCharts.HighCharts');
	public $uses = array('Cuenta','Abono','Pedido','Config','Inventarioalmacen');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index'); // Letting users register themselves
	}
	
	function admin_reportes_mensuales() {
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		
		//Reportes mensuales
		$mes = $this->Config->obtenerMes($hoy);
		$nombre_mes = $this->Config->ObtenerNombreMes($mes);
		$mes_pasado = intval($mes)-1 ;
		if ($mes_pasado == 0) {
			$mes_pasado = 12;
			$ano_mes_pasado = intval($ano)-1 ;
		
		} else {
			$ano_mes_pasado = $ano;
		}
		$nombre_mes_pasado = $this->Config->ObtenerNombreMes($mes_pasado);
		$mes_antepasado = intval($mes_pasado)-1 ;
		if ($mes_antepasado == 0) {
			$mes_antepasado = 12;
			$ano_mes_antepasado = intval($ano)-1;
		} else {
			$ano_mes_antepasado = $ano;
		}
		$nombre_mes_antepasado = $this->Config->ObtenerNombreMes($mes_antepasado);
		$this->set(compact('nombre_mes','nombre_mes_pasado','nombre_mes_antepasado'));
		
		// Para la facturación 
		$facturaciones_actuales = count($this->Cuenta->find('all',array(
			'conditions' => array(
				'Cuenta.mes' => $mes,
				'Cuenta.ano' => $ano
			)
		)));
		$facturaciones_pasadas = count($this->Cuenta->find('all',array(
			'conditions' => array(
				'Cuenta.mes' => $mes_pasado,
				'Cuenta.ano' => $ano_mes_pasado
			)
		)));
		$facturaciones_antepasadas = count($this->Cuenta->find('all',array(
			'conditions' => array(
				'Cuenta.mes' => $mes_antepasado,
				'Cuenta.ano' => $ano_mes_antepasado
			)
		)));
		if ($facturaciones_antepasadas < $facturaciones_pasadas) {
			$facturacion = 'mayor';
		} else {
			$facturacion = 'menor';
		}
		
		$this->set(compact('facturaciones_actuales','facturaciones_pasadas','facturaciones_antepasadas','facturacion'));
		
		//Para las cuentas
		$cuentas_no_pagadas = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.mes <=' => $mes,
					'Cuenta.ano <=' => $ano,
					'OR' => array(
						'Cuenta.mes_pago >' => $mes,
						'Cuenta.mes_pago =' => 0,
					)
					
				),
			));
		$sum_cuentas_no_pagadas = 0;
		foreach ($cuentas_no_pagadas as $a) {
			$abonos = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono' ) ,
				'conditions' => array(
					'Abono.cuenta_id' => $a['Cuenta']['id'],
					'Abono.mes <=' => $mes,
					'Abono.ano <=' =>$ano
				),
				
			));
			if (empty($abonos[0][0]['abono'])) {
				$abonos[0][0]['abono'] = 0;
			}
			$sum_cuentas_no_pagadas = $sum_cuentas_no_pagadas+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
		}
		
		$cuentas_no_pagadas_pasadas = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.mes <=' => $mes_pasado,
					'Cuenta.ano <=' => $ano_mes_pasado,
					'OR' => array(
						'Cuenta.mes_pago >' => $mes_pasado,
						'Cuenta.mes_pago =' => 0,
					)
					
				),
			));
		$sum_cuentas_no_pagadas_pasadas = 0;
		foreach ($cuentas_no_pagadas_pasadas as $a) {
			$abonos = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono' ) ,
				'conditions' => array(
					'Abono.cuenta_id' => $a['Cuenta']['id'],
					'Abono.mes <=' => $mes_pasado,
					'Abono.ano <=' => $ano_mes_pasado
				),
				
			));
			if (empty($abonos[0][0]['abono'])) {
				$abonos[0][0]['abono'] = 0;
			}
			$sum_cuentas_no_pagadas_antepasadas = $sum_cuentas_no_pagadas_pasadas+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
		}
		
		$cuentas_no_pagadas_antepasadas = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.mes <=' => $mes_antepasado,
					'Cuenta.ano <=' => $ano_mes_antepasado,
					'OR' => array(
						'Cuenta.mes_pago >' => $mes_antepasado,
						'Cuenta.mes_pago =' => 0,
					)
					
				),
			));
		$sum_cuentas_no_pagadas_antepasadas = 0;
		foreach ($cuentas_no_pagadas_antepasadas as $a) {
			$abonos = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono' ) ,
				'conditions' => array(
					'Abono.cuenta_id' => $a['Cuenta']['id'],
					'Abono.mes <=' => $mes_antepasado,
					'Abono.ano <=' => $ano_mes_antepasado
				),
				
			));
			if (empty($abonos[0][0]['abono'])) {
				$abonos[0][0]['abono'] = 0;
			}
			$sum_cuentas_no_pagadas_antepasadas = $sum_cuentas_no_pagadas_antepasadas+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
		}
		
		if ($sum_cuentas_no_pagadas_antepasadas >= $sum_cuentas_no_pagadas_pasadas) {
			$sum_cuentas = 'menor';
		} else {
			$sum_cuentas = 'mayor';
		}
		
		$this->set(compact('sum_cuentas_no_pagadas_antepasadas','sum_cuentas_no_pagadas_pasadas','sum_cuentas_no_pagadas','sum_cuentas'));
		
		//Para cobranza
		$abonos_actuales = $this->Abono->find('all',array(
			'fields' => array('SUM(Abono.abono) as abono'),
			'conditions' => array(
				'Abono.mes' => floatval($mes),
				'Abono.ano' => $ano
			)
		));
		if (empty($abonos_actuales[0][0]['abono'])) {
			$abonos_actuales = 0;
		} else {
			$abonos_actuales = $abonos_actuales[0][0]['abono'];
		}
		
		$abonos_pasados = $this->Abono->find('all',array(
			'fields' => array('SUM(Abono.abono) as abono'),
			'conditions' => array(
				'Abono.mes' => $mes_pasado,
				'Abono.ano' => $ano_mes_pasado
			)
		));
		if (empty($abonos_pasados[0][0]['abono'])) {
			$abonos_pasados = 0;
		} else {
			$abonos_pasados = $abonos_pasados[0][0]['abono'];
		}
		
		$abonos_antepasados = $this->Abono->find('all',array(
			'fields' => array('SUM(Abono.abono) as abono'),
			'conditions' => array(
				'Abono.mes' => $mes_antepasado,
				'Abono.ano' => $ano_mes_antepasado
			)
		));
		if (empty($abonos_antepasados[0][0]['abono'])) {
			$abonos_antepasados = 0;
		} else {
			$abonos_antepasados = $abonos_antepasados[0][0]['abono'];
		}
		
		if ($abonos_pasados > $abonos_antepasados) {
			$cobranza = 'mayor';
		} else {
			$cobranza = 'menor';
		}
		
		$this->set(compact('cobranza','abonos_pasados','abonos_antepasados','abonos_actuales'));
		
		//Puntos por produccion
		$inventario_actual = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.mes' => $mes,
				'Inventarioalmacen.tipo' => 'entrada',
				'Inventarioalmacen.ano' => $ano,
			)
		));
		$puntos_produccion_actual = 0;
		foreach ($inventario_actual as $i) {
			$puntos_produccion_actual = $puntos_produccion_actual+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$inventario_pasado = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.mes' => $mes_pasado,
				'Inventarioalmacen.tipo' => 'entrada',
				'Inventarioalmacen.ano' => $ano_mes_pasado,
			)
		));
		$puntos_produccion_pasado = 0;
		foreach ($inventario_pasado as $i) {
			$puntos_produccion_pasado = $puntos_produccion_pasado+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$inventario_antepasado = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.mes' => $mes_antepasado,
				'Inventarioalmacen.tipo' => 'entrada',
				'Inventarioalmacen.ano' => $ano_mes_antepasado,
			)
		));
		$puntos_produccion_antepasado = 0;
		foreach ($inventario_antepasado as $i) {
			$puntos_produccion_antepasado = $puntos_produccion_antepasado+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		if ($puntos_produccion_antepasado >= $puntos_produccion_pasado) {
			$puntos_produccion = 'menor';
		} else {
			$puntos_produccion = 'mayor';
		}
		
		$this->set(compact('puntos_produccion','puntos_produccion_antepasado','puntos_produccion_pasado','puntos_produccion_actual'));
		
		//Puntos de Ventas
		$pedidos_actuales = $this->Pedido->find('all',array(
			'conditions' => array(
			'Pedido.mes_despacho' => $mes,
			'Pedido.status' => 'Despachado',
			'Pedido.ano' => $ano
			)
		));
		$puntos_ventas_actuales = 0;
		foreach ($pedidos_actuales as $i) {
			$puntos_ventas_actuales = $puntos_ventas_actuales+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$pedidos_pasados = $this->Pedido->find('all',array(
			'conditions' => array(
			'Pedido.mes_despacho' => $mes_pasado,
			'Pedido.status' => 'Despachado',
			'Pedido.ano' => $ano_mes_pasado
			)
		));
		$puntos_ventas_pasadas = 0;
		foreach ($pedidos_pasados as $i) {
			$puntos_ventas_pasadas = $puntos_ventas_pasadas+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$pedidos_antepasados = $this->Pedido->find('all',array(
			'conditions' => array(
			'Pedido.mes_despacho' => $mes_antepasado,
			'Pedido.status' => 'Despachado',
			'Pedido.ano' => $ano_mes_antepasado
			)
		));
		$puntos_ventas_antepasadas = 0;
		foreach ($pedidos_antepasados as $i) {
			$puntos_ventas_antepasadas = $puntos_ventas_antepasadas+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		if ($puntos_ventas_antepasadas >= $puntos_ventas_pasadas) {
			$puntos_ventas = 'menor';
		} else {
			$puntos_ventas = 'mayor';
		}
		
		$this->set(compact('puntos_ventas_actuales','puntos_ventas_pasadas','puntos_ventas_antepasadas','puntos_ventas'));
	}
	
	function admin_reportes_semanales() {
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$semana = $this->Pedido->numero_semana($hoy);
		$semana_pasada = intval($semana)-1 ;
		
		if ($semana_pasada == 0) {
			$semana_pasada = 52;
			$ano_semana_pasada = intval($ano)-1;
		} else {
			$ano_semana_pasada = $ano;
		}
	
		$semana_antepasada = intval($semana_pasada)-1 ;
		if ($semana_antepasada == 0) {
			$semana_antepasada = 52;
			$ano_semana_antepasada = intval($ano)-1;
		} else {
			$ano_semana_antepasada = $ano;
		}
	
		$this->set(compact('semana','semana_pasada','semana_antepasada'));
		
		// Para la facturación 
		$facturaciones_actuales = count($this->Cuenta->find('all',array(
			'conditions' => array('Cuenta.semana' => $semana,'Cuenta.ano' => $ano)
		)));
		$facturaciones_pasadas = count($this->Cuenta->find('all',array(
			'conditions' => array('Cuenta.semana' => $semana_pasada,'Cuenta.ano' => $ano_semana_pasada)
		)));
		$facturaciones_antepasadas = count($this->Cuenta->find('all',array(
			'conditions' => array('Cuenta.semana' => $semana_antepasada,'Cuenta.ano' => $ano_semana_antepasada)
		)));
		if ($facturaciones_antepasadas >= $facturaciones_pasadas) {
			$facturacion = 'menor';
		} else {
			$facturacion = 'mayor';
		}
		
		$this->set(compact('facturacion','facturaciones_antepasadas','facturaciones_pasadas','facturaciones_actuales'));
		
		//Para las cuentas
		$cuentas_no_pagadas = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.semana <=' => $semana,
					'Cuenta.ano' => $ano,
					'OR' => array(
						'Cuenta.semana_pago >' => $semana,
						'Cuenta.semana_pago =' => 0,
					)
					
				),
			));
		$sum_cuentas_no_pagadas = 0;
		foreach ($cuentas_no_pagadas as $a) {
			$abonos = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono' ) ,
				'conditions' => array(
					'Abono.cuenta_id' => $a['Cuenta']['id'],
					'Abono.semana <=' => $semana,
					'Abono.ano' => $ano,
				),
				
			));
			if (empty($abonos[0][0]['abono'])) {
				$abonos[0][0]['abono'] = 0;
			}
			$sum_cuentas_no_pagadas = $sum_cuentas_no_pagadas+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
		}
		
		$cuentas_no_pagadas_pasadas = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.semana <=' => $semana_pasada,
					'Cuenta.ano' => $ano_semana_pasada,
					'OR' => array(
						'Cuenta.semana_pago >' => $semana_pasada,
						'Cuenta.semana_pago =' => 0,
					)
					
				),
			));
		$sum_cuentas_no_pagadas_pasadas = 0;
		foreach ($cuentas_no_pagadas_pasadas as $a) {
			$abonos = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono' ) ,
				'conditions' => array(
					'Abono.cuenta_id' => $a['Cuenta']['id'],
					'Abono.semana <=' => $semana_pasada,
					'Abono.ano' => $ano_semana_pasada,
				),
				
			));
			if (empty($abonos[0][0]['abono'])) {
				$abonos[0][0]['abono'] = 0;
			}
			$sum_cuentas_no_pagadas_pasadas = $sum_cuentas_no_pagadas_pasadas+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
		}
		
		$cuentas_no_pagadas_antepasadas = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.semana <=' => $semana_antepasada,
					'Cuenta.ano' => $ano_semana_antepasada,
					'OR' => array(
						'Cuenta.semana_pago >' => $semana_pasada,
						'Cuenta.semana_pago =' => 0,
					)
					
				),
			));
		$sum_cuentas_no_pagadas_antepasadas = 0;
		foreach ($cuentas_no_pagadas_antepasadas as $a) {
			$abonos = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono' ) ,
				'conditions' => array(
					'Abono.cuenta_id' => $a['Cuenta']['id'],
					'Abono.semana <=' => $semana_pasada,
					'Abono.ano' => $ano_semana_antepasada,
				),
				
			));
			if (empty($abonos[0][0]['abono'])) {
				$abonos[0][0]['abono'] = 0;
			}
			$sum_cuentas_no_pagadas_antepasadas = $sum_cuentas_no_pagadas_antepasadas+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
		}
		
		if ($sum_cuentas_no_pagadas_antepasadas >= $sum_cuentas_no_pagadas_pasadas) {
			$sum_cuentas = 'menor';
		} else {
			$sum_cuentas = 'mayor';
		}
		
		$this->set(compact('sum_cuentas','sum_cuentas_no_pagadas_antepasadas','sum_cuentas_no_pagadas_pasadas','sum_cuentas_no_pagadas'));
		
		//Para cobranza
		$abonos_actuales = $this->Abono->find('all',array(
			'fields' => array('SUM(Abono.abono) as abono'),
			'conditions' => array(
				'Abono.semana' => floatval($semana),
				'Abono.ano' => $ano
			)
		));
		if (empty($abonos_actuales[0][0]['abono'])) {
			$abonos_actuales = 0;
		} else {
			$abonos_actuales = $abonos_actuales[0][0]['abono'];
		}
		
		$abonos_pasados = $this->Abono->find('all',array(
			'fields' => array('SUM(Abono.abono) as abono'),
			'conditions' => array(
				'Abono.semana' => floatval($semana_pasada),
				'Abono.ano' => $ano 	
			)
		));
		if (empty($abonos_pasados[0][0]['abono'])) {
			$abonos_pasados = 0;
		} else {
			$abonos_pasados = $abonos_pasados[0][0]['abono'];
		}
		
		$abonos_antepasados = $this->Abono->find('all',array(
			'fields' => array('SUM(Abono.abono) as abono'),
			'conditions' => array(
				'Abono.semana' => floatval($semana_pasada),
				'Abono.ano' => $ano 	
			)
		));
		if (empty($abonos_antepasados[0][0]['abono'])) {
			$abonos_antepasados = 0;
		} else {
			$abonos_antepasados = $abonos_antepasados[0][0]['abono'];
		}
		
		if ($abonos_pasados <= $abonos_antepasados) {
			$cobranza = 'menor';
		} else {
			$cobranza = 'mayor';
		}
		
		$this->set(compact('cobranza','abonos_pasados','abonos_actuales','abonos_antepasados'));
		
		//Puntos por produccion
		$inventario = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.semana' => $semana,
				'Inventarioalmacen.tipo' => 'entrada',
				'Inventarioalmacen.ano' => $ano,
			)
		));
		$puntos_produccion_actuales = 0;
		foreach ($inventario as $i) {
			$puntos_produccion_actuales = $puntos_produccion_actuales+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$inventario = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.semana' => $semana_pasada,
				'Inventarioalmacen.tipo' => 'entrada',
				'Inventarioalmacen.ano' => $ano_semana_pasada,
			)
		));
		$puntos_produccion_pasados = 0;
		foreach ($inventario as $i) {
			$puntos_produccion_pasados = $puntos_produccion_pasados+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$inventario = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.semana' => $semana_antepasada,
				'Inventarioalmacen.tipo' => 'entrada',
				'Inventarioalmacen.ano' => $ano_semana_antepasada,
			)
		));
		$puntos_produccion_antepasados = 0;
		foreach ($inventario as $i) {
			$puntos_produccion_antepasados = $puntos_produccion_antepasados+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		if ($puntos_produccion_antepasados >= $puntos_produccion_pasados) {
			$puntos_produccion = 'menor';
		} else {
			$puntos_produccion = 'mayor';
		}
		
		$this->set(compact('puntos_produccion_antepasados','puntos_produccion_pasados','puntos_produccion_actuales','puntos_produccion'));
		
		//Puntos de Ventas
		$pedidos = $this->Pedido->find('all',array(
			'conditions' => array(
			'Pedido.semana_despacho' => $semana,
			'Pedido.status' => 'Despachado',
			'Pedido.ano' => $ano
			)
		));
		$puntos_ventas_actuales = 0;
		foreach ($pedidos as $i) {
			$puntos_ventas_actuales = $puntos_ventas_actuales+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$pedidos = $this->Pedido->find('all',array(
			'conditions' => array(
			'Pedido.semana_despacho' => $semana_pasada,
			'Pedido.status' => 'Despachado',
			'Pedido.ano' => $ano_semana_pasada
			)
		));
		$puntos_ventas_pasados = 0;
		foreach ($pedidos as $i) {
			$puntos_ventas_pasados = $puntos_ventas_pasados+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		$pedidos = $this->Pedido->find('all',array(
			'conditions' => array(
			'Pedido.semana_despacho' => $semana_antepasada,
			'Pedido.status' => 'Despachado',
			'Pedido.ano' => $ano_semana_antepasada
			)
		));
		$puntos_ventas_antepasados = 0;
		foreach ($pedidos as $i) {
			$puntos_ventas_antepasados = $puntos_ventas_antepasados+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
			
		}
		
		if ($puntos_ventas_antepasados <= $puntos_ventas_pasados) {
			$puntos_ventas = 'menor';
		} else {
			$puntos_ventas = 'mayor';
		}
		$this->set(compact('puntos_ventas','puntos_ventas_actuales','puntos_ventas_pasados','puntos_ventas_antepasados'));
	}
	
	function admin_cuentas_mensual(){	
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$cuentas_por_mes = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.mes'), 
			'conditions' => array('Cuenta.ano' => $ano),
			'group' => array('Cuenta.mes'),
			'order' => array('Cuenta.mes DESC'),
		));
		$numero_meses = count($cuentas_por_mes);
		asort($cuentas_por_mes);
		foreach ($cuentas_por_mes as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($cuenta['Cuenta']['mes']));
			$meses_encontrados[] = $cuenta['Cuenta']['mes'];
		
		}
		foreach ($meses_encontrados as $mes) {
			$cuentas_no_pagadas[$mes] = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.mes <=' => $mes,
					'Cuenta.ano' => $ano,
					'OR' => array(
						'Cuenta.mes_pago >' => $mes,
						'Cuenta.mes_pago =' => 0,
					)
					
				),
			));
			//var_dump($cuentas_no_pagadas[8]);
		}

		foreach ($cuentas_no_pagadas as $mes => $c) {
			$sum = 0;
			foreach ($c as $a) {
				$abonos = $this->Abono->find('all',array(
					'fields' => array('SUM(Abono.abono) as abono' ) ,
					'conditions' => array(
						'Abono.cuenta_id' => $a['Cuenta']['id'],
						'Abono.mes <=' => $mes,
						'Abono.ano' => $ano
					),
					
				));
				if (empty($abonos[0][0]['abono'])) {
					$abonos[0][0]['abono'] = 0;
				}
				//var_dump($abonos); die();
				$sum = $sum+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
			}
			$chartData1[] = $sum;
			$nombre = "Monto que adeudan los clientes";
			$this->chart($chartData1,$meses,$nombre);
		}
  
	}

	function admin_cuentas_semanal(){
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$cuentas_por_semana = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.semana'), 
			'group' => array('Cuenta.semana'),
			'conditions' => array('Cuenta.ano' => $ano),
			'order' => array('Cuenta.semana DESC'),
		));
		
		foreach ($cuentas_por_semana as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$semanas[] = $cuenta['Cuenta']['semana'];
			$semanas_encontradas[] = $cuenta['Cuenta']['semana'];
		
		}
		foreach ($semanas_encontradas as $semana) {
			$cuentas_no_pagadas[$semana] = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.semana <=' => $semana,
					'OR' => array(
						'Cuenta.semana_pago >' => $semana,
						'Cuenta.semana_pago =' => 0,
					)
					
				),
			));
			//var_dump($cuentas_no_pagadas[8]);
		}

		foreach ($cuentas_no_pagadas as $semana => $c) {
			$sum = 0;
			foreach ($c as $a) {
				$abonos = $this->Abono->find('all',array(
					'fields' => array('SUM(Abono.abono) as abono' ) ,
					'conditions' => array(
						'Abono.cuenta_id' => $a['Cuenta']['id'],
						'Abono.semana <=' => $semana,
						'Abono.ano' => $ano
					),
					
				));
				if (empty($abonos[0][0]['abono'])) {
					$abonos[0][0]['abono'] = 0;
				}
				//var_dump($abonos); die();
				$sum = $sum+ ($a['Pedido']['cuenta']-$abonos[0][0]['abono']);
			}
			$chartData1[] = $sum;
			// $chartData1[] = floatval($cuenta[0]['cuenta']);
		}
        $nombre = 'Cuentas';
        $this->chart($chartData1,$semanas,$nombre);  
	}
	
	function admin_facturacion_mensual(){
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$cuentas_por_mes = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.mes'), 
			'conditions' => array('Cuenta.ano' => $ano),
			'group' => array('Cuenta.mes'),
			'order' => array('Cuenta.mes DESC'),
		)); 

		$numero_meses = count($cuentas_por_mes);
		asort($cuentas_por_mes);
		
		foreach ($cuentas_por_mes as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($cuenta['Cuenta']['mes']));
			$meses_encontrados[] = $cuenta['Cuenta']['mes'];
		
		}
		
		foreach ($meses_encontrados as $mes) {
			$cuentas[] = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.mes' => floatval($mes),
					'Cuenta.ano' => $ano
				)
			));
		}
		
		foreach ($cuentas as $c) {
			$chartData1[] = count($c);
		}
		
		$nombre = "Facturación Mensual";
		$this->chart($chartData1,$meses,$nombre); 
	}
	
	function admin_facturacion_semanal(){
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$cuentas_por_semana = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.semana'),
			'conditions' => array('Cuenta.ano' => $ano),
			'group' => array('Cuenta.semana'),
			'order' => array('Cuenta.semana DESC'),
		));
		$numero_semanas = count($cuentas_por_semana);
		asort($cuentas_por_semana);
		
		foreach ($cuentas_por_semana as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$semanas[] = $cuenta['Cuenta']['semana'];
			$semanas_encontradas[] = $cuenta['Cuenta']['semana'];
		
		}
		
		foreach ($semanas_encontradas as $semana) {
			$cuentas[] = $this->Cuenta->find('all',array(
				'conditions' => array(
					'Cuenta.semana' => floatval($semana) ,
					'Cuenta.ano' => $ano
				)
			));
		}
		
		foreach ($cuentas as $c) {
			$chartData1[] = count($c);
		}
		
		$nombre = 'Facturacion';
        $this->chart($chartData1,$semanas,$nombre);
	}
	
	function admin_cobranza_mensual(){
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		
		$cuentas_por_mes = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.mes'), 
			'conditions' => array('Cuenta.ano' => $ano),
			'group' => array('Cuenta.mes'),
			'order' => array('Cuenta.mes DESC'),
		));
		$numero_meses = count($cuentas_por_mes);
		asort($cuentas_por_mes);
		
		foreach ($cuentas_por_mes as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($cuenta['Cuenta']['mes']));
			$meses_encontrados[] = $cuenta['Cuenta']['mes'];
		
		}
		
		foreach ($meses_encontrados as $mes) {
			$abonos[$mes] = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono'),
				'conditions' => array(
					'Abono.mes' => floatval($mes),
					'Abono.ano' => $ano
					
				)
			));
		}
		//var_dump($abonos[10][0][0]);
		foreach ($abonos as $c) {
			if (empty($c[0][0]['abono'])) {
				$c[0][0]['abono'] = 0;
			}
			$chartData1[] = round(floatval($c[0][0]['abono']),2);
		}
		
        $nombre = "Cobranza Mensual";
		$this->chart($chartData1,$meses,$nombre);
	}
	
	function admin_cobranza_semanal(){
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		$cuentas_por_semana = $this->Cuenta->find('all',array(
			'fields' => array('Cuenta.semana'),
			'conditions' => array('Cuenta.ano' => $ano),
			'group' => array('Cuenta.semana'),
			'order' => array('Cuenta.semana DESC'),
		));
		$numero_semanas = count($cuentas_por_semana);
		asort($cuentas_por_semana);
		
		foreach ($cuentas_por_semana as $cuenta) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$semanas[] = $cuenta['Cuenta']['semana'];
			$semanas_encontradas[] = $cuenta['Cuenta']['semana'];
		
		}
		
		foreach ($semanas_encontradas as $semana) {
			$abonos[$semana] = $this->Abono->find('all',array(
				'fields' => array('SUM(Abono.abono) as abono'),
				'conditions' => array(
					'Abono.semana' => floatval($semana) ,
					'Abono.ano' => $ano
				)
			));
		}
		//var_dump($abonos[10][0][0]);
		foreach ($abonos as $c) {
			if (empty($c[0][0]['abono'])) {
				$c[0][0]['abono'] = 0;
			}
			$chartData1[] = round(floatval($c[0][0]['abono']),2);
		}
		$nombre = "Cobranza";
		$this->chart($chartData1,$semanas,$nombre);
	}
	
	function obtenerNombreMes($mes){
		if ($mes == 1) {
			return('Enero');
		} elseif ($mes == 2) {
			return('Febrero');
		} elseif ($mes == 3) {
			return('Marzo');
		} elseif ($mes == 4) {
			return('Abril');
		} elseif ($mes == 5) {
			return('Mayo');
		} elseif ($mes == 6) {
			return('Junio');
		} elseif ($mes == 7) {
			return('Julio');
		} elseif ($mes == 8) {
			return('Agosto');
		} elseif ($mes == 9) {
			return('Septiembre');
		} elseif ($mes == 10) {
			return('Octubre');
		} elseif ($mes == 11) {
			return('Noviembre');
		} elseif ($mes == 12) {
			return('Diciembre');
		} 
	}
	
	function admin_puntos_produccion_mensual() {
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		
		$ingresos_por_mes = $this->Inventarioalmacen->find('all',array(
			'fields' => array('Inventarioalmacen.mes'), 
			'conditions' => array(
				'Inventarioalmacen.ano' => $ano,
				'Inventarioalmacen.tipo' => 'entrada'
			),
			'group' => array('Inventarioalmacen.mes'),
			'order' => array('Inventarioalmacen.mes DESC'),
		)); 
		
		foreach ($ingresos_por_mes as $ingreso) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($ingreso['Inventarioalmacen']['mes']));
			$meses_encontrados[] = $ingreso['Inventarioalmacen']['mes'];
		
		}
		
		foreach ($meses_encontrados as $mes) {
			$inventario_actual = $this->Inventarioalmacen->find('all',array(
				'conditions' => array(
					'Inventarioalmacen.mes' => $mes,
					'Inventarioalmacen.ano' => $ano,
					'Inventarioalmacen.tipo' => 'entrada',
				)
			));
			$puntos_produccion_actual = 0;
			foreach ($inventario_actual as $i) {
				$puntos_produccion_actual = $puntos_produccion_actual+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
				
			}
			$chartData1[] = $puntos_produccion_actual;
		}
		$nombre = 'Puntos en produccion';
		$this->chart($chartData1,$meses,$nombre);
	}
	
	function admin_puntos_produccion_semanal() {
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		
		$ingresos_por_semana = $this->Inventarioalmacen->find('all',array(
			'fields' => array('Inventarioalmacen.semana'), 
			'conditions' => array(
				'Inventarioalmacen.ano' => $ano,
				'Inventarioalmacen.tipo' => 'entrada'
			),
			'group' => array('Inventarioalmacen.semana'),
			'order' => array('Inventarioalmacen.semana DESC'),
		)); 
		
		foreach ($ingresos_por_semana as $ingreso) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$semanas[] = floatval($ingreso['Inventarioalmacen']['semana']);
			$semanas_encontradas[] = $ingreso['Inventarioalmacen']['semana'];
		
		}
		
		foreach ($semanas_encontradas as $semana) {
			$inventario_actual = $this->Inventarioalmacen->find('all',array(
				'conditions' => array(
					'Inventarioalmacen.semana' => $semana,
					'Inventarioalmacen.ano' => $ano,
					'Inventarioalmacen.tipo' => 'entrada',
				)
			));
			$puntos_produccion_actual = 0;
			foreach ($inventario_actual as $i) {
				$puntos_produccion_actual = $puntos_produccion_actual+($i['Inventarioalmacen']['cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
				
			}
			$chartData1[] = $puntos_produccion_actual;
		}
		$nombre = 'Puntos en produccion';
		$this->chart($chartData1,$semanas,$nombre);
	}
	
	function admin_puntos_ventas_mensual() {
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		
		$pedidos_por_mes = $this->Pedido->find('all',array(
			'fields' => array('Pedido.mes_despacho'), 
			'conditions' => array(
				'Pedido.ano' => $ano,
				'Pedido.status' => 'Despachado',
			),
			'group' => array('Pedido.mes_despacho'),
			'order' => array('Pedido.mes_despacho DESC'),
		)); 
	
		
		foreach ($pedidos_por_mes as $pedidos) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$meses[] = $this->obtenerNombreMes(floatval($pedidos['Pedido']['mes_despacho']));
			$meses_encontrados[] = $pedidos['Pedido']['mes_despacho'];
		
		}
		
		foreach ($meses_encontrados as $mes) {
			$pedidos_actuales = $this->Pedido->find('all',array(
				'conditions' => array(
				'Pedido.mes_despacho' => $mes,
				'Pedido.status' => 'Despachado',
				'Pedido.ano' => $ano
				)
			));
			$puntos_ventas_actuales = 0;
			foreach ($pedidos_actuales as $i) {
				$puntos_ventas_actuales = $puntos_ventas_actuales+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
				
			}
			$chartData1[] = $puntos_ventas_actuales;
		}
		$nombre = 'Puntos en Ventas';
		$this->chart($chartData1,$meses,$nombre);
	}
	
	function admin_puntos_ventas_semanal() {
		$hoy = date('Y-m-d H:i:s');
		$ano = $this->Config->obtenerAno($hoy);
		
		$pedidos_por_mes = $this->Pedido->find('all',array(
			'fields' => array('Pedido.semana_despacho'), 
			'conditions' => array(
				'Pedido.ano' => $ano,
				'Pedido.status' => 'Despachado',
			),
			'group' => array('Pedido.semana_despacho'),
			'order' => array('Pedido.semana_despacho DESC'),
		)); 
	
		
		foreach ($pedidos_por_mes as $pedidos) {
			//$chartData1[] = floatval($cuenta[0]['cuenta']);
			$semanas[] = $this->obtenerNombreMes(floatval($pedidos['Pedido']['semana_despacho']));
			$semanas_encontradas[] = $pedidos['Pedido']['semana_despacho'];
		
		}
		
		foreach ($semanas_encontradas as $semana) {
			$pedidos_actuales = $this->Pedido->find('all',array(
				'conditions' => array(
				'Pedido.semana_despacho' => $semana,
				'Pedido.status' => 'Despachado',
				'Pedido.ano' => $ano
				)
			));
			$puntos_ventas_actuales = 0;
			foreach ($pedidos_actuales as $i) {
				$puntos_ventas_actuales = $puntos_ventas_actuales+($i['Pedido']['cantidad_cajas']*$i['Articulo']['cantidad_por_caja']*$i['Articulo']['puntos']);
				
			}
			$chartData1[] = $puntos_ventas_actuales;
		}
		$nombre = 'Puntos en Ventas';
		$this->chart($chartData1,$semanas,$nombre);
	}
	
	function chart($chartData1,$tiempo,$nombre){
		$chartName = 'Line Chart with Data Labels';
        $mychart = $this->HighCharts->create( $chartName, 'line' );

        $this->HighCharts->setChartParams(
                        $chartName,
                        array (
                                'renderTo'				=> 'linewrapper',  // div to display chart inside
                                'chartWidth'				=> 500,
                                'chartHeight'				=> 500,
                                'chartMarginTop' 			=> 60,
                                'chartMarginLeft'			=> 90,
                                'chartMarginRight'			=> 30,
                                'chartMarginBottom'			=> 110,
                                'chartSpacingRight'			=> 10,
                                'chartSpacingBottom'			=> 15,
                                'chartSpacingLeft'			=> 0,
                                'chartAlignTicks'			=> FALSE,
                                'chartTheme'                            => '',

                                'title'					=> '',
                                'subtitle'				=> '',
                                'titleAlign'				=> 'center',
                                'titleFloating'				=> TRUE,
                                'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                                'titleStyleColor'			=> '#0099ff',
                                'titleX'				=> 20,
                                'titleY'				=> 10,

                                'legendEnabled' 			=> TRUE,
                                'legendLayout'				=> 'horizontal',
                                'legendAlign'				=> 'center',
                                'legendVerticalAlign '			=> 'bottom',
                                'legendItemStyle'			=> array('color' => '#222'),
                                'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                                'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                                'tooltipEnabled' 			=> TRUE,
                                
                                'xAxisLabelsEnabled' 			=> TRUE,
                                'xAxisLabelsAlign' 			=> 'right',
                                'xAxisLabelsStep' 			=> 1,
                                'xAxislabelsX' 				=> 5,
                                'xAxisLabelsY' 				=> 20,
                                'xAxisCategories'           		=> $tiempo,

                                'yAxisTitleText' 			=> 'Temperature (°C)',

                                'plotOptionsLineDataLabelsEnabled' 	=> TRUE,
                                'plotOptionsLineEnableMouseTracking' 	=> TRUE,

                                /* autostep options */
                                'enableAutoStep' 			=> FALSE
                        )

            );

        $series1 = $this->HighCharts->addChartSeries();
       
        $series1->addName($nombre)->addData($chartData1);

       
        $mychart->addSeries($series1);
		return true;
	}
}	

?>