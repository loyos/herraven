<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Lista de Precios</h1>
<?php 
	echo '<div class="consulta_lista_base">';
		echo 'Lista base &nbsp&nbsp&nbsp';
		echo $this->Html->link('Ver',array('action' => 'admin_listar_subcategorias',1),array('class'=>'boton_accion')).'</td>';
	echo '</div>';
	if (!empty($precios)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Lista</th>
		<th>% aumento respecto a Lista base</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($precios as $p) {
			if ($p['Precio']['id'] != 1) {
				echo '<tr>';
				echo '<td>'.$p['Precio']['descripcion'].'</td>';
				echo '<td>'.$p['Precio']['ganancia'].'%</td>';
				echo '<td>';
				
				echo $this->Html->link('Editar',array('action' => 'admin_editar',$p['Precio']['id']),array('class'=>'boton_accion')).'<br>';
				echo $this->Html->link('Eliminar',
					array('action' => 'admin_eliminar',$p['Precio']['id']),array('class'=>'boton_accion'),
					'¿Estás seguro que deseas eliminar?').'<br>';
				echo $this->Html->link('Ver',array('action' => 'admin_listar_subcategorias',$p['Precio']['id']),array('class'=>'boton_accion')).'</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	}
?>
</div>
