<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar',$cat_id,'-1',$sub_id),array('class'=>'boton'));
?>
<h1>Artículos</h1>
<?php 
echo '<b>Linea</b>: '.$linea['Categoria']['descripcion'].'<br>';
if (!empty($subcategoria['Subcategoria']['descripcion'])){
	echo '<b>Categoria</b>: '.$subcategoria['Subcategoria']['descripcion'].'<br>';
}
echo '<br>';

	if (!empty($articulos)) {
		?>
		<table class="tabla_index" id="tabla_index">
		<thead>
			<tr>
				<th>Código</th>
				<th>Foto</th>
				<th>Descripci&oacute;n</th>
				<th>Costo de producci&oacute;n</th>
				<th>Puntos</th>
				<th>Acciones</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
		foreach($articulos as $c) {
			echo '<tr>';
			echo '<td>'.$c['Articulo']['codigo'].'</td>';
			echo '<td>'.$this->Html->link($this->Html->image('articulos/'.$c['Articulo']['imagen'], array("width" => "100px",'class'=>'prim','data-fancybox-group' => '1')), "../img/articulos/".$c['Articulo']['imagen'], array('escape' => false, 'class'=>"fancybox primera",'data-fancybox-group' => '1',)). '</td>';
			echo '<td>'.$c['Articulo']['descripcion'].'</td>';
			echo '<td>'.$c['Articulo']['costo_produccion'].'%</td>';
			echo '<td>'.$c['Articulo']['puntos'].'</td>';
			echo '<td>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Articulo']['id'],$cat_id,$sub_id),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
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

     $('#tabla_index').DataTable( {
        "paging":   false,	
        "info":     false,
        "bFilter": false
    } );
    


});

	
</script>
