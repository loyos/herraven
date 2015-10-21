<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Permisologia</h1>
Rol: <?php echo $rol['Rol']['nombre'].'<br><br>';?>
<?php 
	if (!empty($bloques)) {
		echo $this->Form->create('Rol');
		foreach ($bloques as $k => $b) {
			echo 'Bloque: '.$k;
			?>
			<table class="tabla_index">
			<tr>
			<th>Modulo</th>
			<?php for ($i=1;$i<=$b['num_submodulos'];$i++) { ?>
			<th>Submodulo</th>
			<?php } ?>
			</tr>
			<?php
			foreach($b['modulos'] as $m) {
				echo '<tr>';
				echo '<td style = "text-align:left">';
				if (in_array($m['Modulo']['id'],$modulos_rol)) {
					$checked = true;
				} else {
					$checked = false;
				}
				echo $this->Form->input('modulos_sel',array(
					'type' => 'checkbox',
					'label' => false,
					'class' => 'check_float',
					'checked' => $checked,
					'name' => 'modulos_sel['.$m['Modulo']['id'].']',
				));
				echo '<div>';
				echo $m['Modulo']['nombre'].'</div></td>';
				$aux = 0;
				$count = 1;
				for ($i=0;$i<$b['num_submodulos'];$i++) {
					if (!empty($b['submodulos'][$m['Modulo']['id']]) && $count>7) {
						echo '</tr><tr><td></td>';
						$count = 0;
					}
					if (!empty($b['submodulos'][$m['Modulo']['id']])) {
						if (!empty($b['submodulos'][$m['Modulo']['id']][$aux]['Modulo']['nombre'])) {
							echo '<td style = "text-align:left">';
							if (in_array($b['submodulos'][$m['Modulo']['id']][$aux]['Modulo']['id'],$modulos_rol)) {
								$checked = true;
							} else {
								$checked = false;
							}
							echo $this->Form->input('modulos_sel',array(
								'type' => 'checkbox',
								'label' => false,
								'class' => 'check_float',
								'checked' => $checked,
								'name' => 'submodulos_sel['.$b['submodulos'][$m['Modulo']['id']][$aux]['Modulo']['id'].']',
							));
							echo '<div>'.$b['submodulos'][$m['Modulo']['id']][$aux]['Modulo']['nombre'].'</div></td>';
						} else {
							echo '<td></td>';
						}
					} else {
						echo '<td></td>';
					}
					$aux++;$count++;
				} 
				echo '</tr>';
			}
			echo '</table>';
			echo '<br><br>';
		}
		echo $this->Form->input('rol',array(
			'type' => 'hidden',
			'value' => $rol['Rol']['id']
		));
		echo $this->Form->submit('Guardar Cambios',array('class' => 'boton'));
	} 
?>
</div>