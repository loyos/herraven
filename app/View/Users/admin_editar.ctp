<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('User',array('type' => 'file','onSubmit' => 'return checkSize();'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Usuario</td>';
	echo '<td>';
	echo $this->Form->input('username',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	if (empty($id)) {
		echo '<tr>';
		echo '<td>Contraseña</td>';
		echo '<td>';
		echo $this->Form->input('password',array(
			'label' => false
		));
		echo '</td>';
		echo '</tr>';
	}
	echo '<tr>';
	echo '<td>Email</td>';
	echo '<td>';
	echo $this->Form->input('email',array(
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
	echo '<td>Apellido</td>';
	echo '<td>';
	echo $this->Form->input('apellido',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Rol</td>';
	echo '<td>';
	echo $this->Form->input('rol_id',array(
		'label' => false,
		'type' => 'select',
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Imagen</td>';
	echo '<td>';
	echo $this->Form->input('Foto',array(
		'label' => false,
		'type' => 'file',
		'id' =>'upload_imagen'
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<br>';
	echo '<table>';
	echo '<tr>';
	echo '<td>¿Es Cliente?</td>';
	echo '<td>';
	if (!empty($this->data['User']['rol']) && $this->data['User']['rol'] == 'admin') {
		$checked = false;
	} else {
		$checked = true;
	}
	echo $this->Form->input('is_admin',array(
		'label' => false,
		'type' => 'checkbox',	
		'id' => 'rol_usuario',
		'checked' => $checked
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="cliente_label">Cliente</td>';
	if (!empty($this->data['User']['cliente_id'])){
		$value = $this->data['User']['cliente_id'];
	} else {
		$value = 0;
	}
	echo '<td>';
	echo $this->Form->input('cliente_id',array(
		'label' => false,
		'class' => 'cliente',
		'value' => $value
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden','value'=> $id));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
<script>
funciones_rol();
$('#rol_usuario').change(function() {
  funciones_rol();
});
function funciones_rol() {

	if ($('#rol_usuario').is(':checked')) {
		$('.cliente').fadeIn("slow", function() {});
		$('.cliente_label').fadeIn("slow", function() {});
	} else {
		$('.cliente_label').fadeOut("slow", function() {});
		$('.cliente').fadeOut("slow", function() {});
		$('.cliente').val(0);
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