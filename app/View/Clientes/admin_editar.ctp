<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo. ' ';  ?> Cliente</h1>
<?php 
	echo $this->Form->create('Cliente');
	echo '<table>';
	echo '<tr>';
	echo '<td>Denom. legal</td>';
	echo '<td>';
	echo $this->Form->input('denominacion_legal',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Dirección de despacho</td>';
	echo '<td>';
	echo $this->Form->input('direccion_despacho',array(
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
	echo '<td>Representante</td>';
	echo '<td>';
	echo $this->Form->input('representante',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Telefono</td>';
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
	echo '<tr><td>Ciudad</td>';
	echo '<td>';
	echo $this->Form->input('ciudad',array(
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
	echo '<td>Direccion</td>';
	echo '<td>';
	echo $this->Form->input('direccion',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Email de representate</td>';
	echo '<td>';
	echo $this->Form->input('email_representante',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Lista de precio</td>';
	echo '<td>';
	echo $this->Form->input('precio_id',array(
		'label' => false
	));
	echo '</td>';
	echo '<td>Sitio Web</td>';
	echo '<td>';	
	echo $this->Form->input('sitio_web',array(
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
