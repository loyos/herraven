<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Clientes</h1>
<?php 
	if (!empty($clientes)) {
		?>
		<table class="tabla_index">
		<tr>
		<th st>Denominacion Legal</th>
		<th>Representante</th>
		<th>Telefono</th>
		<th>Email representante</th>
		<th>Lita de precio</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($clientes as $c) {
			echo '<tr>';
			echo '<td>'.$c['Cliente']['denominacion_legal'].'</td>';
			echo '<td>'.$c['Cliente']['representante'].'</td>';
			echo '<td>'.$c['Cliente']['telefono_uno'].'</td>';
			echo '<td>'.$c['Cliente']['email_representante'].'</td>';
			echo '<td>'.$c['Precio']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array('action' => 'admin_editar',$c['Cliente']['id']),array('class'=>'boton_accion')).'<br>'.'<br>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Cliente']['id']),array('class'=>'boton_accion')).'</td>';
			//.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Cliente']['id']),array(),'¿Estás seguro que deseas eliminar?')
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>
