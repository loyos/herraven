<?php
App::uses('CakeEmail', 'Network/Email');
class DepartamentosController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop');
	var $uses = array('User','Miembro','Config','Unidad','Departamento');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$departamentos = $this->Departamento->find('all',array(
			'recursive' => 3,
			'conditions' => array('Departamento.id <>' => 1 ),
			'order' => array('Departamento.numero')
		));
		$this->set(compact('departamentos'));
    }
	
	function admin_editar($id = null) {	
		$titulo = 'Departamento';
		if (!empty($this->data)) {
			$data = $this->data;
			$validando_unidades = true;
			if (!empty($this->data['unidad1'])) {
				if (($this->data['unidad1'] == $this->data['unidad2']) || ($this->data['unidad1'] == $this->data['unidad3']) || ($this->data['unidad1'] == $this->data['unidad4']) || ($this->data['unidad1'] == $this->data['unidad5'])){
					$validando_unidades = false;
				}
			} 
			if (!empty($this->data['unidad2'])) {
				if (($this->data['unidad1'] == $this->data['unidad2']) || ($this->data['unidad2'] == $this->data['unidad3']) || ($this->data['unidad2'] == $this->data['unidad4']) || ($this->data['unidad2'] == $this->data['unidad5'])){
					$validando_unidades = false;
				}
			} 
			if (!empty($this->data['unidad3'])) {
				if (($this->data['unidad1'] == $this->data['unidad3']) || ($this->data['unidad2'] == $this->data['unidad3']) || ($this->data['unidad3'] == $this->data['unidad4']) || ($this->data['unidad3'] == $this->data['unidad5'])){
					$validando_unidades = false;
				}
			} 
			if (!empty($this->data['unidad4'])) {
				if (($this->data['unidad1'] == $this->data['unidad4']) || ($this->data['unidad4'] == $this->data['unidad3']) || ($this->data['unidad2'] == $this->data['unidad4']) || ($this->data['unidad4'] == $this->data['unidad5'])){
					$validando_unidades = false;
				}
			} 
			if (!empty($this->data['unidad5'])) {
				if (($this->data['unidad1'] == $this->data['unidad5']) || ($this->data['unidad5'] == $this->data['unidad3']) || ($this->data['unidad2'] == $this->data['unidad5']) || ($this->data['unidad5'] == $this->data['unidad4'])){
					$validando_unidades = false;
				}
			} 
			if ($validando_unidades) {
			if($this->Departamento->save($data,array('validate' => 'first'))) {
				
				//Ubico en que departamento se van a colocar las unidades
				$data['Unidad']['departamento_id'] =  $this->Departamento->id;
				
				//Eliminar las unidades que estaban asociadas
				$unidad_departamentos = $this->Unidad->find('all',array(
					'conditions' => array('Unidad.departamento_id' => $data['Unidad']['departamento_id'])
				)); 
				foreach ($unidad_departamentos as $m){
					$update = array('Unidad'=>array(
						'id' => $m['Unidad']['id'],
						'departamento_id' => 1
					));
					$this->Unidad->save($update);
				}
				
				if (!empty($this->data['unidad1'])) {
					$data['Unidad']['id'] = $data['unidad1'];
					$this->Unidad->save($data);
				}
				if (!empty($this->data['unidad2']) && ($this->data['unidad2'] != $this->data['unidad1'])) {
					$data['Unidad']['id'] = $data['unidad2'];
					$this->Unidad->save($data);
				}
				if (!empty($this->data['unidad3']) && ($this->data['unidad2'] != $this->data['unidad3']) && ($this->data['unidad3'] != $this->data['unidad1'])) {
					$data['Unidad']['id'] = $data['unidad3'];
					$this->Unidad->save($data);
				}
				if (!empty($this->data['unidad4']) && ($this->data['unidad4'] != $this->data['unidad1']) && ($this->data['unidad4'] != $this->data['unidad2']) && ($this->data['unidad4'] != $this->data['unidad3'])) {
					$data['Unidad']['id'] = $data['unidad4'];
					$this->Unidad->save($data);
				}
				if (!empty($this->data['unidad5']) && ($this->data['unidad5'] != $this->data['unidad1']) && ($this->data['unidad5'] != $this->data['unidad2']) && ($this->data['unidad5'] != $this->data['unidad3']) && ($this->data['unidad5'] != $this->data['unidad4'])) {
					$data['Unidad']['id'] = $data['unidad5'];
					$this->Unidad->save($data);
				}
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
				} 
			} else {
					if (!empty($id)) {
						$this->data = $this->Departamento->findById($id);
						$titulo = 'Editar departamento';
					}
					$this->Session->setFlash("Las unidades no pueden ser iguales");
			}
		} elseif (!empty($id)) {
			$this->data = $this->Departamento->findById($id);
			$titulo = 'Editar departamento';
		} else {
			$titulo = 'Agrega un departamento';
		}
		//Busco los jefes que ya estan asignados
		if (!empty($id)) {
			$jefe_actual = $this->Departamento->findById($id);
			$jefe_actual = $jefe_actual['Departamento']['user_id'];
		}
		$buscar_jefes_asignados = $this->Departamento->find('all',array(
			'fields' => array('Departamento.id','Departamento.user_id'),
			'conditions' => array('Departamento.user_id <>' => $jefe_actual)
		));
		$jefes_asignados[] = 0;
		foreach($buscar_jefes_asignados as $j) {
			$jefes_asignados[] = $j['Departamento']['user_id']; 
		}
		$users_busqueda = $this->User->find('all',array(
			'fields' => array('User.id','User.nombre ','User.apellido'),
			'conditions' => array(
				'User.rol' => 'jefe_departamento',
				'NOT' => array( 
				  'User.id' => $jefes_asignados
				)
			)
		));
		$unidads = $this->Unidad->find('list',array(
			'fields' => array('Unidad.id','Unidad.nombre'), 
			'conditions' => array(
				'Unidad.departamento_id' => array(1,$id),
				'Unidad.id <>' => 1
			)
		));
		$unidads[0] = '';
		// foreach ($miembros_busqueda as $u) {
			// $miembros[$u['Miembro']['id']] =  $u['User']['nombre'].' '.$u['User']['apellido'];
		// }
		if (empty($users_busqueda)) {
			$users[0] = 'No existen jefes de departamento disponibles';
		} else {
			$users[0] = 'Sin Jefe departamental';
		}
		foreach ($users_busqueda as $u) {
			$users[$u['User']['id']] =  $u['User']['nombre'].' '.$u['User']['apellido'];
		}
		
		//Buscando miembros asignados
		$unidades_en_departamento = $this->Unidad->find('all',array(
			'fields' => array('Unidad.id','Unidad.nombre '), 
			'conditions' => array('Unidad.departamento_id' => $id)
		));
		$unidad1 = 0;
		$unidad2 = 0;
		$unidad3 = 0;
		$unidad4 = 0;
		$unidad5 = 0;
		$i = 1;
		foreach($unidades_en_departamento as $mu) {
			if ($i==1){
				$unidad1 = $mu['Unidad']['id'];
			} elseif ($i==2){
				$unidad2 = $mu['Unidad']['id'];
			} elseif ($i==3){
				$unidad3 = $mu['Unidad']['id'];
			} elseif ($i==4){
				$unidad4 = $mu['Unidad']['id'];
			} elseif ($i==5){
				$unidad5 = $mu['Unidad']['id'];
			} 
			$i++;
		}
		$this->set(compact('id','titulo','users','unidads','unidad1','unidad2','unidad3','unidad4','unidad5'));
	}
	
	function admin_eliminar($id) {
		$this->Departamento->delete($id);
		//Busca todos las unidades que estaban relacionadas
		$unidades = $this->Unidad->find('all',array(
			'conditions' => array(
				'Unidad.departamento_id' => $id
			)
		));
		foreach ($unidades as $u){
			$update = array(
				'Unidad' => array(
					'id' => $u['Unidad']['id'],
					'departamento_id' => 1
				)
			);
			$this->Unidad->save($update);
		}
		$this->Session->setFlash("El departamento se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$departamento = $this->Departamento->find('first',array(
			'conditions' => array(
				'Departamento.id' => $id
			),
			'contain' => array('Unidad'),
			'recursive' => 2
		));
		$unidades = count($departamento['Unidad']);
		$personal = 0;
		foreach ($departamento['Unidad'] as $u) {
			$personal = $personal + count($u['Miembro']);
		}
		$this->set(compact('unidades','personal','departamento'));
	}
}

?>