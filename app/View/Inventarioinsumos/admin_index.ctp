<div class="wrap">
<div class="agregar_inventario">
	<?php
	echo $this->Html->link('Agregar Insumo',array('controller' => 'insumos' , 'action' => 'admin_editar',$lote_id),array('class'=>'boton'));
	echo ' ';
	echo $this->Html->link('Ingreso de Insumos',array('action' => 'admin_editar','entrada'),array('class'=>'boton'));
	echo ' ';
	echo $this->Html->link('Egreso de Insumos',array('action' => 'admin_editar','salida'),array('class'=>'boton'));
	echo '<br>';
	?>
</div>
<div class="ano_inventario">
	<table>
	<tr>
	<td>
	<b><u>Año</u></b></td>
	</tr>
	<tr>
	<td>
	<?php echo $ano; ?>
	</td>
	</tr></table>
</div>
<br>
<h1>Inventario Insumos</h1>
<div class="listado_categoria">
	<?php echo $lote ?>
</div>
<?php 
	if (!empty($insumos)) {
		echo $this->element('admin_inventario_insumo');
	}
?>
</div>
