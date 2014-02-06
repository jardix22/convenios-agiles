<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Convenios Ágiles</title>
	<?php echo $this->Html->css('master.login'); ?>

</head>
<body>
	<div id="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
		
	<!-- Thirt-Party Libraries (Order matters) -->
	<?php 
		echo $this->Html->script('jquery-2.1.0.min');
		echo $this->Html->script('json2');
		echo $this->Html->script('underscore-min');
		echo $this->Html->script('backbone-min');
		echo $this->Html->script('backbone-validation-min');
		echo $this->Html->script('backbone.marionette.min');

		echo $this->Html->script('bootstrap.js');
		echo $this->Html->script('jsFormy.js');
		echo $this->Html->script('JSerialize.js');
		

		echo $this->Html->script('../assets/login/app');
		echo $this->Html->script('../assets/login/authenticationModule'); 
	?>
	<script type="text/javascript">
		App.start();
	</script>
</body>
</html>
