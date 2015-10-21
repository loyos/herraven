<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<?php
	echo '<h1>Agregar nueva imagen</h1>';
	echo $this->Form->create('Imagen', array('type' => 'file'));
	echo $this->Form->file('Foto',array(
		'label' => 'Imagen'
	));
	echo $this->Form->input('contenido',array(
		'value' => $id,
		'type' => 'hidden'
	));
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
if (!empty($imagenes)) {
?>
<table>
	<tr>
		<th>
			Imágenes
		</th>
	</tr>
	<?php foreach ($imagenes as $i) {
		echo '<tr>';
			echo '<td>'.$this->Html->image('contenido/'.$i['Imagen']['imagen'],array('width'=>'100px')).'<td>';
			echo '<td>'.$this->Html->link('Eliminar',array(
				'action' => 'admin_eliminar_imagen',$i['Imagen']['id'],'admin_agregar_imagen_contenido',$id
			),
			array(
				'class' => 'boton_accion'
			),
			'¿Estás seguro que deseas eliminar esta imagen?').'<td>';
		echo '</tr>';
	} ?>
</table>
<?php
} ?>
</div>