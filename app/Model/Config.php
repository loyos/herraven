<?php
class Config extends AppModel {
    var $name = 'Config';
	
	function obtenerTrimestre($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$mes = explode("-",$fecha);
		$mes = $mes[1];
		if ($mes >= 1 && $mes<=3) {
			$trimestre = 1;
		} elseif ($mes >= 4 && $mes<=6) {
			$trimestre = 2;
		} elseif ($mes >= 7 && $mes<=9) {
			$trimestre = 3;
		} elseif ($mes >= 10 && $mes<=12) {
			$trimestre = 4;
		}
		
		return $trimestre;
	}
	
	function obtenerAno($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$ano = explode("-",$fecha);
		$ano = $ano[0];
		return($ano);
	}
	
	function obtenerMes($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$mes = explode("-",$fecha);
		$mes = $mes[1];
		return($mes);
	}
	
	function obtenerDia($fecha){
		$separar_fecha = explode(" ",$fecha);
		$fecha = $separar_fecha[0];
		$dia = explode("-",$fecha);
		$dia = $dia[2];
		return($dia);
	}
	
	function obtenerSemana($fecha){
		$fecha = strtotime($fecha);
		$dia_semana = date( "N", $fecha);  // numero de dia en la semana
		$n_semana = date( "W", $fecha);  // numero de la semana
		if($dia_semana == '1' || $dia_semana == '2' || $dia_semana == '3'){
			$n_semana = $n_semana - 1; 
		}
		return $n_semana;
		
		//Esto comentado es para obtener la semana del mes
		// $separar_fecha = explode(" ",$fecha);
		// $fecha = $separar_fecha[0];
		// $dia = explode("-",$fecha);
		// $dia = $dia[2];
		// if ($dia >= 1 && $dia<=7) {
			// $semana = 1;
		// } elseif ($dia >= 8 && $dia<=15) {
			// $semana = 2;
		// } elseif ($dia >= 16 && $dia<=22) {
			// $semana = 3;
		// } elseif ($dia >= 23 && $dia<=31) {
			// $semana = 4;
		// }
		
		//return $semana;
	}
	
	function Semana($year = null, $numero = null) {
		//el parametro es el numero de la semana
		if (!empty($year) && !empty($numero)) {
			$start_date = date_create();
			$end_date = date_create();

			date_isodate_set($start_date, $year, $numero);
			$fecha['start'] = date_format($start_date, 'Y-m-d');

			date_isodate_set($end_date, $year, $numero, 7);
			$fecha['end'] = date_format($end_date, 'Y-m-d');
		} else {
			//Si los parametros estan vacios es porque estoy pidiendo el numero de semana actual
			$fecha['week'] = date('W');
		}
		return $fecha;
	} 
	
	function ObtenerNombreMes($mes) {
		if ($mes == 1) {
			return 'Enero';
		} elseif ($mes == 2) {
			return 'Febrero';
		} elseif ($mes == 3) {
			return 'Marzo';
		} elseif ($mes == 4) {
			return 'Abril';
		} elseif ($mes == 5) {
			return 'Mayo';
		} elseif ($mes == 6) {
			return 'Junio';
		} elseif ($mes == 7) {
			return 'Julio';
		} elseif ($mes == 8) {
			return 'Agosto';
		} elseif ($mes == 9) {
			return 'Septiembre';
		} elseif ($mes == 10) {
			return 'Octubre';
		} elseif ($mes == 11) {
			return 'Noviembre';
		} elseif ($mes == 12) {
			return 'Diciembre';
		}
	}
	
	public function numero_semana_jueves($fecha = null){  // funcion que calcula semana del ano
													// la semana empieza los jueves, termina los miercoles.		
		$fecha = strtotime($fecha);
		$dia_semana = date( "N", $fecha);  // numero de dia en la semana
		$n_semana = date( "W", $fecha);  // numero de la semana
		if($dia_semana == '1' || $dia_semana == '2' || $dia_semana == '3'){
			$n_semana = $n_semana - 1; 
		}
		return $n_semana;
	}
	
	function Semana_jueves($year = null, $numero = null) { //funcion que me dice cuando empieza y termina una semana de jueves a jueves
		//el parametro es el numero de la semana
		if (!empty($year) && !empty($numero)) {
			$start_date = date_create();
			$end_date = date_create();
			date_isodate_set($start_date, $year, $numero);
			$fecha['start'] = date_format($start_date, 'Y-m-d');
			$fecha['start'] = strtotime ('+3 day' ,strtotime ($fecha['start']));
			$fecha['start'] = date('Y-m-d',$fecha['start']);
			date_isodate_set($end_date, $year, $numero, 7);
			$fecha['end'] = date_format($end_date, 'Y-m-d');
			$fecha['end'] = strtotime ('+3 day' ,strtotime ($fecha['end']));
			$fecha['end'] = date( 'Y-m-d',$fecha['end'] );
		}
		return $fecha;
	} 
	
	function ObtenerNombreDia($fecha) { //Devuelve el dia, lunes , martes, miercoles, etc
		$fecha = strtotime($fecha);
		$dia_semana = date("N", $fecha);  // numero de dia en la semana
		if ($dia_semana == 1) {
			return 'Lunes';
		} elseif ($dia_semana == 2) {
			return 'Martes';
		} elseif ($dia_semana == 3) {
			return 'Miercoles';
		} elseif ($dia_semana == 4) {
			return 'Jueves';
		} elseif ($dia_semana == 5) {
			return 'Viernes';
		} elseif ($dia_semana == 6) {
			return 'Sabado';
		} elseif ($dia_semana == 7) {
			return 'Domingo';
		}
	}
	
	function obtenerIntervaloFechas($fecha_menor,$fecha_mayor = null) {
		
		if (empty($fecha_mayor)) {

			$hoy = "now";

		} else {

			$hoy = $fecha_mayor;

		}		
		  $diferencia = strtotime($hoy) - strtotime($fecha_menor);

		if($diferencia<60){
			$tiempo = floor($diferencia)." segundos";
		}elseif($diferencia>60 && $diferencia<3600){
			if (floor($diferencia/60) == 1) {
				$tiempo = floor($diferencia/60)." minutos'";
			} else {
				$tiempo = floor($diferencia/60)." minuto'";
			}
		}elseif($diferencia>3600 && $diferencia<86400){
			if (floor($diferencia/3600) == 1) {
				$tiempo = floor($diferencia/3600)." hora";
			} else {
				$tiempo = floor($diferencia/3600)." horas";
			}
		}elseif($diferencia>86400 && $diferencia<2592000){
			if (floor($diferencia/86400)) {
				$tiempo = floor($diferencia/86400)." día";
			} else {
				$tiempo = floor($diferencia/86400)." días";
			}
		}elseif($diferencia>2592000 && $diferencia<31104000){
			if (floor($diferencia/2592000) == 1) {
				$tiempo = floor($diferencia/2592000)." mes";
			} else {
				$tiempo = floor($diferencia/2592000)." meses";
			}
		}elseif($diferencia>31104000){
			if (floor($diferencia/31104000) == 1) {
				$tiempo = floor($diferencia/31104000)." año";
			} else {
				$tiempo = floor($diferencia/31104000)." años";
			}
		}else{
			$tiempo = "Error";
		}
		//debug($tiempo);
		return($tiempo);
		
	}
	
}
?>