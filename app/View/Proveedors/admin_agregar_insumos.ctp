<div class='wrap'>
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Insumos</h1>
<?php 
if(!empty($insumos_proveedor['Insumo'])){
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Insumo</th>';
	echo '<th>Lote</th>';
	echo '<th>Precio</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($insumos_proveedor['Insumo'] as $h) {
		echo '<tr>';
		echo '<td>'.$h['nombre'].'</td>';
		echo '<td>'.$h['Lote']['nombre'].'</td>';
		echo '<td>'.$h['InsumosProveedor']['precio'].'</td>';
		echo '<td>'.$this->Html->link('Eliminar',array('action'=>'admin_eliminar_insumo',$id,$h['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '<h3>No hay insumos asociadas a este proveedor</h3>';
}
echo '<h3>Agregar Insumo</h3>';
echo $this->Form->create('InsumosProveedor');
echo $this->Form->input('insumo_id');
echo $this->Form->input('precio');
echo $this->Form->input('proveedor_id',array('value'=>$id,'type'=>'hidden'));
echo $this->Form->submit('Agregar', array('class' => 'button'));
echo $this->Form->end;
?>
</div>