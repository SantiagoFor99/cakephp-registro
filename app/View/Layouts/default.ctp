<style media="screen">
.wrapper.wrapper-content {
	padding: 10px !important;
}
.ibox {
	margin-bottom: 10px !important;
}

.ibox-title {
	padding: 7px 15px 7px !important;
}
</style>

<?php

$var_sesion=0;
if ($usuario_iniciado) {
	$controlador_login='logout';
	$icono_login='<i class="fa fa-sign-out"></i>Cerrar Sesión';
}
if ($usuario_iniciado['role']=="admin") {
	$var_sesion=1;
	$controlador_login='logout';
	$icono_login='<i class="fa fa-sign-out"></i>Cerrar Sesión';
}

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
	echo $this->Html->script('/spin/js/plugins/metisMenu/jquery.metisMenu.js');
	echo $this->Html->script('/spin/js/plugins/slimscroll/jquery.slimscroll.min.js');
	echo $this->Html->script('/spin/js/plugins/iCheck/icheck.min.js');
	//se traen los archivos js para el input del serial
	echo $this->Html->script('/scan/jquery.scannerdetection.js');

	echo $this->Html->css('/spin/css/bootstrap.min.css');
	echo $this->Html->css('/spin/font-awesome/css/font-awesome.css');
	echo $this->Html->css('/spin/css/animate.css');
	echo $this->Html->css('/spin/css/style.css');
	echo $this->Html->css('/spin/css/plugins/iCheck/custom.css');

	//echo $this->Html->css('cake.generic');

	echo $this->Html->script('moment.js');

	// echo $this->Html->script('/spin/js/inspinia.js');
	// echo $this->Html->script('/spin/js/plugins/pace/pace.min.js');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>


<body class="top-navigation">

	<div id="wrapper">
		<div id="page-wrapper" class="gray-bg">

			<div class="row border-bottom white-bg">
				<nav class="navbar navbar-static-top" role="navigation">
					<div class="navbar-header">
						<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
							<i class="fa fa-reorder"></i>
						</button>
						<a href="#" class="navbar-brand">Minuta</a>
					</div>
					<div class="navbar-collapse collapse" id="navbar">
						<ul class="nav navbar-nav">
							<!--<li> </li>-->
							<li>
								<?php echo $this->Html->link('Ingreso y Salida',array('controller' => 'movimientos','action'=>'index' )); ?>
							</li>
							<li>
								<?php echo $this->Html->link('Consultas',array('controller' => 'movimientos','action'=>'consulta' )); ?>
							</li>
							<?php if ($var_sesion==1):

								?>
								<li class="dropdown">
									<a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Administrar <span class="caret"></span></a>
									<ul role="menu" class="dropdown-menu">
										<li>
											<?php echo $this->Html->link('Responsables',array('controller' => 'movimientos','action'=>'listado_editar_responsable'), array('escape' => false)); ?>
										</li>
										<li>
											<?php echo $this->Html->link('Equipos',array('controller' => 'movimientos','action'=>'listado_editar_equipo'), array('escape' => false)); ?>
										</li>
										<li>
											<?php echo $this->Html->link('Usuarios',array('controller' => 'users','action'=>'listado_editar_usuario'), array('escape' => false)); ?>
										</li>
									</ul>
								</li>
								<li>
									<?php echo $this->Html->link('<i class="fa fa-download"></i>Generar registro',array('controller' => 'movimientos','action'=>'registro'), array('escape' => false)); ?>
								</li>
							<?php endif; ?>
							<!--
							<li class="dropdown">
							<a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
							<ul role="menu" class="dropdown-menu">
							<li><a href="">Menu item</a></li>
							<li><a href="">Menu item</a></li>
							<li><a href="">Menu item</a></li>
							<li><a href="">Menu item</a></li>
						</ul>
					</li>
					<li class="dropdown">
					<a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
					<li><a href="">Menu item</a></li>
					<li><a href="">Menu item</a></li>
					<li><a href="">Menu item</a></li>
					<li><a href="">Menu item</a></li>
				</ul>
			</li>
			<li class="dropdown">
			<a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
			<ul role="menu" class="dropdown-menu">
			<li><a href="">Menu item</a></li>
			<li><a href="">Menu item</a></li>
			<li><a href="">Menu item</a></li>
			<li><a href="">Menu item</a></li>
		</ul>
	</li>
-->
</ul>
<ul class="nav navbar-top-links navbar-right">
	<li>
		<?php echo $this->Html->link($icono_login,array('controller' => 'users','action'=>$controlador_login), array('escape' => false)); ?>
	</li>
</ul>
<ul class="nav navbar-top-links navbar-right">
	<li>
		<?php echo $this->Html->link('<i class="fa fa-user-circle"></i>Hola '.$usuario_iniciado['username'],'#', array('escape' => false)); ?>
	</li>
</ul>
</div>
</nav>
</div>


<div class="wrapper wrapper-content">
	<div class="container">

		<?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>

</div>
<div class="footer">
	<div>
		<strong></strong> Ezentis Colombia &copy; 2017
	</div>
</div>

</div>
</div>


</body>

<?php //echo $this->element('sql_dump'); ?>

</html>
