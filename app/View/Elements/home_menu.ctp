<div class = "main_menu">
<ul>
		<li>
			<?php
				if($this->action == 'index'){ $selected = 'selected'; }else { $selected = 'no_selected';}
				echo $this->Html->link('home',array('controller' => 'home','action'=>'index'), array('class' => $selected));
			?>
		</li>
	<?php
		foreach($menu as $m){
		if($m['Contenido']['alias'] == 'home'){
		
		}else if($m['Contenido']['ubicacion'] != 'abajo') {
	?>	
		<li>
			<?php
				$selected = 'no_selected';
				if(!empty($this->params['pass']['0'])){
					if($this->params['pass']['0'] == $m['Contenido']['id']) { $selected =  'selected'; } else { $selected = 'no_selected'; }
				}
				echo $this->Html->link($m['Contenido']['alias'],array('controller' => 'home','action'=>'contenido', $m['Contenido']['id']), array('class' => $selected));
			?>
		</li>
	<?php }} ?>
	</ul>
</div> 

