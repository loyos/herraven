<?php



class AlmacenclientesController extends AppController {

    

	public $helpers = array ('Html','Form');

	public $components = array('Session','JqImgcrop','RequestHandler');

	public $uses = array('Almacencliente','Inventarioalmacen','CajasPedido','Inventariomaterial','Config','Categoria','Articulo','Acabado','Caja','Subcategoria','User','Cliente');

	

	function index($cat_id, $sub_id = null){

		$user_id = $this->Auth->user('id');

		$user = $this->User->findById($user_id);

		$cliente_id = $user['User']['cliente_id'];

		if (empty($sub_id)) {

			$subcategorias = $this->Subcategoria->find('all',array(

				'conditions' => array('Subcategoria.categoria_id' => $cat_id)

			));

			foreach ($subcategorias as $s) {

				$sub[] = $s['Subcategoria']['id'];

			}

		} else {

			$sub = $sub_id;

		}

		$almacen = $this->Almacencliente->find('all',array(

			'conditions' => array(

				'Pedido.cliente_id' => $cliente_id,

				'Articulo.subcategoria_id' => $sub

			),

			'recursive' => 2



		));

		

		foreach ($almacen as $a) {

			$articulos_almacen[] = $a['Almacencliente']['articulo_id']; 

		}

		if (!empty($articulos_almacen)) {

		$articulos = $this->Articulo->find('all',array(

			'conditions' => array('Articulo.id' => $articulos_almacen)

		));

		$acabados = $this->Acabado->find('all');

		$ano = date ("Y");

		foreach ($articulos as $a) {

			$entradas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(

				'fields' => array('SUM(Almacencliente.cajas)','acabado_id','Acabado.acabado','Almacencliente.articulo_id'),

				'conditions' => array(

					'Almacencliente.articulo_id' => $a['Articulo']['id'],

					'Almacencliente.tipo' => 'entrada',

					'Pedido.cliente_id' => $cliente_id,

				),

				'group' => array('Almacencliente.acabado_id')

			));

			$salidas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(

				'fields' => array('SUM(Almacencliente.cajas)','acabado_id'),

				'conditions' => array(

					'Almacencliente.articulo_id' => $a['Articulo']['id'],

					'Almacencliente.tipo' => 'salida',

					'Almacencliente.cliente_id' => $cliente_id,

				),

				'group' => array('Almacencliente.acabado_id')

			));

		} 

		$articulos = $this->Articulo->find('list',array(

			'fields' => array('id','cantidad_por_caja')

		));

		$this->set(compact('entradas_articulo','salidas_articulo','articulos','acabados','cat_id','sub_id'));

		}

	}

	

	function egreso($articulo_id, $acabado_id,$cat_id,$sub_id = null) {

		if (!empty($this->data)) {

			$articulo_id = $this->data['Almacencliente']['articulo_id'];

			$acabado_id = $this->data['Almacencliente']['acabado_id'];

			$cat_id = $this->data['Config']['cat_id'];

			if (!empty($this->data['Config']['sub_id'])) {

				$sub_id = $this->data['Config']['sub_id'];

			} else {

				$sub_id = null;

			}

			if (empty($this->data['Almacencliente']['codigo'])) {

				$this->Session->setFlash('Debes colocar el código de la caja');

				$this->redirect(array('action' =>'egreso',$articulo_id,$acabado_id,$cat_id,$sub_id));

			}

			$user_id = $this->Auth->user('id');

			$user = $this->User->findById($user_id);

			$cliente_id = $user['User']['cliente_id'];

			$almacen = $this->Almacencliente->find('all',array(

				'conditions' => array('Pedido.cliente_id' => $cliente_id),



			));

			foreach ($almacen as $a) {

				$pedidos_almacen[] = $a['Almacencliente']['pedido_id']; 

			}

			$caja = $this->CajasPedido->find('first',array(

				'conditions' => array(

					'Caja.codigo' => $this->data['Almacencliente']['codigo'],

					'CajasPedido.pedido_id' => $pedidos_almacen,

					'Pedido.articulo_id' => $articulo_id,

					'Pedido.acabado_id' => $acabado_id,

				),

				'link' => array('Caja','Pedido')

			));

			if (empty($caja)) {

				$this->Session->setFlash('Código inválido');

				$this->redirect(array('action' =>'egreso',$articulo_id,$acabado_id,$cat_id,$sub_id));

			} 

			$existe_caja = $this->Almacencliente->find('first',array(

				'conditions' => array('Almacencliente.caja_id' => $caja['Caja']['id'])

			));

			if (empty($existe_caja)) {

				$hoy = date('Y-m-d H:i:s');

				$data = array(

					'Almacencliente' => array(

						'tipo' => 'salida',

						'articulo_id'=> $articulo_id,

						'cajas' => 1,

						'acabado_id' => $acabado_id,

						'mes' => $this->Config->obtenerMes($hoy),

						'caja_id' => $caja['Caja']['id'],

						'cliente_id' => $cliente_id

					)

				);

				$this->Almacencliente->save($data);

				$this->Session->setFlash('El egreso se realizó con éxito');

				$this->redirect(array('action' =>'index',$cat_id,$sub_id));

			} else {

				$this->Session->setFlash('La caja ya ha sido egresada del almacén');

				$this->redirect(array('action' =>'egreso',$articulo_id,$acabado_id,$cat_id,$sub_id));

			}

		}

		$this->set(compact('articulo_id','acabado_id','cat_id','sub_id'));

	}



	function admin_index($cliente_id,$cat_id,$sub_id = null){

		if (empty($sub_id)) {

			$subcategorias = $this->Subcategoria->find('all',array(

				'conditions' => array(

					'Subcategoria.categoria_id' => $cat_id

				)

			));

			foreach ($subcategorias as $s) {

				$id_sub[] = $s['Subcategoria']['id'];

			}

		} else {

			$id_sub = $sub_id;

		}

		$almacen = $this->Almacencliente->find('all',array(

			'conditions' => array(

				'Pedido.cliente_id' => $cliente_id,

				'Articulo.subcategoria_id' => $id_sub

			),



		));

		foreach ($almacen as $a) {

			$articulos_almacen[] = $a['Almacencliente']['articulo_id']; 

		}

		if (!empty($articulos_almacen)) {

		$articulos = $this->Articulo->find('all',array(

			'conditions' => array('Articulo.id' => $articulos_almacen)

		));

		$acabados = $this->Acabado->find('all');

		$ano = date ("Y");

		foreach ($articulos as $a) {

			$entradas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(

				'fields' => array('SUM(Almacencliente.cajas)','acabado_id','Acabado.acabado','Almacencliente.articulo_id'),

				'conditions' => array(

					'Almacencliente.articulo_id' => $a['Articulo']['id'],

					'Almacencliente.tipo' => 'entrada',

					'Pedido.cliente_id' => $cliente_id

				),

				'group' => array('Almacencliente.acabado_id')

			));

			$salidas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(

				'fields' => array('SUM(Almacencliente.cajas)','acabado_id'),

				'conditions' => array(

					'Almacencliente.articulo_id' => $a['Articulo']['id'],

					'Almacencliente.tipo' => 'salida',

					'Almacencliente.cliente_id' => $cliente_id

				),

				'group' => array('Almacencliente.acabado_id')

			));

		} 

		$articulos = $this->Articulo->find('list',array(

			'fields' => array('id','cantidad_por_caja')

		));

		}

		$cliente = $this->Cliente->findById($cliente_id);

		$this->set(compact('entradas_articulo','salidas_articulo','articulos','acabados','cliente'));

	}

	

	function admin_listar_clientes() {

		$clientes = $this->Cliente->find('all');
		$clientes = $this->Cliente->findRegistered();

		$action = 'admin_listar_subcategorias';

		$this->set(compact('clientes','action'));

	}

	

	function admin_listar_subcategorias($action,$cliente_id) {

		$categorias = $this->Categoria->find('all',array(

			'contain' => array('Subcategoria')

		));

		$this->set(compact('categorias','action','cliente_id'));

	}

	

	function listar_subcategorias($action) {

		$categorias = $this->Categoria->find('all',array(

			'contain' => array('Subcategoria')

		));

		$this->set(compact('categorias','action'));

	}

	

	function inventario($cat_id, $sub_id = null){

		$cliente_id = $this->User->findById($this->Auth->User('id'));

		$cliente_id = $cliente_id['User']['cliente_id'];

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

			$entradas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(

				'fields' => array('SUM(Almacencliente.cajas)','acabado_id','Acabado.acabado','Almacencliente.articulo_id'),

				'conditions' => array(

					'Almacencliente.articulo_id' => $a['Articulo']['id'],

					'Almacencliente.tipo' => 'entrada',

					'Pedido.cliente_id' => $cliente_id,

				),

				'group' => array('Almacencliente.acabado_id')

			));

			$salidas_articulo[$a['Articulo']['codigo']] = $this->Almacencliente->find('all',array(

				'fields' => array('SUM(Almacencliente.cajas)','acabado_id'),

				'conditions' => array(

					'Almacencliente.articulo_id' => $a['Articulo']['id'],

					'Almacencliente.tipo' => 'salida',

					'Almacencliente.cliente_id' => $cliente_id 

				),

				'group' => array('Almacencliente.acabado_id')

			));

		} 

		$articulos = $this->Articulo->find('list',array(

			'fields' => array('id','cantidad_por_caja')

		));

		$this->set(compact('entradas_articulo','salidas_articulo','articulos','acabados','cat_id','sub_id'));

	}

	

	function consultar_cajas($articulo_id,$acabado_id,$saldo,$cat_id,$sub_id=null) {

		$cliente_id = $this->User->findById($this->Auth->User('id'));

		$cliente_id = $cliente_id['User']['cliente_id'];

		$articulo = $this->Articulo->findById($articulo_id);

		$acabado = $this->Acabado->findById($acabado_id);

		$entradas = $this->Almacencliente->find('all',array(

			'conditions' => array(

				'Almacencliente.articulo_id' => $articulo_id,

				'Almacencliente.acabado_id' => $acabado_id,

				'Pedido.cliente_id' => $cliente_id,

			)

		));

		foreach ($entradas as $e){

			$pedidos[] = $e['Almacencliente']['pedido_id'];

		}

		

		$cajas = $this->CajasPedido->find('all',array(

				'conditions' => array(

					'CajasPedido.pedido_id' => $pedidos,

					'Pedido.articulo_id' => $articulo_id,

					'Pedido.acabado_id' => $acabado_id,

				),		

			));

		$this->set(compact('cajas','num_cajas','articulo','acabado','cat_id','sub_id','saldo'));

	}

	

	function movimientos($cat_id, $sub_id = null){

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

			if (!empty($this->data['Almacencliente']['articulo_id'])) {

				$conditions[] = array('Almacencliente.articulo_id' => $this->data['Almacencliente']['articulo_id']);

			}

			if (!empty($this->data['Almacencliente']['tipo'])) {

				$conditions[] = array('Almacencliente.tipo' => $this->data['Almacencliente']['tipo']);

			} 

			if (!empty($this->data['Almacencliente']['mes'])) {

				$conditions[] = array('Almacencliente.mes' => $this->data['Almacencliente']['mes']);

			}

			if (!empty($this->data['Almacencliente']['acabado_id'])) {

				if ($this->data['Almacencliente']['acabado_id'] == 'Sin Acabado') {

					$conditions[] = array('Pedido.acabado_id' => 0);

				} else {

					$conditions[] = array('Acabado.acabado LIKE' => $this->data['Almacencliente']['acabado_id']);

				}

			}

			if (!empty($this->data['Almacencliente']['articulo_id'])) {

				if (empty($this->data['Almacencliente']['tipo'])) {

					$cond1 = $conditions;

					$cond1[] = array('Almacencliente.tipo' => 'entrada');

					$entradas = $this->Almacencliente->find('all',array(

						'conditions' => $cond1,

						'fields' => 'SUM(Almacencliente.cajas)'

					));

					$cond2 = $conditions;

					$cond2[] = array('Almacencliente.tipo' => 'salida');

					$salidas = $this->Almacencliente->find('all',array(

						'conditions' => $cond2,

						'fields' => 'SUM(Almacencliente.cajas)'

					));

					$saldo = $entradas[0][0]['SUM(`Almacencliente`.`cajas`)'] - $salidas[0][0]['SUM(`Almacencliente`.`cajas`)'];

					$this->set(compact('saldo'));

				} else {

					$saldo = $this->Inventarioalmacen->find('all',array(

						'conditions' => $conditions,

						'fields' => 'SUM(Almacencliente.cajas)'

					));

					$saldo = $saldo[0][0]['SUM(`Almacencliente`.`cajas`)'];

					$this->set(compact('saldo'));

				}

			}

		} 

		$inventarios = $this->Almacencliente->find('all',array(

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

}



?>