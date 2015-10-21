<div class='wrap'>
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Herramientas</h1>
<?php 
if(!empty($herramientas_proveedor['Herramienta'])){
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Herramienta</th>';
	echo '<th>Lote</th>';
	echo '<th>Precio</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($herramientas_proveedor['Herramienta'] as $h) {
		echo '<tr>';
		echo '<td>'.$h['nombre'].'</td>';
		echo '<td>'.$h['Lotesherramienta']['nombre'].'</td>';
		echo '<td>'.$h['HerramientasProveedor']['precio'].'</td>';
		echo '<td>'.$this->Html->link('Eliminar',array('action'=>'admin_eliminar_herramienta',$id,$h['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '<h3>No hay herramientas asociadas a este proveedor</h3>';
}
echo '<h3>Agregar Herramienta</h3>';
echo $this->Form->create('HerramientasProveedor');
echo $this->Form->input('herramienta_id');
echo $this->Form->input('precio');
echo $this->Form->input('proveedor_id',array('value'=>$id,'type'=>'hidden'));
echo $this->Form->submit('Agregar', array('class' => 'button'));
echo $this->Form->end;
?>
</div>