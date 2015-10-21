<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('controller' => 'herramientas','action' => 'admin_index_lotes'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Lote');
	echo '<table>';
	echo '<tr>';
	echo '<td>Lote</td>';
	echo '<td>';
	echo $this->Form->input('nombre',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
$('#division').change(function(){
	division_change();
});

$('#departamento').change(function(){
	departamento_change();
});

function division_change(){
	division = $('#division').val();
	if (division > 0) {
		$.ajax({
			type: "POST",
			url: '<?php echo FULL_BASE_URL.'/insumos/buscar_departamentos.json' ?>',
			//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/insumos/buscar_departamentos.json' ?>',
			data: { division: division},
			dataType: "json"
		}).done(function( msg ) {
			$('#departamento option').remove();
			$('#unidad option').remove();
			$('#departamento').append($("<option></option>").attr("value", 0).text('Selecciona un departamento'));
			$.each(msg, function(i,a){
				$('#departamento').append($("<option></option>").attr("value", a.Departamento.id).text(a.Departamento.nombre));
			});
		});
	} else {
		$('#departamento option').remove();
		$('#departamento').append($("<option></option>").attr("value", 0).text('Selecciona un departamento'));	
	} 
}

function departamento_change(){
	departamento = $('#departamento').val();
	if (departamento > 0) {
		$.ajax({
			type: "POST",
			url: '<?php echo FULL_BASE_URL.'/insumos/buscar_departamentos.json' ?>',
			//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/insumos/buscar_unidades.json' ?>',
			data: { departamento: departamento},
			dataType: "json"
		}).done(function( msg ) {
			$('#unidad option').remove();
			$('#unidad').append($("<option></option>").attr("value", 0).text('Selecciona una unidad'));
			$.each(msg, function(i,a){
				$('#unidad').append($("<option></option>").attr("value", a.Unidad.id).text(a.Unidad.nombre));
			});
		});
	} else {
		$('#unidad option').remove();
		$('#unidad').append($("<option></option>").attr("value", 0).text('Selecciona una unidad'));	
	} 
}
</script>