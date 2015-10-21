<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		
	});
</script>

<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
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
	echo '</tr>';
	echo '<tr>';
	echo '<td>Video</td>';
	echo '<td>';
	echo $this->Form->input('video',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array(
		'type' => 'hidden'
	));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>