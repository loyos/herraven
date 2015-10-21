<div class= "search">
	<?php			
			echo $this->Form->create(null, array(
				'url' => array_merge(array('action' => 'admin_pedidos'), $this->params['pass'])
			));
			echo "<table><tr>";
			echo "<td>";
			echo "Cliente:";
			echo "</td>";
			echo "<td>";
			echo $this->Form->input('cliente', array('div' => false, 'label' => false, 'empty' => 'Todos'));
			echo "</td></tr>";
			echo "<tr><td>";
			echo "Estatus:";
			echo "</td>";
			echo "<td>";
			echo $this->Form->select('Pedido.status', array(
				'No disponible' => 'No disponible',
				'cancelado' => 'Cancelado',
				'Progreso-Despacho' => 'Progreso-Despacho',
				'Despachado' => 'Despachado',
				'Disponible' => 'Disponible',
				'Preparado' => 'Preparado',
				'Pendiente' => 'Pendiente'
			));
			// echo $this->Form->input('wachu', array('div' => false, 'label' => false));
			echo "</td></tr>";
			echo "<tr><td>";
			echo "Nro de pedido:";
			echo "</td><td>";
			echo $this->Form->input('num_pedido', array('div' => false, 'label' => false));
			echo "</td></tr>";
			
			echo "<tr><td>";
			echo "Acabado:";
			echo "</td><td>";
			echo $this->Form->input('acabado', array('div' => false, 'label' => false));
			echo "</td></tr>";
			echo "</table>";			
			echo $this->Form->submit(__('Buscar'), array('div' => 'search_button', 'class' => 'boton_busqueda'));
			echo $this->Form->end();
	?>
</div>