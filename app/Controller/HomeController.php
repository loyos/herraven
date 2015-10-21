<?php

class HomeController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('RequestHandler');
	var $uses = array('Contenido','Imagen','Config');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'contenido', 'contacto'); // Letting users register themselves
	}
	
    function index() {
		// $debug($this->layout = 'hola');
		$this->layout = 'home';
		$menu = $this->Contenido->find('all');
		$imagenes = $this->Imagen->find('all', array('conditions' => array(
			'contenido_id' => '0')
		));
		$config = $this->Config->find('first');
		$this->set(compact('menu','imagenes','config'));
    }
	
	function contenido($id = null){
		$this->layout = 'home';
		$contenido = $this->Contenido->find('first', array('conditions' => array(
			'id' => $id
		))); // esto podria colocarse en app controller, pero como son solo dos acciones
		$menu = $this->Contenido->find('all');
		$imagenes = $this->Imagen->find('all', array(
			'conditions' => array(
				'contenido_id' => $id
			)
		));
		$config = $this->Config->find('first');
		// debug($imagenes);
		
		$this->set(compact('menu','contenido','imagenes'));
		
	}
	
	function contacto(){
		$this->layout = 'home';
		$menu = $this->Contenido->find('all'); // esto podria colocarse en app controller, pero como son solo dos acciones
		$this->set(compact('menu')); // me dio flojera jejeje
	}
}

?>