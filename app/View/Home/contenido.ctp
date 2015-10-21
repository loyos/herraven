<div class = "wrap_contenido">
	<div class = "wrap_titulo">
		<?php
			echo $contenido['Contenido']['titulo'];
			if(!empty($contenido['Contenido']['video'])){
				$link = explode( '/', $contenido['Contenido']['video'] );
				$codigo_video = end($link);
			}
		?>
	</div>
	<?php if(!empty($contenido['Contenido']['video']) || !empty($imagenes[0]['Imagen']['imagen'])) { ?>
		<div class = "media">
			<?php
				if(!empty($contenido['Contenido']['video'])){
					?>
						<iframe src="//player.vimeo.com/video/<?php echo $codigo_video;?>" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					<?php
				}else{
					if(!empty($imagenes[0]['Imagen']['imagen'])){
						echo $this->Html->image('contenido/'.$imagenes[0]['Imagen']['imagen']);
					}
				}
			?>
		</div>
	<?php } ?>
	<div class = "contenido">
		<?php echo $contenido['Contenido']['contenido']; ?>
	</div>
</div>

<script>

	
	
</script>