
</style>
<?php
$cakeDescription = __d('cake_dev', 'Minuta ');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->script('/spin/js/jquery-3.1.1.min.js');
		echo $this->Html->script('/spin/js/bootstrap.min.js');

		echo $this->Html->css('/spin/css/bootstrap.min.css');
		echo $this->Html->css('/spin/font-awesome/css/font-awesome.css');
		echo $this->Html->css('/spin/css/animate.css');
		echo $this->Html->css('/spin/css/style.css');

		//echo $this->Html->css('cake.generic');

		echo $this->Html->script('moment.js');

		// echo $this->Html->script('/spin/js/inspinia.js');
		// echo $this->Html->script('/spin/js/plugins/pace/pace.min.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>


<body class="gray-bg">

        <?php echo $this->Flash->render(); ?>
        <?php echo $this->fetch('content'); ?>





    </body>

    <?php //echo $this->element('sql_dump'); ?>

    </html>
