<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login > Agreements</title>
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
	<?php echo $this->Html->script('jquery-2.0.3.js'); ?>
	<?php echo $this->Html->script('json2.js'); ?>
	<?php echo $this->Html->script('underscore.js'); ?>
	<?php echo $this->Html->script('backbone.js'); ?>
	<?php echo $this->Html->script('backbone.marionette.js'); ?>

	<?php echo $this->Html->script('bootstrap.js'); ?>
	<?php echo $this->Html->script('backbone-validation.js'); ?>
	<?php echo $this->Html->script('jsFormy.js'); ?>
	<?php echo $this->Html->script('JSerialize.js'); ?>
		

	<?php echo $this->Html->script('../assets/login/app'); ?>
	<?php echo $this->Html->script('../assets/login/authenticationModule'); ?>
	<script type="text/javascript">
		App.start();
	</script>
</body>
</html>
