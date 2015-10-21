<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Unidad',array('type' => 'file','onSubmit' => 'return checkSize();'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Número</td>';
	echo '<td>';
	echo $this->Form->input('numero',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('nombre',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Jefe de la Unidad</td>';
	echo '<td>';
	echo $this->Form->input('user_id',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Descripcion</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h3>Miembros del Personal</h3>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Personal 1</th>';
	echo '<th>Personal 2</th>';
	echo '<th>Personal 3</th>';
	echo '<th>Personal 4</th>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $this->Form->input('miembro_id',array(
		'value' => $miembro1,
		'name' => 'miembro1',
		'label' => false
	));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('miembro_id',array(
		'value' => $miembro2,
		'name' => 'miembro2',
		'label' => false
	));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('miembro_id',array(
		'value' => $miembro3,
		'name' => 'miembro3',
		'label' => false
	));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('miembro_id',array(
		'value' => $miembro4,
		'name' => 'miembro4',
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
funciones_rol();
$('#rol_usuario').change(function() {
  funciones_rol();
});
function funciones_rol() {
	rol = $('#rol_usuario').val();
	if (rol == 'admin') {
		$('#div_rol_cliente').css('display','none');
		$('#div_rol_admin').css('display','block');
		$('.cliente').css('display','none');
		$('.cliente_label').css('display','none');
		inputs = $('#div_rol_cliente input');
		$('.cliente').val(0);
		$.each( inputs, function( key, value ) {
			$(this).val(0);
			$(this).attr('checked',false);
		});
	} else if (rol == 'cliente') {
		$('#div_rol_admin').css('display','none');
		$('#div_rol_cliente').css('display','block');
		$('.cliente').css('display','block');
		$('.cliente_label').css('display','block');
		inputs = $('#div_rol_admin input');
		$.each( inputs, function( key, value ) {
			$(this).val(0);
			$(this).attr('checked',false);
		});
	}
}

$( "input[type=checkbox]" ).on( "click",function(){
	$(this).val(1);
	$(this).attr('checked',true);
});

function checkSize() {
	var max_img_size = 1803600;
	var input2 = document.getElementById("upload_imagen");
  
    if(input2.files && input2.files.length == 1)
    {           
        if (input2.files[0].size > max_img_size) 
        {
			var clon = $("#upload_imagen").clone(); 
			$("#upload_imagen").replaceWith(clon);
            alert("Las imágenes no pueden superar 1.8 MB");
            return false;
        }
    }
	
    
}
</script>