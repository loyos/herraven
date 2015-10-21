<div class = "wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_agregar_imagen'),array('class'=>'boton'));
echo '<h1>Imágenes del home</h1>';
if (!empty($imagenes)) {
?>
<table class="tabla_index">
	<tr>
		<th>Imágen</th>
		<th>Acciones</th>
	</tr>
	<?php 
	foreach ($imagenes as $i) {
	?>
	<tr>
		<td><?php echo $this->Html->image('home/'.$i['Imagen']['imagen'],array('width' => '150px')) ?></td>
		<td><?php
		echo $this->Html->link('Eliminar',array(
				'action' => 'admin_eliminar_imagen',$i['Imagen']['id']
			),
			array(
				'class' => 'boton_accion'
			),
			'¿Estás seguro que deseas eliminar esta imagen?');
		?></td>
	</tr>
	<?php
	}
	?>
</table>
<?php
} else {
	echo '<h3>No hay imágenes en el home</h3>';
}
	// echo '<h1>Agregar nueva imagen</h1>';
	// echo $this->Form->create('Contenido', array('type' => 'file'));
	// echo $this->Form->file('Foto',array(
		// 'label' => 'Imagen'
	// ));
	// echo $this->Form->submit('Agregar', array('class' => 'button'));
	// echo $this->Form->end;

?>
</div>