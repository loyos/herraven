<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo?></h1>
<?php 
	echo $this->Form->create('Molde', array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Código</td>';
	echo '<td>';
	echo $this->Form->input('codigo',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Medidas</td>';
	echo '<td>';
	echo $this->Form->input('medidas',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Cavidades</td>';
	echo '<td>';
	echo $this->Form->input('cavidades',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Ubicacion</td>';
	echo '<td>';
	echo $this->Form->input('ubicacion',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Anotaciones</td>';
	echo '<td>';
	echo $this->Form->input('anotaciones',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Imagen principal</td>';
	echo '<td>';
	echo $this->Form->file('Foto',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Imagen (opcional)</td>';
	echo '<td>';
	echo $this->Form->file('Foto1',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Imagen (opcional)</td>';
	echo '<td>';
	echo $this->Form->file('Foto2',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h2>Materias prima</h2>';
	if (!empty($this->data['Molde']['materiasprimasmolde_id'])) {
		$value = $this->data['Molde']['materiasprimasmolde_id'];
	} else {
		$value = 0;
	}
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	echo $this->Form->input('materiasprimasmolde_id',array(
		'value' => $value,
		'label' => false,
		'id' => 'materiaprima_select'
	));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('cantidad',array(
		'label' => false,
	));
	echo '<td id="cantidad_mp">';
	echo '</td>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($this->data['Molde']['imagen_1'])) {
		echo $this->Form->input('imagen_1',array('type'=>'hidden'));
	}
	if (!empty($this->data['Molde']['id'])) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
	$(document).ready(function() {
		buscar_unidad();
	})
	$('#materiaprima_select').change(function(){
		buscar_unidad();
	});

	function buscar_unidad(){
		var mp = $('#materiaprima_select').val();
	$.ajax({
		type: "POST",
		url: '<?php echo FULL_BASE_URL.'/moldes/buscar_unidad.json' ?>',
		//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/moldes/buscar_unidad.json' ?>',
		data: { mp: mp },
		dataType: "json"
	}).done(function( msg ) {
		$('#cantidad_mp').html('Cantidad en '+msg+'. Los decimales se expresan con &quot; . &quot;');
	});
	}
</script>