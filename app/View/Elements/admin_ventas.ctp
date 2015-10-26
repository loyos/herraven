<div class="derecha">
<table>
	<tr>
		<th style="border-bottom:2px solid black; padding: 5px;">Ventas Acumuladas</th>
		<th style="border-bottom:2px solid black; padding: 5px;">A&ntilde;o</th>
	</tr>
	<tr>
		<td style="text-align:center; padding: 5px;"><?php echo $this->Herra->format_number($total_ventas).' Bs'?></td>
		<td style="text-align:center; padding: 5px;"><?php echo $ano?></td>
	</tr>
</table>
</div>
<h2>Ventas</h2>
<?php if (!empty($ventas)) { 
	foreach ($ventas as $k=>$venta) {?>
		<table width='30%'>
		<tr>
		<th style="border-bottom:2px solid black; padding: 5px;">Semana</th>
		</tr>
		<tr>
		<td style="text-align:center; padding: 5px;"><?php echo $k ?></td>
		</tr>
		</table>
		<table>
		<tr>
		<th style="border-bottom:2px solid black; padding: 5px;">Fecha</th>
		<th style="border-bottom:2px solid black; padding: 5px;">Cliente</th>
		<th style="border-bottom:2px solid black; padding: 5px;">Factura</th>
		<th style="border-bottom:2px solid black; padding: 5px;">Monto</th>
		</tr>
		<?php
		$sum_semana = 0;
		foreach ($venta as $v) { 
		$sum_semana = $sum_semana+$v['Pedido']['cuenta'];
		?>
		<tr>
		<td style="text-align:center; padding: 5px;"><?php echo $v['Pedido']['fecha'] ?></td>
		<td style="text-align:center; padding: 5px;"><?php echo $v['Cliente']['denominacion_legal'] ?></td>
		<td style="text-align:center; padding: 5px;"><?php echo $v['Pedido']['factura'] ?></td>
		<td style="text-align:center; padding: 5px;"><?php echo $this->Herra->format_number($v['Pedido']['cuenta']).' Bs'?></td>
		</tr>
		<?php
		}
		?>
		</table>
		<br>
		<table>
		<tr>
		<th style="border-bottom:2px solid black; padding: 5px;">Total Semana</th>
		<th style="border-bottom:2px solid black; padding: 5px;">Ventas mensuales</th>
		<th style="border-bottom:2px solid black; padding: 5px;">Mes</th>
		</tr>
		<?php 
		$i = 1;
		foreach ($sum[$k] as $m => $s) { ?>
		<tr>
		<td style="text-align:center; padding: 5px;"><?php  if($i==1) {echo $this->Herra->format_number($sum_semana).' Bs'; }?></td>
		<td style="text-align:center; padding: 5px;"><?php echo $this->Herra->format_number($s).' Bs'?></td>
		<td style="text-align:center; padding: 5px;"><?php echo $m ?></td>
		</tr>
		<?php
		$i++;
		} ?>
		</table>
		<br>
		<br>
		<?php
	}
}
	?>