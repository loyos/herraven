<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_ver',$id,$subcategoria_id),array('class'=>'boton'));
?>
<h1><?php echo $titulo?></h1>
<?php 
	echo $this->Form->create('Articulosproduccion', array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Codigo</td>';
	echo '<td>';
	echo $this->Form->input('codigo',array(
			'label' => false,
		));
	echo '</td>';
	echo '<td>Descripción</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
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
	echo '<td>Imagen (opcional)</td>';
	echo '<td>';
	echo $this->Form->file('Foto1',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Categoria</td>';
	echo '<td>';
	echo $this->Form->input('subcategoriaminumet_id',array(
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
	echo '<h2>Materias prima</h2>';
	if (!empty($this->data['Articulosproduccion']['materiasprimasproduccion_id'])) {
		$value = $this->data['Articulosproduccion']['materiasprimasproduccion_id'];
	} else {
		$value = 0;
	}
	echo '<table>';
	echo '<tr>';
	echo '<td>';
	echo $this->Form->input('materiasprimasproduccion_id',array(
		'value' => $value,
		'label' => false
	));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('cantidad',array(
		'label' => false,
	));
	echo '<td>';
		echo 'Cantidad de Materia Prima por artículo';
	echo '</td>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	if (!empty($this->data['Articulosproduccion']['imagen'])) {
		echo $this->Form->input('imagen',array('type'=>'hidden'));
	}
	echo $this->Form->input('subcategoria_id',array('type'=>'hidden','value' => $subcategoria_id));
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
$(document).ready(function() {
	buscar_subcat();
	buscar_acabados();
	es_exclusivo();
})

$('#es_exclusivo').change(function(){
	es_exclusivo();
});

function es_exclusivo(){
	if ($('#es_exclusivo').is(':checked')){
		$('#clientes_asociados').fadeIn();
	} else {
		$('.clientes_asociados_check').attr('checked', false);
		$('#clientes_asociados').fadeOut();
	}
}

$('#categoria').change(function(){
	buscar_subcat();
});

function buscar_subcat() {
	var cate_id = $('#categoria').val();
	$.ajax({
		type: "POST",
		url: '<?php echo FULL_BASE_URL.'/articulos/buscar_subcat.json' ?>',
		//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/articulos/buscar_subcat.json' ?>',
		data: { cat_id: cate_id },
		dataType: "json"
	}).done(function( msg ) {
		// alert( "Data Saved: " + msg[1].Genero.nombre);
		$('#subcategoria option').remove();
		$('#subcategoria').append($("<option></option>").attr("value", '').text('Selecciona una subcategoria'));
		$.each(msg, function(i,a){	
			if (<?php echo $subcategoria_id?> == a.Subcategoria.id) {
				$('#subcategoria').append($("<option selected=selected ></option>").attr("value", a.Subcategoria.id).text(a.Subcategoria.descripcion)); 
			}
			$('#subcategoria').append($("<option ></option>").attr("value", a.Subcategoria.id).text(a.Subcategoria.descripcion)); 
		});
	});
}

$(".check_acabado").change(function() {

	agregar_acabado(this)
});

function buscar_acabados(){
	$.each($('.check_acabado'), function(index, value) {
		if ($(value).is(':checked')){
			agregar_acabado(value);
		}
	});
}

function agregar_acabado(el){
		id_check = $(el).attr('id');
		if ($('#tabla_'+id_check).length) { 
			if ($(el).is(':checked')) {
			}else{
				$('#tabla_'+id_check).remove();
			}
		} else {
			if ($(el).is(':checked')) {
			titulo = $(el).attr('desc');
			$('#tabla_materias_acabado .titulo_tabla').html(titulo);
			nuevo = $('#tabla_materias_acabado').clone().appendTo('#acabados_articulo').css('display','block');
			nuevo.attr('id','tabla_'+id_check);
			selects = $('#tabla_'+id_check).find('select');
			//$('#id_acabado').val($('#id_acabado').val()+','+id_check);
			$.each(selects, function(index, value) {
				if ($(value).attr('name') == 'materia_acabado') {
					$(value).attr('name','materia_acabado_'+id_check+'[]');
					id_cantidad = $(value).attr('id');
					$(value).attr('id',id_cantidad+'_'+id_check);
					$(value).attr('id2',id_check);
				}
			});
			inputs = $('#tabla_'+id_check).find('input');
			$.each(inputs, function(index, value) {
				if ($(value).attr('name') == 'cantidad_acabado') {
					$(value).attr('name','cantidad_acabado_'+id_check+'[]');
					id_cantidad = $(value).attr('id');
					$(value).attr('id',id_cantidad+'_'+id_check);
					$(value).attr('id2',id_check);
				}
			});
			} else {
				id_check = $(el).attr('id');
				$('#tabla_'+id_check).remove();
			}
		}
}

// function buscar_precio(){
	// // $.each($('.check_acabado'), function(index, value) {
		// // if ($(value).is(':checked')){
			// // id_check = $(value).attr('id');
			 // precio = 0;
			// $.each($('.cantidad_acabado'), function() {
				// //if ($(this).attr('id2') == id_check){
					// if ($(this).val() != 0){
						// precio = precio + calcular_precio_acabados(this);
					// }
				// //}
			// });			
		// // }
	// // });
	// //alert(precio);
// }

// function calcular_precio_acabados(input) {
	// id_cantidad = $(input).attr('id');
	// materia = $('select#'+id_cantidad).val();
	// //alert(id2_cantidad);
	// $.each($('.materias_acabado[id='+id_cantidad+']'), function(index, value) {
			// id_materia = $(value).val();
			// cantidad = $(input).val();
			// alert(id_materia);
			// $.ajax({
				// type: "POST",
				// // url: '<?php echo FULL_BASE_URL.'/articulos/buscar_subcat.json' ?>',
				// url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/articulos/buscar_precio.json' ?>',
				// data: { id_materia: id_materia, cantidad: cantidad},
				// dataType: "json"
			// }).done(function( msg ) {
				// //alert(msg);
				// precio = msg;
				// alert(id_materia+' '+msg);
			// }); 		
	// });
	// return(precio);
// }
</script>