<div class= "search">
	<?php
			echo $this->Form->create(null, array(
				'url' => array_merge(array('action' => 'admin_index'), $this->params['pass'])
			));
			echo "<table><tr>";
			echo "<td>";
			echo "Cliente:";
			echo "</td>";
			echo "<td>";
			echo $this->Form->input('cliente', array('div' => false, 'label' => false, 'empty' => 'Todos'));
			echo "</td></tr>";
			echo "<tr><td>";
			echo "Status:";
			echo "</td>";
			echo "<td>";
			echo $this->Form->select('status', array(
				'Vigente' => 'Vigente',
				'Pagado' => 'Pagado',
			), array('empty' => 'Todos'));
			echo "</td></tr>";
			echo "</table>";			
			echo $this->Form->submit(__('Buscar'), array('div' => 'search_button', 'class' => 'boton_busqueda'));
			echo $this->Form->end();
	?>
</div>