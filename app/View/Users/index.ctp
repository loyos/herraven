<?php  //debug($usuario); ?>
<div class="wrap">
	<div class = "perfil">
			<div class = "username">
				Mi Perfil
			</div>
			<div class = "foto">
				<?php
					if(empty($usuario['User']['imagen'])){
						echo $this->Html->image('no_foto.jpg', array('width' => '120px;', 'height' => '100px;'));
					}else{
						echo $this->Html->image('users/'. $usuario['User']['imagen'], array('width' => '120px;', 'height' => '100px;'));
					} 
				?>
			</div>
			
			
		<div class = "perfil_abajo">
			<?php // echo $this->Herra->format_number(100); ?>
			<?php //debug($usuario);
				if($usuario['User']['rol'] != 'admin') {
			?>
				<table>
					<tr>
						<td>
							 Denominación Legal:
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo $usuario['Cliente']['denominacion_legal']; ?> </span>
						</td>
					</tr>
					<tr>
						<td>
							 RIF:
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo $usuario['Cliente']['rif']; ?> </span>
						</td>
					</tr>
					<tr>
						<td>
							 Representante:  
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo $usuario['Cliente']['representante']; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							 Ciudad: 
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo $usuario['Cliente']['ciudad']; ?> </span>
						</td>
					</tr>
					<tr>
						<td>
							Dirección:
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo $usuario['Cliente']['direccion']; ?></span> 
						</td>
					</tr>
					<tr>
						<td>
							Teléfonos: 
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo $usuario['Cliente']['telefono_uno'].' / '. $usuario['Cliente']['telefono_uno']; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							Email Representante: 
						</td>
					</tr>
					<tr>
						<td>
							<span><?php echo $usuario['Cliente']['email_representante']; ?></span>
						</td>
					</tr>
				</table>
			<?php
				}else{
					echo '<span> Email:  </span>' . $usuario['User']['email'];
				}
			?>
			
			<div class = "editar_perfil">
			<?php 		
				echo $this->Html->link('Editar',array('action' => 'editar',$usuario['User']['id']),array('class'=>'boton2'));
			?>
			</div>
				
		</div>
	</div>
</div>