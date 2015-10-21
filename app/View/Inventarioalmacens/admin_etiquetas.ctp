<div class="wrap">
	<?php
	echo '<div style="float:left">';
	echo $this->Html->link('Ver Nota de Ingreso',array('action' => 'admin_nota_entrada',$id_inventario),array('target' =>'_blank','class'=>'boton'));
	echo '<br><br>';
	//echo $this->Html->link($this->Html->image('imprimir.jpg'),array(''.$id_inventario), array('onclick' => 'window.print()', 'escape' => false));
	echo $this->Html->link($this->Html->image('imprimir.jpg'),array('action' => 'admin_etiquetas',$id_inventario,'ext' => 'pdf'),array('target'=>'_blank','escape' => false));
	echo '</div>';
	echo '<div style="text-align:right">';
	echo $this->Html->link('Finalizar ingreso',array('action' => 'admin_agregar'),array('class'=>'boton'));
	echo '</div>';
	$count = 1;
	foreach ($cajas as $a) {
		if ($count%10==0 || $count%9==0){
			echo '<div class="etiqueta" style="clear:left">';
		} else {
			echo '<div class="etiqueta" style="clear:left">';
		}
		if ($count==10){
			$count = 2;
		}
		?>
		<table style="width:100%; height:165px;">
			<tr>
				<td style="width:200px"><?php echo $this->Html->image('articulos/'.$a['Inventarioalmacen']['Articulo']['imagen'], array('width' => '100px','height' => '100px'))?></td>
				<td style="text-align:right">
				<?php
				echo '<div class="codigo_caja">';
				echo $a['Caja']['codigo'];
				echo '</div>';
				echo $a['Inventarioalmacen']['fecha'];
				?>
				</td>
			</tr>
			<tr>
				<td>
					<?php
					echo '<div class="codigo_caja">';
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
					echo '<div class="codigo_caja">';
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
<script>
  function imprimir() {
	alert("fd");
  window.print()
});
</script>