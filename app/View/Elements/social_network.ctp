<div class = "social_network">
	<?php

	echo $this->Html->link(
		$this->Html->image('icon-twitter.png'), $config['Config']['twitter'], array('escape' => false, 'target' => '_blank')
	);
	echo $this->Html->link(
		$this->Html->image('icon-vimeo.png'), $config['Config']['vimeo'], array('escape' => false, 'target' => '_blank')
	);
	echo $this->Html->link(
		$this->Html->image('icon-instagram.png'), $config['Config']['instagram'], array('escape' => false, 'target' => '_blank')
	);
					
	?>
</div>