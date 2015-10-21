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
	<?php echo $this->Html->charset(); ?>
	<title>
		
	</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('style');
	echo $this->Html->css('fancybox/jquery.fancybox');
	echo $this->Html->css('fancybox/jquery.fancybox-buttons');
	echo $this->Html->css('fancybox/jquery.fancybox-thumbs');
	echo $this->Html->script('jquery-2.0.2.min');
	echo $this->Html->script('fancybox/jquery.fancybox');	
	echo $this->Html->script('fancybox/jquery.fancybox-buttons');	
	echo $this->Html->script('fancybox/jquery.fancybox-thumbs');	
	echo $this->Html->script('fancybox/jquery.fancybox-media');	
	echo $this->Html->script('fancybox/jquery.mousewheel-3.0.6.pack');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>

	<div id="container">
		
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
<script>
$(document).ready(function() {
	$('#flashMessage').delay(2000).fadeOut(2000);
 });
	
</script>