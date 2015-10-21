<div class="wrapper">
	<span>
		<?php echo $config['Config']['home_message']; ?>
	</span>
	<div class = "contactanos_boton">
		<?php
		if(!empty($contacto)){ $contacto_id = $contacto['Contenido']['id']; }else{ $contacto_id = '1'; }
		echo $this->Html->link('Contáctanos', array('controller' => 'home', 'action' => 'contenido', $contacto_id ), array('class' => 'tile-button'));
		?>
	</div>
</div>
<div class = "chiclet">
</div>