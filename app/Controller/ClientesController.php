<?php

class ClientesController extends AppController {
    
	public $helpers = array ('Html','Form');
	var $uses = array('Cliente','Precio');
	
    function admin_index() {
		$clientes = $this->Cliente->find('all');
		$this->set(compact('clientes'));
    }
	
	function admin_editar($id = null) {
		if (!empty($this->data)) {
			$data = $this->data;
			$data['Cliente']['telefono_uno'] = $data['Cliente']['codigo_uno'].'-'.$data['Cliente']['telefono_uno'];
			if (!empty($data['Cliente']['telefono_dos'])) {
				$data['Cliente']['telefono_dos'] = $data['Cliente']['codigo_dos'].'-'.$data['Cliente']['telefono_dos'];
			}
			if (!empty($data['Cliente']['fax'])) {
				$data['Cliente']['fax'] = $data['Cliente']['codigo_fax'].'-'.$data['Cliente']['fax'];
			}
			if ($this->Cliente->save($data)) {
				$this->Session->setFlash("Los datos se guardaron con éxito");
				$this->redirect(array('action' => 'admin_index'));
			}
		} elseif (!empty($id)) {
			$data = $this->Cliente->findById($id);
			$codigo_uno = explode('-',$data['Cliente']['telefono_uno']);
			$data['Cliente']['codigo_uno'] = $codigo_uno[0];
			$data['Cliente']['telefono_uno'] = $codigo_uno[1];
			if (!empty($data['Cliente']['telefono_dos'])) {
				$codigo_dos = explode('-',$data['Cliente']['telefono_dos']);
				$data['Cliente']['codigo_dos'] = $codigo_dos[0];
				$data['Cliente']['telefono_dos'] = $codigo_dos[1];
			}
			if (!empty($data['Cliente']['fax'])) {
				$fax = explode('-',$data['Cliente']['fax']);
				$data['Cliente']['codigo_fax'] = $fax[0];
				$data['Cliente']['fax'] = $fax[1];
			}
			$this->data = $data;
			$titulo = 'Editar';
		} else {
			$titulo = 'Agregar';
		}
		$precios = $this->Precio->find('list',array(
			'fields' => array('id','descripcion')
		));
		$this->set(compact('id','titulo','precios'));
	}
	
	function admin_eliminar($id) {
		$this->Cliente->delete($id);
		$this->Session->setFlash("El cliente se eliminó con éxito");
		$this->redirect(array('action' => 'admin_index'));
	}
	
	function admin_ver($id) {
		$cliente = $this->Cliente->findById($id);
		$this->set(compact('cliente'));
	}
}

?>