<?php
class Articulo extends AppModel {
    var $name = 'Articulo';
	public $actsAs = array('Search.Searchable');
	
	public $belongsTo = array(
        'Subcategoria' => array(
            'className'    => 'Subcategoria',
            'foreignKey'   => 'subcategoria_id'
        ),
    );
	
	public $hasMany = array(
		'Inventarioalmacen' => array(
			'className'  => 'Inventarioalmacen',
			'foreignKey'    => 'articulo_id',
		),
		'Pedido' => array(
			'className'  => 'Pedido',
			'foreignKey'    => 'articulo_id',
		)
    );
	
	var $hasAndBelongsToMany = array(
        'Materiasprima' =>
            array('className'            => 'Materiasprima',
                 'joinTable'              => 'articulos_materiasprimas',
                 'foreignKey'             => 'articulo_id',
                 'associationForeignKey'  => 'materiasprima_id',
            ),
		 'Cliente' =>
            array('className'            => 'Cliente',
                 'joinTable'              => 'articulos_clientes',
                 'foreignKey'             => 'articulo_id',
                 'associationForeignKey'  => 'cliente_id',
            )
    );
	

	var $validate = array( 
		'cantidad_por_caja' => array(
			'not_empty' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			), 
			'mayor_a_cero' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'El número de cajas debe ser mayor a 0'
			)
		),
		'descripcion' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'subcategoria_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'imagen' => array(
			'rule' => 'notEmpty',
			'message' => 'Este campo no puede quedar vacío.'
		),
		'codigo' => array(
			'not_empty_cod' => array(
				'rule' => 'notEmpty',
				'message' => 'Este campo no puede quedar vacío.'
			),
			'unico' => array(
				'rule' => 'isUnique',
				'message' => 'El código debe ser único'
			)
		),
		
    );
	
	// aqui se configura el filtro
	
	public $filterArgs = array(
		// 'descripcion' => array('type' => 'subquery', 'method' => 'forecast')
		'descripcio' => array('type' => 'like', 'field' => 'Subcategoria.descripcion'),
		// 'descripcion' => array('type' => 'subquery', 'method' => 'forecast', 'field' => 'descripcion'),
		// 'wachu' => array('type' => 'like', 'field' => 'Categoria.descripcion'),
	);
	
	public function forecast($data = array()){
	
		debug($data);
		$tag = $data['descripcion'];
		$query = $this->getQuery('all', array(
            'conditions' => array('Articulo.descripcion LIKE'  => '%'. $tag .'%' ),
			'contain' => array('Subcategoria')
        ));
		
		//die();
		debug($query);
        return $query;
	}
	
	public function forecast2($data = array()){
		debug($data);
		
		$query_sub = $this->find('all', array(
            'conditions' => array('Subcategoria.descripcion LIKE'  => '%'. $data['descripcion_sub'] .'%' ),
        ));
		die();
		debug($query_sub);
        return $query_sub;
	}
	
	function calcular_precio($id, $ganancia = null){
	
		$precio_materias = 0;
		$costo_produccion = 0;
		$costo_total = 0;
		$margen_ganancia = 0;
		$precio_total = 0;
		
		$articulo = $this->find('first', array(
			'conditions' => array(
				'Articulo.id' => $id
			)
		));
		
		if(empty($ganancia)){
			foreach($articulo['Materiasprima'] as $art){
				$precio_materias = $precio_materias + $art['precio']*$art['ArticulosMateriasprima']['cantidad'];
			}
		}else{
			foreach($articulo['Materiasprima'] as $art){
				$precio_materias = $precio_materias + ($art['precio']+$art['precio']*($ganancia/100))*$art['ArticulosMateriasprima']['cantidad'];
			}
		}
		$costo_produccion = $precio_materias * ($articulo['Articulo']['costo_produccion']/100);
		$costo_total = $precio_materias + $costo_produccion;
		$margen_ganancia = $costo_total * ($articulo['Articulo']['margen_ganancia']/100);
		$precio_total = $costo_total + $margen_ganancia;
		
		// debug($precio_total);
		// die();
		
		return(round($precio_total));
		
	}	
	
	function calcular_costo_materiaprima($id,$ganancia=null) {
		$precio_materias = 0;
		
		$articulo = $this->find('first', array(
			'conditions' => array(
				'Articulo.id' => $id
			)
		));
		if (empty($ganancia)) {
			foreach($articulo['Materiasprima'] as $art){
				$precio_materias = $precio_materias + $art['precio']*$art['ArticulosMateriasprima']['cantidad'];
			}	
		} else {
			foreach($articulo['Materiasprima'] as $art){
				$precio_materias = $precio_materias + ($art['precio']+$art['precio']*($ganancia/100))*$art['ArticulosMateriasprima']['cantidad'];
			}
		}
		return(round($precio_materias));
	}
	
	function calcular_costo_acabado($id,$acabado_id,$ganancia = null) {
		$this->AcabadosMateriasprima = ClassRegistry::init('AcabadosMateriasprima');
		$this->Materiasprima = ClassRegistry::init('Materiasprima');
		$precio_materias = 0;	
		$materias_acabado = $this->AcabadosMateriasprima->find('all',array(
			'conditions' => array(
				'AcabadosMateriasprima.acabado_id' => $acabado_id,
				'AcabadosMateriasprima.articulo_id' => $id,
			)
		));
		if (empty($ganancia)) {
			foreach($materias_acabado as $m){
				$materia = $this->Materiasprima->findById($m['AcabadosMateriasprima']['materiasprima_id']);
				$precio_materias = $precio_materias + $materia['Materiasprima']['precio']*$m['AcabadosMateriasprima']['cantidad'];
			}
		} else {
			foreach($materias_acabado as $m){
				$materia = $this->Materiasprima->findById($m['AcabadosMateriasprima']['materiasprima_id']);
				$precio_materias = $precio_materias + ($materia['Materiasprima']['precio']+$materia['Materiasprima']['precio']*($ganancia/100))*$m['AcabadosMateriasprima']['cantidad'];
			}
		}
		return($precio_materias);
	}
	
	function calcular_costo_total($id, $acabado_id,$ganancia=null) {
	
		$acum_precio_materias = $this->calcular_costo_materiaprima($id,$ganancia); // llamamos a la funcion del modelo para calcular el precio de materias primas basicas
		$acum_precio_acabados = $this->calcular_costo_acabado($id,$acabado_id,$ganancia);
		$acum_precio = $acum_precio_materias + $acum_precio_acabados;
		$articulo_b = $this->findById($id);
		$acum_precio_costo_produccion = ($acum_precio*($articulo_b['Articulo']['costo_produccion']/100))+$acum_precio;
		$precio = ($acum_precio_costo_produccion*($articulo_b['Articulo']['margen_ganancia']/100))+$acum_precio_costo_produccion;
		return($precio);
	}
}

?>