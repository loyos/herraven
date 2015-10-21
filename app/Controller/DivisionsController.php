<?php
App::uses('CakeEmail', 'Network/Email');
class DivisionsController extends AppController {
    
	public $helpers = array ('Html','Form');
	public $components = array('Session','JqImgcrop','RequestHandler');
	var $uses = array('User','Miembro','Config','Unidad','Departamento','Division');
	
	 public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('editar','login','logout','reset_password'); // Letting users register themselves
	}
	
    function admin_index() {
		$divisiones = $this->Division->find('all',array(
			'recursive' => 3,
			'conditions' => array('Division.id <>' => 1 ),
			'order' => array('Division.numero')
		));
		$this->set(compact('divisiones'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			$validando_departamentos = true;
			if (!empty($this->data['departamento1'])) {
				if (($this->data['departamento1'] == $this->data['departamento2']) || ($this->data['departamento1'] == $this->data['departamento3'])){
					$validando_departamentos = false;
				}
			} 
			if (!empty($this->data['departamento2'])) {
				if (($this->data['departamento1'] == $this->data['departamento2']) || ($this->data['departamento2'] == $this->data['departamento3'])){
					$validando_departamentos = false;
				}
			} 
			if (!empty($this->data['departamento3'])) {
				if (($this->data['departamento1'] == $this->data['departamento3']) || ($this->data['departamento2'] == $this->data['departamento3'])){
					$validando_departamentos = false;
				}
			} 
			if ($validando_departamentos) {
				if ($this->Division->save($data,array('validate'=>'first'))) {
				
					//Ubico en que division se van a colocar los departamentos
					$data['Departamento']['division_id'] =  $this->Division->id;
					
					//Eliminar las unidades que estaban asociadas
					$departamentos_division = $this->Departamento->find('all',array(
						'conditions' => array('Departamento.division_id' => $data['Departamento']['division_id'])
					)); 
					foreach ($departamentos_division as $m){
						$update = array('Departamento'=>array(
							'id' => $m['Departamento']['id'],
							'division_id' => 1
						));
						$this->Departamento->save($update);
					}
					
					if (!empty($this->data['departamento1'])) {
						$data['Departamento']['id'] = $data['departamento1'];
						$this->Departamento->save($data);
					}
					if (!empty($this->data['departamento2'])) {
						$data['Departamento']['id'] = $data['departamento2'];
						$this->Departamento->save($data);
					}
					if (!empty($this->data['departamento3'])) {
						$data['Departamento']['id'] = $data['departamento3'];
						$this->Departamento->save($data);
					}
					$this->Session->setFlash("Los datos se guardaron con éxito");
					$this->redirect(array('action' => 'admin_index'));
				} 
			} else {
					$this->Session->setFlash("Los departamentos no pueden ser iguales");
			}
		} 
		if (!empty($id)) {
			$this->data = $this->Division->findById($id);
			$titulo = 'Editar Division';
		} else {
			$titulo = 'Agrega una Division';
		}
		
		$users_busqueda = $this->User->find('all',array(
			'fields' => array('User.id','User.nombre ','User.apellido'),
			'conditions' => array('User.rol' => 'jefe_division')
		));
		$departamentos = $this->Departamento->find('list',array(
			'fields' => array('Departamento.id','Departamento.nombre'), 
			'conditions' => array(
				'Departamento.division_id' => array(1,$id),
				'Departamento.id <>' => 1
			)
		));
		$departamentos[0] = '';
		
		if (empty($users_busqueda)) {
			$users[0] = 'No existen jefes de división';
		}
		foreach ($users_busqueda as $u) {
			$users[$u['User']['id']] =  $u['User']['nombre'].' '.$u['User']['apellido'];
		}
		
		$departamentos_en_divisiones = $this->Departamento->find('all',array(
			'fields' => array('Departamento.id','Departamento.nombre '), 
			'conditions' => array('Departamento.division_id' => $id)
		));
		$departamento1 = 0;
		$departamento2 = 0;
		$departamento3 = 0;
		
		$i = 1;
		foreach($departamentos_en_divisiones as $mu) {
			if ($i==1){
				$departamento1 = $mu['Departamento']['id'];
			} elseif ($i==2){
				$departamento2 = $mu['Departamento']['id'];
			} elseif ($i==3){
				$departamento3 = $mu['Departamento']['id'];
			} 
			$i++;
		}
		$this->set(compact('id','titulo','users','departamentos','departamento1','departamento2','departamento3'));
	}
	
	function admin_eliminar($id) {
		$this->Division->delete($id);
		//Busca todos los departamentos que estaban relacionados
		$depatamentos = $this->Departamento->find('all',array(
			'conditions' => array(
				'Departamento.division_id' => $id
			)
		));
		foreach ($departamentos as $p){
			$update = array(
				'Departamento' => array(
					'id' => $p['Departamento']['id'],
					'division_id' => 1
				)
			);
			$this->Departamento->save($update);
		}
		$this->Session->setFlash("La división se elimino con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$division = $this->Division->find('first',array(
			'conditions' => array(
				'Division.id' => $id
			),
			'contain' => array('Departamento'),
			'recursive' => 2
		));
		//busco el numero de unidades y miembros dentro de la division;
		$sum_unidades = 0;
		foreach($division['Departamento'] as $d) {
			$sum_unidades = $sum_unidades + count($d['Unidad']);
		}
		$unidades[] = '';
		foreach($division['Departamento'] as $d) {
			foreach($d['Unidad'] as $u) {
				$unidades[] = $u['id'];
			}
		}
		$miembros = $this->Miembro->find('all',array(
			'conditions' => array(
				'Miembro.unidad_id' => $unidades 
			)
		));
		$personal = count($miembros);
		
		//Busco los departamentos unidades y miembros para listarlos luego
		$departamentos = $this->Departamento->find('all',array(
			'conditions' => array(
				'Departamento.division_id' => $id
			),
			'recursive' => 3,
			'contain' => array('Unidad')
		));
		
		$this->set(compact('sum_unidades','personal','division','departamentos','id'));
	}
}

?>