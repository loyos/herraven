<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
if (empty($titulo)){
	$titulo = 'Miembro del Personal';
}
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Miembro',array('type' => 'file','onSubmit' => 'return checkSize();'));
	if (!empty($id)) {
		echo $this->Html->link('Retirar',array('action' => 'admin_finalizar',$id),array('class'=>'boton boton_rojo'),'¿Estás seguro que el usuario esta retirado?');
		echo '<br><br>';
	}
	echo '<table>';
	echo $this->Form->input('es_usuario',array('type'=>'hidden','value'=>0,'id'=>'es_usuario'));
	// echo $this->Form->button('Usuario/No Usuario',array('class'=>'boton','id'=>'usuario'));
	//
	// if (!empty($this->data['User']['username']) && $this->data['User']['username'] != 'no_usuario') {
		// $display = '';
		// $value = 1;
	// } else {
		// $display = 'none';
		// $value = 0;
	// }
	// 
	// 
	// echo '<tr id="username_miembro" style="display:'.$display.'">';
	// echo '<td>Username</td>';
	// echo '<td>';
	// echo $this->Form->input('User.username',array(
		// 'label' => false,
		// 'id' => 'username',
		// 'value' => '.'
	// ));
	// echo '</td>';
	// if (empty($id)) {
		// echo '<td>Contraseña</td>';
		// echo '<td>';
		// echo $this->Form->input('User.password',array(
			// 'label' => false,
			// 'id' => 'contrasena',
			// 'value' => '.'
		// ));
		// echo '</td>';
	// } else {
		// echo '<td></td><td></td>';
	// }
	// echo '</tr>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('User.nombre',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Apellido</td>';
	echo '<td>';
	echo $this->Form->input('User.apellido',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Email</td>';
	echo '<td>';
	echo $this->Form->input('User.email',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Foto</td>';
	echo '<td>';
	echo $this->Form->input('User.Foto',array(
		'label' => false,
		'type' => 'file',
		'id' =>'upload_imagen'
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
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
	echo '<td>Celular</td>';
	echo '<td>';
	echo $this->Form->input('codigo_celular',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_celular',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Direccion</td>';
	echo '<td>';
	echo $this->Form->input('direccion',array(
		'label' => false,
	));
	echo '</td>';
	echo '<td>Estudios</td>';
	echo '<td>';
	echo $this->Form->input('estudios',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Puesto</td>';
	echo '<td>';
	echo $this->Form->input('puesto',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Fecha de nacimiento</td>';
	echo '<td>';
	echo $this->Form->input('fecha_nacimiento',array(
		'label' => false,
		'dateFormat' => 'DMY',
		'minYear' => date('Y') - 70,
		'class' => 'input_fecha',
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Fecha de ingreso</td>';
	echo '<td>';
	echo $this->Form->input('fecha_ingreso',array(
		'class' => 'input_fecha',
		'label' => false
	));
	echo '</td>';
	echo '<td>IQ</td>';
	echo '<td>';
	echo $this->Form->input('IQ',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Fecha último IQ</td>';
	echo '<td>';
	echo $this->Form->input('fecha_IQ',array(
		'label' => false,
	));
	echo '</td>';
	echo '<td>Imagen IQ test</td>';
	echo '<td>';
	echo $this->Form->input('Test',array(
		'label' => false,
		'type' => 'file',
		'id' =>'upload_imagen',
		'class' => 'input_fecha',
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Anotaciones medicas</td>';
	echo '<td>';
	echo $this->Form->input('anotaciones_medicas',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Observaciones</td>';
	echo '<td>';
	echo $this->Form->input('observaciones',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h3>Contacto 1</h3>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('contacto1',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Parentesco</td>';
	echo '<td>';
	echo $this->Form->input('parentesco1',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Telefono 1</td>';
	echo '<td style="width:200px">';
	echo $this->Form->input('codigo_t1c1',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_t1c1',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Telefono 2</td>';
	echo '<td style="width:200px">';
	echo $this->Form->input('codigo_t2c1',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_t2c1',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h3>Contacto 2</h3>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('contacto2',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Parentesco</td>';
	echo '<td>';
	echo $this->Form->input('parentesco2',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Telefono 1</td>';
	echo '<td style="width:200px">';
	echo $this->Form->input('codigo_t1c2',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_t1c2',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Telefono 2</td>';
	echo '<td style="width:200px">';
	echo $this->Form->input('codigo_t2c2',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_t2c2',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h3>Contacto 3</h3>';
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('contacto3',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Parentesco</td>';
	echo '<td>';
	echo $this->Form->input('parentesco3',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Telefono 1</td>';
	echo '<td style="width:200px">';
	echo $this->Form->input('codigo_t1c3',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_t1c3',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Telefono 2</td>';
	echo '<td style="width:200px">';
	echo $this->Form->input('codigo_t2c3',array(
		'label' => false,
		'class' => 'codigo_telefono',
	));
	echo $this->Form->input('telefono_t2c3',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	if (!empty($id_user)) {
		echo $this->Form->input('User.id',array('type'=>'hidden','value'=>$id_user));
	}
	echo $this->Form->submit('Guardar', array('class' => 'button'));
?>
</div>
<script>
$( document ).ready(function() {
	val_nacimiento = $('#MiembroFechaNacimientoMonth').val();
	$('#MiembroFechaNacimientoMonth option').remove();
	if (val_nacimiento == '01') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '01').text('Enero'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '01').text('Enero'));
	}
	if (val_nacimiento == '02') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '02').text('Febrero'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '02').text('Febrero'));
	} 
	if (val_nacimiento == '03') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '03').text('Marzo'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '03').text('Marzo'));
	}
	if (val_nacimiento == '04') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '04').text('Abril'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '04').text('Abril'));
	}
	if (val_nacimiento == '05') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '05').text('Mayo'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '05').text('Mayo'));
	}
	if (val_nacimiento == '06') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '06').text('Junio'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '06').text('Junio'));
	}
	if (val_nacimiento == '07') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '07').text('Julio'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '07').text('Julio'));
	}
	if (val_nacimiento == '08') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '08').text('Agosto'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '08').text('Agosto'));
	}
	if (val_nacimiento == '09') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '09').text('Septiembre'));
	}else{
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '09').text('Septiembre'));
	}
	if (val_nacimiento == '10') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '10').text('Octubre'));
	}else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '10').text('Octubre'));
	}
	if (val_nacimiento == '11') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected' ></option>").attr("value", '11').text('Noviembre'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '11').text('Noviembre'));
	}
	if (val_nacimiento == '12') {
		$('#MiembroFechaNacimientoMonth').append($("<option selected='selected'></option>").attr("value", '12').text('Diciembre'));
	} else {
		$('#MiembroFechaNacimientoMonth').append($("<option></option>").attr("value", '12').text('Diciembre'));
	}
	
	val = $('#MiembroFechaIngresoMonth').val();
	$('#MiembroFechaIngresoMonth option').remove();
	if (val == '01') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '01').text('Enero'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '01').text('Enero'));
	}
	if (val == '02') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '02').text('Febrero'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '02').text('Febrero'));
	} 
	if (val == '03') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '03').text('Marzo'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '03').text('Marzo'));
	}
	if (val == '04') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '04').text('Abril'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '04').text('Abril'));
	}
	if (val == '05') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '05').text('Mayo'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '05').text('Mayo'));
	}
	if (val == '06') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '06').text('Junio'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '06').text('Junio'));
	}
	if (val == '07') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '07').text('Julio'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '07').text('Julio'));
	}
	if (val == '08') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '08').text('Agosto'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '08').text('Agosto'));
	}
	if (val == '09') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '09').text('Septiembre'));
	}else{
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '09').text('Septiembre'));
	}
	if (val == '10') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '10').text('Octubre'));
	}else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '10').text('Octubre'));
	}
	if (val == '11') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '11').text('Noviembre'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '11').text('Noviembre'));
	}
	if (val == '12') {
		$('#MiembroFechaIngresoMonth').append($("<option selected='selected'></option>").attr("value", '12').text('Diciembre'));
	} else {
		$('#MiembroFechaIngresoMonth').append($("<option></option>").attr("value", '12').text('Diciembre'));
	}
	
	val = $('#MiembroFechaIQMonth').val();
	$('#MiembroFechaIQMonth option').remove();
	if (val == '01') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '01').text('Enero'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '01').text('Enero'));
	}
	if (val == '02') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '02').text('Febrero'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '02').text('Febrero'));
	} 
	if (val == '03') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '03').text('Marzo'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '03').text('Marzo'));
	}
	if (val == '04') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '04').text('Abril'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '04').text('Abril'));
	}
	if (val == '05') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '05').text('Mayo'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '05').text('Mayo'));
	}
	if (val == '06') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '06').text('Junio'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '06').text('Junio'));
	}
	if (val == '07') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '07').text('Julio'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '07').text('Julio'));
	}
	if (val == '08') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '08').text('Agosto'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '08').text('Agosto'));
	}
	if (val == '09') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '09').text('Septiembre'));
	}else{
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '09').text('Septiembre'));
	}
	if (val == '10') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '10').text('Octubre'));
	}else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '10').text('Octubre'));
	}
	if (val == '11') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '11').text('Noviembre'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '11').text('Noviembre'));
	}
	if (val == '12') {
		$('#MiembroFechaIQMonth').append($("<option selected='selected'></option>").attr("value", '12').text('Diciembre'));
	} else {
		$('#MiembroFechaIQMonth').append($("<option></option>").attr("value", '12').text('Diciembre'));
	}
});

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
$("#usuario").click(function() {
 
  $("#username_miembro").toggle();
  if($("#username_miembro").is(":visible")){
	 $("#username").val('');
	  $("#contrasena").val('');
	$("#es_usuario").val(1);
  } else {
	 $("#username").val('.');
	 $("#contrasena").val('.');
	$("#es_usuario").val(0);
  }
});
</script>