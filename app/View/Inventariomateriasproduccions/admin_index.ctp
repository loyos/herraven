<div class="wrap">
<div class="agregar_inventario">
	<?php
	echo $this->Html->link('Ingreso de materia prima',array('action' => 'admin_editar'),array('class'=>'boton'));
	echo '  ';
	echo $this->Html->link('Agregar nueva materia prima',array('controller' => 'materiasprimasproduccions','action' => 'admin_editar'),array('class'=>'boton'));
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
<h1>Inventario Materias prima</h1>
<?php 
	if (!empty($materiasprima)) {
		echo $this->element('admin_inventario_produccion');
	}
?>
</div>
