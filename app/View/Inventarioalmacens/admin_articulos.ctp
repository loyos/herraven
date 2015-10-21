<div class="wrap ingresos">
	<?php
	if (!empty($articulos)) {
		echo '<table style="margin-left:35px;"  cellspacing="20px">';
		$i = 1;
		foreach ($articulos as $a) {
			if ($i ==1 || ($i-1)%2 == 0 ){
				echo '<tr>';
			}
		?>
		<td class= "polaroid" style="width:380px;">
			<table>
				<tr>
					<td class="fotos"><?php echo $this->Html->image('articulos/'.$a['Articulo']['imagen'],array('width' => '150px', 'height' => '150px')); ?></td>
					<td style="text-align:center">
						<span style="font-weight:bold"><?php echo $a['Articulo']['codigo']; ?></span>
						<br>
						<?php echo $a['Articulo']['cantidad_por_caja'].' pz'; ?>
						<br>
						<div class="boton_ingreso">
						<?php echo $this->Html->link('Ingreso',array('action' => 'admin_ingresar',$a['Articulo']['id']),array('class'=>'boton_busqueda'));?>
						</div>
					</td>
				</tr>
			</table>
		</td>
		<?php	
			if ($i%2 == 0 ){
				echo '</tr>';
			}
			$i++;
		}
		echo '</table>';
	} else {
		echo '<div class="mensaje_vacio">';
		echo 'No hay articulos asociados a esta subcategoria';
		echo '</div>';
	}
	?>
</div>