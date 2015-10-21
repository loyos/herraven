<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		
	});
</script>

<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_footer'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Contenido', array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Pestaña</td>';
	echo '<td>';
	echo $this->Form->input('alias',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Titulo</td>';
	echo '<td>';
	echo $this->Form->input('titulo',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Contenido</td>';
	echo '<td>';
	echo $this->Form->input('contenido',array(
		'label' => false
	));
	echo '</td>';
	echo '<tr>';
	echo '<td>Imagen</td>';
	echo '<td>';
	echo $this->Form->file('Imagen.Foto',array(
		'label' => 'Imagen'
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->input('ubicacion',array(
		'type' => 'hidden',
		'value' => 'abajo'
	));
	if (!empty($id)) {
		echo $this->Form->input('id',array(
		'type' => 'hidden'
	));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
	
	if(!empty($imagen)){
		echo "Imagen:<br><br>";
		
		echo $this->Html->image('contenido/'.$imagen['Imagen']['imagen'],array('width'=>'100px'));
		echo $this->Html->link('Eliminar',array(
			'action' => 'admin_eliminar_imagen',$imagen['Imagen']['id'],'admin_editar_footer',$id
		),
		array(
			'class' => 'boton_accion'
		),
		'¿Estás seguro que deseas eliminar esta imagen?');
	}
?>
</div>