<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index',$subcategoria_id),array('class'=>'boton','style' => 'margin-right:5px'));
echo $this->Html->link('Editar',array('action' => 'admin_editar',$subcategoria_id,$articulo['Articulosproduccion']['id']),array('class'=>'boton','style' => array('margin-right' => '5px')));
echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$subcategoria_id,$articulo['Articulosproduccion']['id']),array('class'=>'boton'),'¿Estás seguro que deseas eliminar?');
?>
<h1>Artículo</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Imagen</th>';
	echo '<td>';
	echo $this->Html->link(
			$this->Html->image('articulosProduccion/'.$articulo['Articulosproduccion']['imagen'], array("width" => "100px",'class'=>'prim','data-fancybox-group' => '1')),
			"../img/articulosProduccion/".$articulo['Articulosproduccion']['imagen'],
			array('escape' => false, 'class'=>"fancybox primera",'data-fancybox-group' => '1',)
	);
	
	if(!empty($articulo['Articulosproduccion']['imagen1'])) { 
		echo $this->Html->link(
			$this->Html->image('articulosProduccion/'.$articulo['Articulosproduccion']['imagen1'], array('style'=>'display:none')),
			"../img/articulosProduccion/".$articulo['Articulosproduccion']['imagen1'],
			array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => '1',)
		);?>

		<?php
	}
	if(!empty($articulo['Articulosproduccion']['imagen2'])) { 
		echo $this->Html->link(
			$this->Html->image('articulosProduccion/'.$articulo['Articulosproduccion']['imagen2'], array('style'=>'display:none')),
			"../img/articulosProduccion/".$articulo['Articulosproduccion']['imagen2'],
			array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => '1',)
		);?>

		<?php
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Articulo</th>';
	echo '<td>';
	echo $articulo['Articulosproduccion']['codigo'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Descripción</th>';
	echo '<td>';
	echo $articulo['Articulosproduccion']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Materia prima asociada</th>';
	echo '<td>';
	echo $articulo['Materiasprimasproduccion']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Cantidad de materia prima por artículo</th>';
	echo '<td>';
	echo $articulo['Articulosproduccion']['cantidad'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
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
	});});
</script>