<div class="wrap">
	<?php
	$count = 1;
	foreach ($cajas as $a) {
		if ($count%5==0 ){
			echo '<div class="etiqueta" style="clear:left; margin-top:110px; font-family: Kameron, sans-serif; border:1px solid black;">';
		} else {
			echo '<div class="etiqueta" style="clear:left;  margin-top:25px; font-family: Kameron, sans-serif; border:1px solid black;">';
		}
		if ($count==5){
			$count = 0;
		}
		?>
		<table style="width:100%; height:165px; margin-left:10px; margin-right:10px; margin-top:3px; margin-bottom:3px;">
			<tr>
				<td style="width:200px">
				<?php
				echo '<img src="http://web.herraven.com/img/articulos/'.$a['Inventarioalmacen']['Articulo']['imagen'].'" width="100px" height="100px">';
				?>
				</td>
				<td style="text-align:right">
				<?php
				echo '<div class="codigo_caja" style="font-size:27px;">';
				echo $a['Caja']['codigo'];
				echo '</div>';
				echo $a['Inventarioalmacen']['fecha'];
				?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
					echo '<div class="codigo_caja" style="font-size:27px;">';
					echo $a['Inventarioalmacen']['Articulo']['codigo'];
					echo '<br>';
					if (!empty($a['Inventarioalmacen']['Acabado']['acabado'])){
						echo $a['Inventarioalmacen']['Acabado']['acabado'];
					} else {
						echo 'Sin Acabado';
					}
					echo '</div>';
					?>
				</td>
				<td  style="text-align:right">
					<?php 
					echo '<div class="codigo_caja" style="font-size:27px;">';
					echo $a['Inventarioalmacen']['Articulo']['cantidad_por_caja'].'Pz.';
					echo '</div>';
					?>
				</td>
			</tr>
		</table>
		<?php
		echo '</div>';
		$count++;
	}
	?>
</div>
