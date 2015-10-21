<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Materias prima</h1>
<?php 
	if (!empty($materias)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Materia prima</th>
		<th>Unidad</th>
		<th>Precio en lista base</th>
		</tr>
		<?php
		foreach($materias as $m) {
			echo '<tr>';
			echo '<td>'.$m['Materiasprima']['descripcion'].'</td>';
			echo '<td>'.$m['Materiasprima']['unidad'].'</td>';
			echo '<td>'.$this->Herra->format_number($m['Materiasprima']['precio']).'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$m['Materiasprima']['id']),array('class'=>'boton_accion')).'<br>';
			if($borrar[$m['Materiasprima']['id']]==1){
				echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$m['Materiasprima']['id'])
					,array('class'=>'boton_accion'),
					'¿Estás seguro que deseas eliminar?');
			}
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>
