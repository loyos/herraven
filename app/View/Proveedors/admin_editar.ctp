<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
if (empty($titulo)){
	$titulo = 'Proveedor';
}
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Proveedor',array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Denom. Legal</td>';
	echo '<td>';
	echo $this->Form->input('denominacion_legal',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Teléfono</td>';
	echo '<td>';
	echo $this->Form->input('codigo_uno',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_uno',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Rif</td>';
	echo '<td>';
	echo $this->Form->input('rif',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Teléfono</td>';
	echo '<td>';
	echo $this->Form->input('codigo_dos',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_dos',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Representante</td>';
	echo '<td>';
	echo $this->Form->input('representante',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Fax</td>';
	echo '<td>';
	echo $this->Form->input('codigo_fax',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('fax',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Ciudad</td>';
	echo '<td>';
	echo $this->Form->input('ciudad',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Email de representante</td>';
	echo '<td>';
	echo $this->Form->input('email_representante',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td></td>';
	echo '<td>';
	echo '</td>';
	echo '<td>Sitio Web</td>';
	echo '<td>';
	echo $this->Form->input('we',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Dirección</td>';
	echo '<td>';
	echo $this->Form->input('direccion',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Descripción</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Proveedor de</td>';
	echo '<td>';
	if (!empty($tipo)) {
		$val = $tipo;
	} else {
		$val = 0;
	}
	echo $this->Form->input('tipo_id',array(
		'class' => 'check_proveedor',
		'label' => false,
		'value' => $val
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr style="display:none" id="div_herramientas">';
	if (!empty($herramientas)) {
		$val = $herramientas;
	} else {
		$val = 0;
	}
	echo '<td>Lote de herramientas</td>';
	echo '<td>';
	echo $this->Form->input('lotesherramienta_id',array(
		'label' => false,
		'value'=> $val
	));
	echo '<td>';
	echo '</tr>';
	echo '<tr style="display:none" id="div_insumos">';
	if (!empty($insumos)) {
		$val = $insumos;
	} else {
		$val = 0;
	}
	echo '<td>Lote de insumos</td>';
	echo '<td>';
	echo $this->Form->input('lote_id',array(
		'label' => false,
		'value'=> $val
	));
	echo '<td>';
	echo '</tr>';
	$count = 1;
	$hecho = false;
	while ($count <= 5) {
		if (!empty($materias) && !$hecho) {
			$aux = 1;
			foreach ($materias as $m) {
				echo '<tr style="display:none" class="div_materias">';
				echo '<td>Materia prima</td>';
				echo '<td>';
				echo $this->Form->input('materiasprima_id',array(
					'label' => false,
					'name' => 'materias[]',
					'value' => $m['MateriasprimasProveedor']['materiasprima_id']
				));
				echo '<td>';
				echo '</tr>';
				$aux++;
			}
			$hecho =true;
			if ($aux == 5) {
				break;
			}
			$count = $aux;
		}
		echo '<tr style="display:none" class="div_materias">';
		echo '<td>Materia prima</td>';
		echo '<td>';
		echo $this->Form->input('materiasprima_id',array(
			'label' => false,
			'name' => 'materias[]',
			'value' => 0
		));
		echo '<td>';
		echo '</tr>';
		$count++;
	}
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	if (!empty($id_user)) {
		echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$id_user));
	}
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
mostrar_tipo();
$(".check_proveedor").change(function() {
	mostrar_tipo();
});
function mostrar_tipo(){
	tipo = $('.check_proveedor').val();
	if (tipo == 'herramientas') {
		$('.div_materias').hide();
		$('#div_insumos').hide();
		$('#div_herramientas').fadeIn();
	} 
	if (tipo == 'insumos') {
		$('.div_materias').hide();
		$('#div_herramientas').hide();
		$('#div_insumos').fadeIn();
	}
	if (tipo == 'materiasprimas') {
		$('#div_insumos').hide();
		$('#div_herramientas').hide();
		$('.div_materias').fadeIn();
	}
}
</script>