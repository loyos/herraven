<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'lotes_herramientas'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Herramienta', array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Herramienta</td>';
	echo '<td>';
	echo $this->Form->input('nombre',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Lote</td>';
	echo '<td>';
	echo $this->Form->input('lotesherramienta_id',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Fecha de Compra</td>';
	echo '<td>';
	echo $this->Form->input('fecha',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Precio de Compra</td>';
	echo '<td>';
	echo $this->Form->input('precio',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Descripción</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Imagen Principal</td>';
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
	echo '<td>Imagen (opcional)</td>';
	echo '<td>';
	echo $this->Form->file('Foto2',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden','value'=>$id));
		echo $this->Form->input('imagen',array('type'=>'hidden','value'=>$this->data['Herramienta']['imagen']));
	}
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
$( document ).ready(function() {
	val = $('#HerramientaFechaMonth').val();
	$('#HerramientaFechaMonth option').remove();
	if (val == '01') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '01').text('Enero'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '01').text('Enero'));
	}
	if (val == '02') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '02').text('Febrero'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '02').text('Febrero'));
	} 
	if (val == '03') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '03').text('Marzo'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '03').text('Marzo'));
	}
	if (val == '04') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '04').text('Abril'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '04').text('Abril'));
	}
	if (val == '05') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '05').text('Mayo'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '05').text('Mayo'));
	}
	if (val == '06') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '06').text('Junio'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '06').text('Junio'));
	}
	if (val == '07') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '07').text('Julio'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '07').text('Julio'));
	}
	if (val == '08') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '08').text('Agosto'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '08').text('Agosto'));
	}
	if (val == '09') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '09').text('Septiembre'));
	}else{
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '09').text('Septiembre'));
	}
	if (val == '10') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '10').text('Octubre'));
	}else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '10').text('Octubre'));
	}
	if (val == '11') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '11').text('Noviembre'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '11').text('Noviembre'));
	}
	if (val == '12') {
		$('#HerramientaFechaMonth').append($("<option selected='selected'></option>").attr("value", '12').text('Diciembre'));
	} else {
		$('#HerramientaFechaMonth').append($("<option></option>").attr("value", '12').text('Diciembre'));
	}
});
</script>