<div id = "cssmenu">
	<ul>
		<?php
			$parametros = '';
			foreach($menu as $m){
				if (in_array($m['Modulo']['id'],$modulos_id)) {
					echo '<li class = "has-sub">';
						if(!empty($m['Modulo']['Submodulo'])){ // same selected menu, but for li's that don't have subs inside. 
							echo $this->Html->link($m['Modulo']['nombre'], array('controller' => $m['Modulo']['controlador'], 'action' => $m['Modulo']['accion']));
						}else{
							if(($m['Modulo']['accion'] == $this->action) && ($m['Modulo']['controlador'] == $this->params['controller'])){
								echo $this->Html->link($m['Modulo']['nombre'], array('controller' => $m['Modulo']['controlador'], 'action' => $m['Modulo']['accion']), array('class' => 'main_active chicleto'));
							}else{
								echo $this->Html->link($m['Modulo']['nombre'], array('controller' => $m['Modulo']['controlador'], 'action' => $m['Modulo']['accion']), array('class' => 'no-sub'));
							}
						}
						if(!empty($m['Modulo']['Submodulo'])){
							echo '<ul>';
								foreach($m['Modulo']['Submodulo'] as $sub){
									if (in_array($sub['Modulo']['id'],$submodulos_id)) {
										echo '<li>';
											echo '<span>';
												if(!empty($this->params['pass'])){  // mixing action with parameters (if they exists) to match field in database.
													foreach($this->params['pass'] as $p){
														$parametros = $parametros . '/' . $p; 
													}
												}
												if(($sub['Modulo']['accion'] == $this->action. $parametros) && ($sub['Modulo']['controlador'] == $this->params['controller'])){
													echo $this->Html->link($sub['Modulo']['nombre'], array('controller' => $sub['Modulo']['controlador'], 'action' => $sub['Modulo']['accion']), array('class' => 'sub_active'));
												}else{
													echo $this->Html->link($sub['Modulo']['nombre'], array('controller' => $sub['Modulo']['controlador'], 'action' => $sub['Modulo']['accion'] ));
												}
											echo '</span>';
											// little number right to pedidos and despachos
											if(($sub['Modulo']['accion'] == 'pedidos') && ($sub['Modulo']['controlador'] == 'users')){
												echo '<div class = "menu_added"> ('.count($pedidos_pendientes).')</div>';
											}
											if(($sub['Modulo']['accion'] == 'despachos') && ($sub['Modulo']['controlador'] == 'users')){
												echo '<div class = "menu_added"> ('.count($pedidos_despachado).')</div>';
											}
										echo '</li>';
									}
									$parametros = '';
								}
							echo '</ul>';
						}						
					echo '</li>';
				}
			}
		?>
	</ul>
</div>

<script>
	// solved beautifully for modules with children
	$('.sub_active').css('color', '#54939B');
	var li = $('.sub_active').closest( "ul" ).slideDown('normal');
	li.closest('li').addClass('active');
	
	// solved for modules without children
	// $('.main_active').closest('li').addClass('active');
</script>