<div class="wrap">
<?php 
echo '<div style="float:left">';
echo $this->Html->link('Regresar',array('action' => 'admin_forecast',$cat_id,$sub_id),array('class'=>'boton'));
echo '</div>';
echo '<br>';
echo '<div style="float:right">';
echo $this->Form->button('Ver reporte',array('onclick' => 'window.print()', 'class' => 'boton_accion','layout' => 'sin_menu'));
echo '</div>';
echo '<h1>Forecast</h1>';
if (!empty($articulos_mp)) {
		foreach ($articulos_mp as $a_mp) {
			?>
			<table class="tabla_index">
				<tr>
					<th>Artículo</th>
					<?php
					if (!empty($a_mp[0]['acabado'])) {
						echo '<th>Acabado</th>';
					}
					?>
					<th>Número de cajas</th>
					<th>Pza. por caja</th>
					<th>Total de pzas.</th>
				</tr>
				<tr>
					<td><?php echo $a_mp[0]['Articulo']?></td>
					<?php
					if (!empty($a_mp[0]['acabado'])) {
						echo '<td>'.$a_mp[0]['acabado'].'</td>';
					}
					?>
					<td><?php echo $a_mp[0]['cajas'] ?></td>
					<td><?php echo $a_mp[0]['piezas'] ?></td>
					<td><?php echo $a_mp[0]['piezas']*$a_mp[0]['cajas'] ?></td>
				</tr>
			</table>
			<table class="tabla_index" >
			<?php
			//tabla_index_sin_width ?>
			<tr>
				<th>Materia prima</th>
				<th>Unidad</th>
				<th>Cantidad</th>
			</tr>
			<?php
			foreach ($a_mp as $a) {
				?>
				<tr>
					<td><?php echo $a['Materiasprima'] ?></td>
					<td><?php echo $a['unidad'] ?></td>
					<td><?php echo number_format($a['cantidad'],2,',','.')?></td>
				</tr>
				<?php
			}
			?>
			</table>
			<br><br>
			<?php
		}
	}
?>
</div>
<script>
  function imprimir() {
  window.print()
});
</script>