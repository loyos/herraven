<div class="wrap">
<div class="agregar_inventario">
	<?php
	echo $this->Html->link('Salida de Artículos',array('action' => 'admin_editar'),array('class'=>'boton'));
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
<h1>Inventario Artículos</h1>
<?php 
	if (!empty($articulos)) {
		echo $this->element('admin_inventarioarticulos_produccion');
	}
?>
</div>
