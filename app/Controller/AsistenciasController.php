<?php



class AsistenciasController extends AppController {

    

	public $helpers = array ('Html','Form','Herra');

	public $components = array('Session','JqImgcrop','Search.Prg','RequestHandler');

	public $uses = array('Asistencia','Miembro','Config','Dia');

    public $presetVars = true; // using the model configuration

	public $paginate = array();



	function admin_index(){

		$config = $this->Config->find('first');

		$fecha =  new DateTime($config['Config']['dia_asistencia']);

		$fecha = $fecha->format('d-m-Y');

		$dia = $this->Config->ObtenerNombreDia($config['Config']['dia_asistencia']);

		$ano = $config['Config']['ano_asistencia'];

		$numero_semana = $this->Config->numero_semana_jueves($config['Config']['dia_asistencia']);

		$semana = $this->Config->Semana_jueves($config['Config']['ano_asistencia'],$config['Config']['semana_asistencia']);

		$mes_semana_start = $this->Config->ObtenerMes($semana['start']);

		$mes_semana_end = $this->Config->ObtenerMes($semana['end']);

		$dia_start = $this->Config->ObtenerDia($semana['start']);

		$dia_end = $this->Config->ObtenerDia($semana['end']);

		if ($mes_semana_start == $mes_semana_end) {

			$fecha_semana = 'del '.$dia_start.' al '.$dia_end.'/'.$mes_semana_end;

		} else {

			$fecha_semana = 'del '.$dia_start.'/'.$mes_semana_start.' al '.$dia_end.'/'.$mes_semana_end;

		}

		//Buscar miembros sin los retirados

		$miembros = $this->Miembro->findMembers();	

		//Verifico si el dia ya esta en la tabla dias

		$existe_dia = $this->Dia->find('first',array(

			'conditions' => array(

				'Dia.fecha' => $config['Config']['dia_asistencia'],

				'Dia.ano' => $ano

			)

		));

		if (!empty($existe_dia)) {

			$dia_id = $existe_dia['Dia']['id'];

		} else {

			$nuevo_dia = array('Dia' => array(

				'fecha' => $config['Config']['dia_asistencia'],

				'semana' => $numero_semana,

				'ano' => $ano,

			));

			$this->Dia->save($nuevo_dia);

			$dia_id = $this->Dia->id;

		}

		if (!empty($this->data)) {

			$data = $this->data;

			$nuevo_dia = array('Dia' => array(

				'id' => $dia_id,

				'laborable' => $data['Dia']['laborable']

			));

			$this->Dia->save($nuevo_dia);

			foreach($data['asistencia'] as $k=>$a) {

				//Verifico si ya esta persona esta en la bd, si esta solo actualizo

				$existe_miembro = $this->Asistencia->find('first',array(

					'conditions' => array(

						'Asistencia.dia_id' => $dia_id,

						'Asistencia.miembro_id' => $k

					)

				));

				if (!empty($existe_miembro)) {

					$nueva_asistencia = array('Asistencia' => array(

						'id' => $existe_miembro['Asistencia']['id'],

						'asistio' => $a,

						'observacion' => $data['observacion'][$k]

					));

					$this->Asistencia->save($nueva_asistencia);

				} else {

					$nueva_asistencia = array('Asistencia' => array(

						'asistio' => $a,

						'miembro_id' => $k,

						'dia_id' => $dia_id,

						'observacion' => $data['observacion'][$k]

					));

					$this->Asistencia->create();

					$this->Asistencia->save($nueva_asistencia);

				}



			}

			if ($data['Asistencia']['cerro_dia'] == 1) {

				//Se repite el proceso

				$nueva_fecha = strtotime ('+1 day' ,strtotime ($config['Config']['dia_asistencia']));

				$nueva_fecha = date('Y-m-d',$nueva_fecha);

				$nuevo_ano = $this->Config->ObtenerAno($nueva_fecha);

				$nueva_semana = $this->Config->numero_semana_jueves($config['Config']['dia_asistencia']);

				

				$update_config = array('Config' => array(

					'id' => 1,

					'dia_asistencia' => $nueva_fecha,

					'ano_asistencia' => $nuevo_ano,

					'semana_asistencia' => $nueva_semana,

				));

				$this->Config->save($update_config);

				

				$config = $this->Config->find('first');

				$fecha =  new DateTime($config['Config']['dia_asistencia']);

				$fecha = $fecha->format('d-m-Y');

				$dia = $this->Config->ObtenerNombreDia($config['Config']['dia_asistencia']);

				$ano = $config['Config']['ano_asistencia'];

				$numero_semana = $this->Config->numero_semana_jueves($config['Config']['dia_asistencia']);

				$semana = $this->Config->Semana_jueves($config['Config']['ano_asistencia'],$config['Config']['semana_asistencia']);

				$mes_semana_start = $this->Config->ObtenerMes($semana['start']);

				$mes_semana_end = $this->Config->ObtenerMes($semana['end']);

				$dia_start = $this->Config->ObtenerDia($semana['start']);

				$dia_end = $this->Config->ObtenerDia($semana['end']);

				if ($mes_semana_start == $mes_semana_end) {

					$fecha_semana = 'del '.$dia_start.' al '.$dia_end.'/'.$mes_semana_end;

				} else {

					$fecha_semana = 'del '.$dia_start.'/'.$mes_semana_start.' al '.$dia_end.'/'.$mes_semana_end;

				}

	

				//Verifico si el dia ya esta en la tabla dias

				$existe_dia = $this->Dia->find('first',array(

					'conditions' => array(

						'Dia.fecha' => $config['Config']['dia_asistencia'],

						'Dia.ano' => $ano

					)

				));

				if (!empty($existe_dia)) {

					$dia_id = $existe_dia['Dia']['id'];

				} else {

					$nuevo_dia = array('Dia' => array(

						'fecha' => $config['Config']['dia_asistencia'],

						'semana' => $numero_semana,

						'ano' => $ano,

					));

					$this->Dia->create();

					$this->Dia->save($nuevo_dia);

					$dia_id = $this->Dia->id;

				}

			} else {

				$this->Session->setFlash('Los datos se guardaron con éxito');

			}

		} 

		//Mando los datos ya guardados en la bd

		$buscar_asistencias = $this->Asistencia->find('all',array(

			'conditions' => array(

				'Asistencia.dia_id' => $dia_id,

			)

		));

		foreach ($buscar_asistencias as $a) {

			$asistencias[$a['Asistencia']['miembro_id']] = $a['Asistencia']['asistio'];

			$observaciones[$a['Asistencia']['miembro_id']] = $a['Asistencia']['observacion'];

		}

		$dia_nuevo = $this->Dia->findById($dia_id);

		if ($dia_nuevo['Dia']['laborable'] == 1) {

			$es_laborable = true;

		} else {

			$es_laborable = false;

		}

		

		$this->set(compact('fecha','dia','fecha_semana','ano','miembros','asistencias','observaciones','es_laborable'));

	}



	function admin_nomina(){	

		if (!empty($this->data)) {

			//Si coloco datos en el buscador, lo hice asi y no con el plugin porque no es solo una busqueda y lista resultados, hay que trabajar el arreglo resultante, y me parecia mas engorroso con el plugin

			if (!empty($this->data['Dia']['ano1'])) {

				$ano = $this->data['Dia']['ano1'];

			}

			if (!empty($this->data['Dia']['numero'])) {

				$numero = $this->data['Dia']['numero'];

			}

		}

		$conditions = array();

		if (empty($ano)) {

			$hoy = date('Y-m-d H:i:s');

			$ano = $this->Config->ObtenerAno($hoy);

		}

		$conditions['Dia.ano'] =  $ano;

		if (!empty($numero)) {

			$conditions['Dia.semana'] = $numero;

		}

		$semanas_busqueda = $this->Dia->find('all',array(

			'fields' => array('DISTINCT(Dia.semana)'),

			'recursive' => 0,

			'conditions' => $conditions,

			'order' => array('Dia.semana')

		));

		$lista = array();

		foreach ($semanas_busqueda as $s) {

			$semana = $this->Config->Semana_jueves($ano,$s['Dia']['semana']);

			$mes_semana_start = $this->Config->ObtenerMes($semana['start']);

			$mes_semana_end = $this->Config->ObtenerMes($semana['end']);

			$dia_start = $this->Config->ObtenerDia($semana['start']);

			$dia_end = $this->Config->ObtenerDia($semana['end']);

			if ($mes_semana_start == $mes_semana_end) {

				$fecha_semana = 'del '.$dia_start.' al '.$dia_end.'/'.$mes_semana_end;

			} else {

				$fecha_semana = 'del '.$dia_start.'/'.$mes_semana_start.' al '.$dia_end.'/'.$mes_semana_end;

			}

			$semanas[$s['Dia']['semana']] = $fecha_semana; 

				

		}

		$this->set(compact('semanas','ano'));

	}

	

	function admin_ver_reporte($semana,$ano) {

		//Busco los dias de esa semana

		$dias = $this->Dia->find('all',array(

			'conditions' => array(

				'Dia.semana' => $semana,

				'Dia.ano' => $ano

			)

		));

		$id_dias = Set::combine($dias, '{n}.Dia.id','{n}.Dia.id');

	

		//Busco los miembros 

		$miembros = $this->Miembro->find('all');

		foreach ($miembros as $m) {

			$asistencias[$m['Miembro']['id']]['asistencia'] = $this->Asistencia->find('all',array(

				'conditions' => array(

					'Asistencia.dia_id' => $id_dias,

					'Asistencia.miembro_id' => $m['Miembro']['id']

				),

				'recursive' => 0,

				'order' => array('Dia.fecha')

			));

			$nombre = "";

			if (!empty($m['User']['nombre'])) {

				$nombre = $m['User']['nombre'];

			} 

			if (!empty($m['User']['apellido'])) {

				$nombre = $nombre.' '.$m['User']['apellido'];

			} 

			$asistencias[$m['Miembro']['id']]['nombre'] = $nombre;

			$asistencias[$m['Miembro']['id']]['puesto'] = $m['Miembro']['puesto'];

		}

		$semana = $this->Config->Semana_jueves($ano,$semana);

		$mes_semana_start = $this->Config->ObtenerMes($semana['start']);

		$mes_semana_end = $this->Config->ObtenerMes($semana['end']);

		$dia_start = $this->Config->ObtenerDia($semana['start']);

		$dia_end = $this->Config->ObtenerDia($semana['end']);

		if ($mes_semana_start == $mes_semana_end) {

			$fecha_semana = 'del '.$dia_start.' al '.$dia_end.'/'.$mes_semana_end;

		} else {

			$fecha_semana = 'del '.$dia_start.'/'.$mes_semana_start.' al '.$dia_end.'/'.$mes_semana_end;

		}

		$this->set(compact('ano','asistencias','fecha_semana'));

	}

}



?>