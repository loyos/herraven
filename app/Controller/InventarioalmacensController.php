<?php

class InventarioalmacensController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Inventarioalmacen','Materiasprima','Inventariomaterial','Config','Categoria','Articulo','Acabado','Caja','Subcategoria','AcabadosMateriasprima','Pedido');
	
	
	function admin_agregar(){
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		$this->set(compact('categorias'));
	}
	
	function admin_listar_subcategorias($action){
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		$this->set(compact('categorias','action'));
	}
	
	function buscar_subcat() {
		$this->loadModel('Subcategoria');
		$subcat = $this->Subcategoria->find('all', array(
			'conditions' => array('Subcategoria.categoria_id' => $_POST['cat_id'])
		));
		$this->autoRender = false;
		$this->RequestHandler->respondAs('json');
		echo json_encode($subcat);
	}
	
	function admin_ingresar($id) {
		$articulo = $this->Articulo->findById($id);
		if (!empty($this->data)) {
			$data = $this->data;
			$hoy = date('Y-m-d H:i:s');
			//Materia prima que se gasta sin el acabado
			foreach ($articulo['Materiasprima'] as $m) {
				$cantidad_materia = $m['ArticulosMateriasprima']['cantidad'] * $data['Inventarioalmacen']['cajas'] *$articulo['Articulo']['cantidad_por_caja'];
				$inventario_materia = array(
					'Inventariomaterial' => array(
						'trimestre' => $this->Config->obtenerTrimestre($hoy),
						'ano' => $this->Config->obtenerAno($hoy),
						'semana' => $this->Config->obtenerSemana($hoy),
						'mes' => $this->Config->obtenerMes($hoy),
						'tipo' => 'salida',
						'fecha' => $hoy,
						'materiasprima_id' => $m['id'],
						'cantidad' => $cantidad_materia
					)
				);
				$this->Inventariomaterial->create();
				$this->Inventariomaterial->save($inventario_materia);	
			}
			//Materia prima que se gasta con el acabado
			if (!empty($data['Inventarioalmacen']['acabado_id'])) {
				$materias_prima = $this->AcabadosMateriasprima->find('all',array(
					'conditions' => array(
						'AcabadosMateriasprima.articulo_id' => $id,
						'AcabadosMateriasprima.acabado_id' => $data['Inventarioalmacen']['acabado_id'],
					)
				));
				foreach ($materias_prima as $m) {
					$cantidad_materia = $m['AcabadosMateriasprima']['cantidad'] * $data['Inventarioalmacen']['cajas'] *$articulo['Articulo']['cantidad_por_caja'];
					$inventario_materia = array(
						'Inventariomaterial' => array(
							'trimestre' => $this->Config->obtenerTrimestre($hoy),
							'ano' => $this->Config->obtenerAno($hoy),
							'semana' => $this->Config->obtenerSemana($hoy),
							'mes' => $this->Config->obtenerMes($hoy),
							'tipo' => 'salida',
							'fecha' => $hoy,
							'materiasprima_id' => $m['AcabadosMateriasprima']['materiasprima_id'],
							'cantidad' => $cantidad_materia
						)
					);
					$this->Inventariomaterial->create();
					$this->Inventariomaterial->save($inventario_materia);	

				}
			}
			//var_dump($materias_prima);die();
			$ultima_entrada = $this->Inventarioalmacen->find('first',array(
				'conditions' => array(
					'tipo' => 'entrada'
				),
				'order' => array('Inventarioalmacen.id DESC')
			));
			if (!empty($ultima_entrada['Inventarioalmacen']['numero'])) {
				$numero = 1+$ultima_entrada['Inventarioalmacen']['numero'];
			} else {
				$numero = 1;
			}
			$inventario_almacen = array(
				'Inventarioalmacen' => array(
					'tipo' => 'entrada',
					'articulo_id' => $id,
					'fecha' => $hoy,
					'mes' => $this->Config->obtenerMes($hoy),
					'cajas' => $data['Inventarioalmacen']['cajas'],
					'acabado_id' => $data['Inventarioalmacen']['acabado_id'],
					'numero' => $numero,
					'semana' => $this->Pedido->numero_semana($hoy),
					'ano' => $this->Config->obtenerAno($hoy),
				)
			);
			if ($this->Inventarioalmacen->save($inventario_almacen)) {
				$id_inventario_almacen = $this->Inventarioalmacen->id;
				$numero_cajas = $data['Inventarioalmacen']['cajas'];
				for ($i = 1; $i <= $numero_cajas ; $i++) {
					$caja = array('caja');
					while (!empty($caja)) {
						$codigo = $this->Caja->generar_codigo();
						$caja = $this->Caja->find('first',array(
							'conditions' => array('Caja.codigo' => $codigo)
						));
					}
					$nueva_caja = array(
						'Caja' => array(
							'inventarioalmacen_id' => $id_inventario_almacen,
							'codigo' => $codigo
					));
					$this->Caja->create();
					$this->Caja->save($nueva_caja);	
				}
				$this->Session->setFlash("El ingreso al almacén se realizó con éxito");
				$this->redirect(array('action' => 'admin_etiquetas',$id_inventario_almacen));
			}
			
		}
		
		$acabados_encontrados = $this->AcabadosMateriasprima->find('all', array (
			'fields' => array(
				'DISTINCT acabado_id'
			),
			'conditions' => array(
				'articulo_id' => $id
			),
			'recursive' => 2
		));
		foreach ($acabados_encontrados as $a) {
			$acabado = $this->Acabado->findById($a['AcabadosMateriasprima']['acabado_id']);
			$acabados[$a['AcabadosMateriasprima']['acabado_id']] = $acabado['Acabado']['acabado'];
		}
		$acabados[0] = 'Sin acabado';
		$this->set(compact('acabados','articulo'));
	}
	
	function admin_index(){
		
	}
	
	function admin_articulos($cat_id = null,$sub_id = null) {
		if (empty($sub_id)) {
			$buscar_sub = $this->Subcategoria->find('all',array(
				'conditions' => array('Subcategoria.categoria_id' => $cat_id)
			));
			foreach ($buscar_sub as $sub) {
				$sub_id[]= $sub['Subcategoria']['id'];
			}
		}
		$articulos = $this->Articulo->find('all',array(
			'conditions' => array(
				'Articulo.subcategoria_id' => $sub_id,
				'Articulo.oculto' => 0
			)
		));
		$this->set(compact('articulos'));
	}
	
	function admin_etiquetas($id_inventario,$print=null) {
		$cajas = $this->Caja->find('all', array(
			'conditions' => array(
				'inventarioalmacen_id' => $id_inventario
			),
			'recursive' => 2
		));

		//$this->layout = 'sin_menu';
		$this->set(compact('cajas','id_inventario'));
	} 
	
	function admin_inventario($cat_id, $sub_id = null){
		if (empty($sub_id)) {
			$subcategorias = $this->Subcategoria->find('all',array(
				'conditions' => array ('Subcategoria.categoria_id' => $cat_id)
			));
			if (!empty($subcategorias)) {
				foreach ($subcategorias as $s) {
					$sub[] = $s['Subcategoria']['id'];
				}
			}
			if (!empty($sub)) {
				$articulos = $this->Articulo->find('all',array(
					'conditions' => array('Articulo.subcategoria_id' => $sub)
				));
			} 
		} else {
			$articulos = $this->Articulo->find('all',array(
					'conditions' => array('Articulo.subcategoria_id' => floor($sub_id))
				));
		}
		$acabados = $this->Acabado->find('all');
		$ano = date ("Y");
		foreach ($articulos as $a) {
			$entradas_articulo[$a['Articulo']['codigo']] = $this->Inventarioalmacen->find('all',array(
				'fields' => array('SUM(Inventarioalmacen.cajas)','acabado_id','Acabado.acabado','Inventarioalmacen.articulo_id'),
				'conditions' => array(
					'Inventarioalmacen.articulo_id' => $a['Articulo']['id'],
					'Inventarioalmacen.tipo' => 'entrada',
				),
				'group' => array('Inventarioalmacen.acabado_id')
			));
			$salidas_articulo[$a['Articulo']['codigo']] = $this->Inventarioalmacen->find('all',array(
				'fields' => array('SUM(Inventarioalmacen.cajas)','acabado_id'),
				'conditions' => array(
					'Inventarioalmacen.articulo_id' => $a['Articulo']['id'],
					'Inventarioalmacen.tipo' => 'salida',
				),
				'group' => array('Inventarioalmacen.acabado_id')
			));
		} 
		$articulos = $this->Articulo->find('list',array(
			'fields' => array('id','cantidad_por_caja')
		));
		$this->set(compact('entradas_articulo','salidas_articulo','articulos','acabados','cat_id','sub_id'));
	}
	
	function admin_consultar_cajas($articulo_id,$acabado_id,$saldo,$cat_id,$sub_id=null) {
		$articulo = $this->Articulo->findById($articulo_id);
		$acabado = $this->Acabado->findById($acabado_id);
		$entradas = $this->Inventarioalmacen->find('all',array(
			'conditions' => array(
				'Inventarioalmacen.articulo_id' => $articulo_id,
				'Inventarioalmacen.acabado_id' => $acabado_id,
			
			)
		));
		foreach ($entradas as $e){
			$inventario[] = $e['Inventarioalmacen']['id'];
		}
		$cajas = $this->Caja->find('all',array(
			'conditions' => array(
				'Caja.inventarioalmacen_id' => $inventario,
			),
			'order' => array('Caja.id')
		));
		$num_cajas = count($cajas);
		$this->set(compact('cajas','num_cajas','articulo','acabado','cat_id','sub_id','saldo'));
	}
	
	function admin_movimientos($cat_id, $sub_id = null){
		if (empty($sub_id)) {
			$subcategorias = $this->Subcategoria->find('all',array(
				'conditions' => array ('Subcategoria.categoria_id' => $cat_id)
			));
			if (!empty($subcategorias)) {
				foreach ($subcategorias as $s) {
					$sub[] = $s['Subcategoria']['id'];
				}
			}
			if (!empty($sub)) {
				$conditions = array('Articulo.subcategoria_id' => $sub);
			} 
		} else {
			$conditions = array('Articulo.subcategoria_id' => floor($sub_id));
		}
		if (!empty($this->data)){
			if (!empty($this->data['Inventarioalmacen']['articulo_id'])) {
				$conditions[] = array('Inventarioalmacen.articulo_id' => $this->data['Inventarioalmacen']['articulo_id']);
			}
			if (!empty($this->data['Inventarioalmacen']['tipo'])) {
				$conditions[] = array('Inventarioalmacen.tipo' => $this->data['Inventarioalmacen']['tipo']);
			} 
			if (!empty($this->data['Inventarioalmacen']['mes'])) {
				$conditions[] = array('Inventarioalmacen.mes' => $this->data['Inventarioalmacen']['mes']);
			}
			if (!empty($this->data['Inventarioalmacen']['acabado_id'])) {
				if ($this->data['Inventarioalmacen']['acabado_id'] == 'Sin Acabado') {
					$conditions[] = array('Pedido.acabado_id' => 0);
				} else {
					$conditions[] = array('Acabado.acabado LIKE' => $this->data['Inventarioalmacen']['acabado_id']);
				}
			}
			if (!empty($this->data['Inventarioalmacen']['articulo_id'])) {
				if (empty($this->data['Inventarioalmacen']['tipo'])) {
					$cond1 = $conditions;
					$cond1[] = array('Inventarioalmacen.tipo' => 'entrada');
					$entradas = $this->Inventarioalmacen->find('all',array(
						'conditions' => $cond1,
						'fields' => 'SUM(Inventarioalmacen.cajas)'
					));
					$cond2 = $conditions;
					$cond2[] = array('Inventarioalmacen.tipo' => 'salida');
					$salidas = $this->Inventarioalmacen->find('all',array(
						'conditions' => $cond2,
						'fields' => 'SUM(Inventarioalmacen.cajas)'
					));
					$saldo = $entradas[0][0]['SUM(`Inventarioalmacen`.`cajas`)'] - $salidas[0][0]['SUM(`Inventarioalmacen`.`cajas`)'];
					$this->set(compact('saldo'));
				} else {
					$saldo = $this->Inventarioalmacen->find('all',array(
						'conditions' => $conditions,
						'fields' => 'SUM(Inventarioalmacen.cajas)'
					));
					$saldo = $saldo[0][0]['SUM(`Inventarioalmacen`.`cajas`)'];
					$this->set(compact('saldo'));
				}
			}
		} 
		$inventarios = $this->Inventarioalmacen->find('all',array(
			'conditions' => $conditions
		));
		$meses = array(
			'0' => '',
			'1' => 'Enero',
			'2' => 'Febrero',
			'3' => 'Marzo',
			'4' => 'Abril',
			'5' => 'Mayo',
			'6' => 'Junio',
			'7' => 'Julio',
			'8' => 'Agosto',
			'9' => 'Septiembre',
			'10' => 'Octubre',
			'11' => 'Noviembre',
			'12' => 'Diciembre',
		);
		$articulos = $this->Articulo->find('list',array(
			'fields' => array('id','codigo')
		));
		$acabados = $this->Acabado->find('list', array(
			'fields' => array('Acabado.acabado', 'Acabado.acabado')
		));
		$acabados['Sin Acabado'] = 'Sin Acabado';
		$acabados = array_merge(array('Todos'), $acabados);
		$articulos[0] = '';
		$tipos = array(
			'0' => '',
			'entrada' => 'Ingreso',
			'salida' => 'Egreso'
		);
		$this->set(compact('meses','articulos','tipos','inventarios','saldo','acabados'));
	}
	
	function admin_nota_entrada($id_inventario){
		$cajas = $this->Caja->find('all', array(
			'conditions' => array(
				'inventarioalmacen_id' => $id_inventario
			),
			'recursive' => 2
		));
		$hoy = date('d-m-Y H:i:s');
		$this->set(compact('cajas','hoy'));
		$this->layout = 'sin_menu';
		//var_dump($cajas);die();
	}
}

?>