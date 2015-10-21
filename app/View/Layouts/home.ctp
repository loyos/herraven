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

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'Herraven'; ?>
		<?php // echo $title_for_layout; // de donde viene esto? ?>
	</title>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->meta('icon', $this->Html->url('/favicon.png'));
	echo $this->Html->css('style');
	echo $this->Html->css('bjqs');
	echo $this->Html->css('demo');
	echo $this->Html->css('fancybox/jquery.fancybox');
	echo $this->Html->css('fancybox/jquery.fancybox-buttons');
	echo $this->Html->css('fancybox/jquery.fancybox-thumbs');
	echo $this->Html->script('jquery-2.0.2.min');
	echo $this->Html->script('fancybox/jquery.fancybox');	
	echo $this->Html->script('fancybox/jquery.fancybox-buttons');	
	echo $this->Html->script('fancybox/jquery.fancybox-thumbs');	
	echo $this->Html->script('fancybox/jquery.fancybox-media');	
	echo $this->Html->script('fancybox/jquery.mousewheel-3.0.6.pack');
	echo $this->Html->script('bjqs-1.3.min');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>		

	<?php if($this->action == 'index'){ $css = 'home_body'; $position = 'absolute'; }else{ $css = 'cover-image'; $position = 'relative'; }  ?>
	<?php if($this->action == 'login' || $this->action == 'reset_password' ){ $position = 'absolute';}  ?>
	
	
	<div id="container" class = "<?php echo $css;?>">
		<div class = "main_header">
			<div class = "home_menu">
				<?php echo $this->Html->link($this->Html->image('logo.png', array('width' => '250px', 'height' => 'auto')),array('controller'=> 'users', 'action'=> 'login'),
				array('escape' => false,
					'class' => 'logo_home'
					)); ?>
				<?php echo $this->element('home_menu'); ?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id = "footer">
			<div class="home_footer">
				<?php echo $this->element('footer_menu'); ?>
				<div class = "footer_content">
				<div>&copy;2015 Todos los derechos reservados 
				 Herrajes y accesorios Herraven S.A. RIf: J-30800588-6</div>
				</div>
				<?php echo $this->element('social_network'); ?>
			</div>
		</div>
	</div>
	
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
<script>
$(document).ready(function() {
	$('#flashMessage').delay(2000).fadeOut(2000);
	
	// $('#footer').css('position', '<?php echo $position; ?>');
	
	// console.debug($('#content').css('height'));
	var content_height = $('#content').css('height');
	content_height = content_height.replace('px','');
	console.debug(parseInt(content_height)+1);
	
	if(content_height < 500 && $(window).height() > 800 ){
		console.debug('pass');
		$('#footer').css('position', 'absolute');
	}else{
		$('#footer').css('position', 'relative');
	}
	
	window.onresize = function(event) {
		if(content_height < 500 && $(window).height() > 800 ){
			$('#footer').css('position', 'absolute');
		}else{
			$('#footer').css('position', 'relative');
		}
	};
	
 });
	
</script>