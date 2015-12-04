<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar',$subcategoria_id),array('class'=>'boton'));
?>
<h1>Artículos</h1>
<?php 
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Foto</th>	
		<th>Código</th>
		<th>Descripcion</th>
		<th>Materia Prima Asociada</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($articulos as $c) {
			echo '<tr>';
			echo '<td>'.$this->Html->link($this->Html->image('articulosProduccion/'.$c['Articulosproduccion']['imagen'], array("width" => "100px",'class'=>'prim','data-fancybox-group' => '1')), "../img/articulosProduccion/".$c['Articulosproduccion']['imagen'], array('escape' => false, 'class'=>"fancybox primera",'data-fancybox-group' => '1',)). '</td>';
			echo '<td>'.$c['Articulosproduccion']['codigo'].'</td>';
			echo '<td>'.$c['Articulosproduccion']['descripcion'].'</td>';
			echo '<td>'.$c['Materiasprimasproduccion']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Articulosproduccion']['id'],$subcategoria_id),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay artículos</h3>';
	}
?>
</div>
<script>
$(document).ready(function() {
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	var is_firefox = navigator.userAgent.indexOf("Firefox") != -1;
	
	$('.fancybox').fancybox();
	
	$('.fotos a').mouseenter(function() {
		$(this).find('.prim').css('opacity','0.5');
		if (is_chrome) {
			// $(this).append('<?php echo $this->Html->image('icon_zoom.png',array('class'=>'zoom','style' => "position:absolute;",'width'=>'50px','height'=>'50px'))?>');
				} else 
			if(is_firefox) {
				// $(this).append('<img src="img/icon_zoom.png" alt="" width="50px" height="50px" class = "zoom" style= "position:absolute;margin-top:70px; margin-left:-120px;"/>');
			}
	});
	$('a.primera').mouseleave(function() {
		$(this).find('.prim').css('opacity','1');
		//$('.zoom').remove();
	});



});
</script>