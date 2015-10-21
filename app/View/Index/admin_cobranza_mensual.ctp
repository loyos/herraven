<div class="wrap">
	<?php echo $this->Html->link('Regresar',array('action' => 'admin_reportes_mensuales'),array('class'=>'boton')); ?>
	<h1>Cobranza mensual</h1>
	
	<div id="linewrapper" style="display: block; float: left; width:90%; margin-left: 150px; text-align:center"></div>
    <div class="clear"></div>	
	
	<?php echo $this->HighCharts->render('Line Chart with Data Labels'); ?>

</div>