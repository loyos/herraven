<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppHelper', 'View/Helper');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class HerraHelper extends AppHelper {
	
	//Esta funcion agrega el string Bs, y los decimales a la cantidad que se le pase.
	public function format_number($cant,$bs = null){
		if (empty($bs)) {
			return('Bs '. number_format($cant, 2, ',', '.'));
		} else {
			return(number_format($cant, 2, ',', '.'));
		}
	}
	
	
	public function n_pedido($numero = 10, $ano = "2013-232-323"){
		$fecha = explode("-", $ano);
		$fecha = substr($fecha[0], -2);
		$n_pedido = $numero.$fecha;
		return($n_pedido); 
	}
	
	public function nombreDia($fecha) {
		$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
		$fecha = $dias[date('N', strtotime($fecha))];
		return($fecha);
	}
	
	public function stringcut($contenido, $length){

		$append="&hellip;";

		if(strlen($contenido) > $length) {
			$contenido = wordwrap($contenido, $length);
			$contenido = explode("\n",$contenido);
			$contenido = array_shift($contenido) . $append;
		}		
		return($contenido);
	}

}
