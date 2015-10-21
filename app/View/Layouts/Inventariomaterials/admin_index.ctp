<div class="wrap">
<div class="agregar_inventario">
	<?php
	echo $this->Html->link('Ingreso de materia prima',array('action' => 'admin_editar'));
	echo '<br>';
	echo $this->Html->link('Ver reporte',array('action' => 'admin_reporte','ext' => 'pdf'),array('target'=>'_blank'));
	?>
</div>
<div class="ano_inventario">
	<b><u>Año</u></b><br>
	<?php echo $ano; ?>
</div>
<br>
<h1>Inventario Materias prima</h1>
<?php 
	if (!empty($materiasprima)) {
		echo $this->element('admin_inventario');
	}
?>
</div>
