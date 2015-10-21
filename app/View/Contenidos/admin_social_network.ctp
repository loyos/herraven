<div class="wrap">
	<?php
		
		echo '<br>En este espacio se podrán colocar los URL a los que redireccionaran cada uno de los íconos referentes a las redes sociales. <br><br>';
	
		echo $this->Form->create('Config');
					
		echo 'Twitter:';
		
		echo $this->Form->input('twitter',array(
			'label' => false
		));
		
		echo 'Vimeo';
		
		echo $this->Form->input('vimeo',array(
			'label' => false
		));
		
		echo 'Instagram';
		
		echo $this->Form->input('instagram',array(
			'label' => false
		));

		echo '<br>En el espacio correspondiente, colocar el link completo del perfil a donde se quiere acceder, ejemplo "https://twitter.com/Loyos" <br><br>';
		
		echo $this->Form->submit('Change URLs', array('class' => 'button'));
		echo $this->Form->end;
	?>
</div>