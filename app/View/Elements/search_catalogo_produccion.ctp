<div class= "search">
	<?php			
			echo $this->Form->create(null, array(
				//'url' => array_merge(array('action' => 'admin_catalogo'), $this->params['pass'])
			));
			echo "<table><tr>";
			echo "<td>";
			echo "Código:";
			echo "</td>";
			echo "<td>";
			echo $this->Form->input('codigo', array('div' => false, 'label' => false));
			echo "</td></tr>";
			echo "<tr><td>";
			echo "Ubicación:";
			echo "</td><td>";
			echo $this->Form->input('ubicacion', array('div' => false, 'label' => false));
			echo "</td></tr>";
			echo "</table>";			
			echo $this->Form->submit(__('Buscar'), array('div' => 'search_button', 'class' => 'boton_busqueda'));
			echo $this->Form->end();
	?>
</div>