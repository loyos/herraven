<div class="wrap_contenido">
	<div class = "login">
		<?php
			echo $this->Session->flash('auth');
			echo $this->Form->create('User');
			echo '<table><tr><td>';
			echo 'Nombre de Usuario:';
			echo '</td><td>';
			echo $this->Form->input('username',array(
				'label' => false
			));
			// echo '</td>';
			// echo 'ò';
			// echo '</td>';
			// echo '</tr><tr><td>';
			// echo 'Email asociado:</td><td>';
			// echo $this->Form->input('email',array(
				// 'label' => false
			// ));
			echo '</td></tr></table>';
			echo '<br>';
			echo "<div style= 'text-align: center; width: 200px;'>";
				echo $this->Form->submit('Entrar', array('class' => 'tile-button'));
				echo $this->Form->end;
			echo "</div>";
		?>
	</div>
</div>