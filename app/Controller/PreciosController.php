<?php

class PreciosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	public $uses = array('Precio','Materiasprima','MateriasprimasPrecio','Articulo','Categoria','Subcategoria','AcabadosMateriasprima','Acabado');
	
    function admin_index() {
		$precios = $this->Precio->find('all');
		$this->set(compact('precios'));
    }
	
	function admin_editar($id = null) {
		$titulo = "";
		if (!empty($this->data)) {
			if ($this->Precio->save($this->data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} elseif (!empty($id)) {
			$this->data = $this->Precio->findById($id);
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$this->set(compact('id','titulo'));
	}
	
	function admin_eliminar($id) {
		$this->Precio->delete($id);
		$this->Session->setFlash("la lista de precio se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_listar_subcategorias($id){
		$categorias = $this->Categoria->find('all',array(
			'contain' => array('Subcategoria')
		));
		$this->set(compact('categorias','id'));
	}
	
	function admin_ver($id,$cat, $id_acabado=10000, $subcat=null) {
		$precio = $this->Precio->findById($id);
		$acabados = $this->Acabado->find('list',array(
			'fields' => array('id','acabado')
		));
		$acabados[100000]= 'Sin acabado';
		if (!empty($this->data['Precio']['acabado_id']) || $id_acabado != 10000) {
			if (!empty($this->data['Precio']['acabado_id'])) {
				$acabado_seleccionado = $this->data['Precio']['acabado_id'];
			} else {
				$acabado_seleccionado = $id_acabado;
			}
			$materias = $this->Materiasprima->find('all');
			$acabado = $this->Acabado->findById($acabado_seleccionado);
			$ganancia = $precio['Precio']['ganancia'];
			if (empty($subcat)){
				$subcategorias = $this->Subcategoria->find('all',array(
					'conditions' => array('Subcategoria.categoria_id' => $cat)
				));
				foreach ($subcategorias as $s) {
					$subcats[] = $s['Subcategoria']['id'];
				}
			} else {
				$subcats = $subcat;
			}
			$articulos = $this->Articulo->find('all',array(
				'conditions' => array('Articulo.subcategoria_id' => $subcats)
			));
			if ($id == 1) {
				foreach ($articulos as $a) {
					if ($acabado_seleccionado == 'Nada') {
						$acum_precio = $this->Articulo->calcular_precio($a['Articulo']['id']);
						$precio_articulo[] = array (
							'articulo' => $a['Articulo']['descripcion'],
							'precio' => $acum_precio,
							'codigo' => $a['Articulo']['codigo'],
							'cantidad' => $a['Articulo']['cantidad_por_caja']
						);
					} else {
						$existe_acabado =  $this->AcabadosMateriasprima->find('all',array(
							'conditions' => array(
								'AcabadosMateriasprima.acabado_id' => $acabado_seleccionado,
								'AcabadosMateriasprima.articulo_id' => $a['Articulo']['id']
							)
						));
						if (!empty($existe_acabado)){
							$acum_precio = $this->Articulo->calcular_costo_total($a['Articulo']['id'],$acabado_seleccionado);
							$precio_articulo[] = array (
								'articulo' => $a['Articulo']['descripcion'],
								'precio' => $acum_precio,
								'codigo' => $a['Articulo']['codigo'],
								'cantidad' => $a['Articulo']['cantidad_por_caja']
							);
						}
					}
				};
			
			} else {
				$ganancia = $precio['Precio']['ganancia']/100;
				
				$ganancia = $precio['Precio']['ganancia'];
				foreach ($articulos as $a) {
					if ($acabado_seleccionado == 10000 || $acabado_seleccionado == 100000) {
						$acum_precio = $this->Articulo->calcular_precio($a['Articulo']['id'],$ganancia);
						$precio_articulo[] = array (
							'articulo' => $a['Articulo']['descripcion'],
							'precio' => $acum_precio,
							'codigo' => $a['Articulo']['codigo'],
							'cantidad' => $a['Articulo']['cantidad_por_caja']
						);
					} else {
						$existe_acabado =  $this->AcabadosMateriasprima->find('all',array(
							'conditions' => array(
								'AcabadosMateriasprima.acabado_id' => $acabado_seleccionado,
								'AcabadosMateriasprima.articulo_id' => $a['Articulo']['id']
							)
						));
						if (!empty($existe_acabado)){
							$acum_precio = $this->Articulo->calcular_costo_total($a['Articulo']['id'], $acabado_seleccionado,$ganancia);
							$precio_articulo[] = array (
								'articulo' => $a['Articulo']['descripcion'],
								'codigo' => $a['Articulo']['codigo'],
								'precio' => $acum_precio,
								'cantidad' => $a['Articulo']['cantidad_por_caja']
							);
						}
					}
				};
			}
			
			$this->set(compact('precio','precio_materia','precio_articulo','acabado_seleccionado','acabado'));
		}
		$this->set(compact('precio','acabados','id','cat','subcat'));
	}
	
}

?>