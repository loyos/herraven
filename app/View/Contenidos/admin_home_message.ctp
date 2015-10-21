<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
	});
</script>

<div class="wrap">
	<?php
		echo $this->Form->create('Config');
			
		echo 'Home message:<br>';
		
		echo $this->Form->input('home_message',array(
			'label' => false
		));
		
		echo '<br>El titulo tiene que ir con el formato Heading 2 (MUY IMPORTANTE), el resto del texto en paragraph <br><br>';

		echo $this->Form->submit('Change Message', array('class' => 'button'));
		echo $this->Form->end;
	?>
</div>