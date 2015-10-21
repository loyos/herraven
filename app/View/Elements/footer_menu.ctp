<div class = "footer_menu">
<ul>
	<?php foreach($menu as $m){ 
		if($m['Contenido']['alias'] == 'home'){
			?><!-- <li><?php 
			// echo $this->Html->link($m['Contenido']['alias'],array('controller' => 'home','action'=>'index'));
			?></li> -->
			<?php
		}else if($m['Contenido']['ubicacion'] == 'abajo') {
	?>
		<li>
			<?php echo $this->Html->link($m['Contenido']['alias'],array('controller' => 'home','action'=>'contenido', $m['Contenido']['id'])); ?>
		</li>
	<?php }
	}
	?>
	<!-- <li>
		<?php // echo $this->Html->link('Contacto',array('controller' => 'home','action'=>'contacto')); ?>
	</li> -->
	<!--<li>
		<?php  //echo $this->Html->link('Area Reservada',array('controller' => 'users','action'=>'login')); ?>
	</li> --> 
	
</ul>
</div>
<?php //debug($menu); ?>