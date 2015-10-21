<?php 
if (!empty($materiasprima)) {
	echo '<h2>Inventario de Materias prima</h2>';
	echo $this->element('admin_inventario');
}
// echo '<br>';
// echo '<h2>Movimientos</h2>';
// foreach($materiasprima as $m){
	// if (!empty($entradas[$m['Materiasprima']['id']]) || !empty($salidas[$m['Materiasprima']['id']])) {
		// echo '<h2>'.$m['Materiasprima']['descripcion'].'</h2>';
		// echo $this->element('admin_consultar_movimientos',array(
			// 'entradas' => $entradas[$m['Materiasprima']['id']],
			// 'salidas' => $salidas[$m['Materiasprima']['id']]
		// ));
		// echo '<br>';
	// } 
// }
?>