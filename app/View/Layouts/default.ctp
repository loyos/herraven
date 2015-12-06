<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>

<script>

  </script>

	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'Intranet Herraven'; ?>
	</title>
	<link href='http://fonts.googleapis.com/css?family=Kameron' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
	<?php	
	echo $this->Html->meta('icon');
	echo $this->Html->meta('icon', $this->Html->url('/favicon.png'));
	echo $this->Html->css('style');
	echo $this->Html->css('style_menu');
	echo $this->Html->css('fancybox/jquery.fancybox');
	//echo $this->Html->css('fancybox/jquery.fancybox-buttons');
	//echo $this->Html->css('fancybox/jquery.fancybox-thumbs');
	//echo $this->Html->css('bootstrap/css/bootstrap');
	echo $this->Html->script('jquery-2.0.2.min');
	echo $this->Html->script('menu_jquery');
	echo $this->Html->script('fancybox/jquery.fancybox');	
	//echo $this->Html->script('bootstrap/js/bootstrap');	
	echo $this->Html->script('fancybox/jquery.fancybox');	
	echo $this->Html->script('jquery-ui-1.10.3.custom.min');
	echo $this->Html->script('tiny_mce');
	echo $this->Html->script('datatable/jquery.dataTables.min.js');
	// echo $this->Html->script('datatable/dataTables.jqueryui.min.js');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
	
	<script>
		
		 // $(document).tooltip();

	$(function() {
		$('.logout, .user-header').tooltip({
		  position: {
			my: "center bottom+80",
			at: "center top",
			using: function( position, feedback ) {
			  $( this ).css( position );
			  $( "<div>" )
			}
		  }
		});
	});
	
	</script>
	
	<style>
 
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 10px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    // text-transform: uppercase;
    box-shadow: 0 0 7px black;
	background: #515669;
  }
  </style>
</head>
<body>
	<div class="header">
		<div class = "title">
			
		</div>
		
		<div class = "header_right">
			<div class = 'user-header'>
				<?php 
					echo $username;
					// echo ' Director Ejecutivo';
					// echo $this->Html->image('close.png', array('width' => '30px', 'titsle' => 'Cerrar Sesión'));
				?>
			</div>
			<ul>
					<li>
						<?php echo $this->Html->link('Mi Perfil', array('controller' => 'users', 'action' => 'index'), array('tistle' => 'Ver Perfil de Usuario'));  ?>
					</li>
					<li>
						<?php echo $this->Html->link('Cerrar Sesión', array('controller' => 'users', 'action' => 'logout'), array('tistle' => 'Ver Perfil de Usuario'));  ?>
					</li>
				</ul>
		</div>
	</div>
	
	<!--<div class = "menu_container">
		<?php // echo $this->element('menu_viejo'); ?>
		
	</div> -->
	
	<div id="container" class = "container_interno">
		
		<div id="content">
			<?php echo $this->element('menu'); ?>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		
	</div>
	<?php // echo $this->element('sql_dump'); ?>
	<div id="footer" class = "footer_interno">
		<div class = "footer_interno_content">
			© Herrajes y Accesorios Herraven s.a. Todos los derechos reservados. RIF J-30800588-6
 		</div>
	</div>
</body>
</html>
<script>
$(document).ready(function() {
	$('#flashMessage').delay(2000).fadeOut(2000);
 });
 
 // var content_height = $('#content').css('height');
	// content_height = content_height.replace('px','');
	// console.debug(parseInt(content_height)+1);
	// if(content_height < 600){
		// console.debug('pass');
		// $('.footer_interno').css('position', 'relative');
		// $('.footer_interno').css('padding-bottom', '20px');
	// }
	
	var wrap_height = $('.wrap').css('height');
	console.debug(wrap_height);
	$('#cssmenu').css('height', wrap_height);
</script>