<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>App::Agreements</title>
	<?php echo $this->Html->css('master.login'); ?>
	<?php echo $this->Html->css('bootstrap-datetimepicker.min'); ?>

	<style type="text/Ass">
		.modal-dialog {
			width: 990px !important;
		}
	</style>
</head>
<body>
	
	<?php echo $this->fetch('content'); ?>
		
	<!-- Thirt-Party Libraries (Order matters) -->
	<?php echo $this->Html->script('jquery-2.1.0.min'); ?>
	<?php echo $this->Html->script('json2'); ?>
	<?php echo $this->Html->script('underscore-min'); ?>
	<?php echo $this->Html->script('backbone-min'); ?>
	<?php echo $this->Html->script('backbone-validation-min'); ?>
	<?php echo $this->Html->script('backbone.marionette.min'); ?>

	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->Html->script('jsFormy'); ?>
	<?php echo $this->Html->script('JSerialize'); ?>
	
	<?php echo $this->Html->script('moment.min'); ?>
	
	<?php echo $this->Html->script('bootstrap-datetimepicker'); ?>
	<?php echo $this->Html->script('locales/bootstrap-datetimepicker.es'); ?>
		
	<?php echo $this->Html->script('../assets/agreement/app'); ?>
	<?php echo $this->Html->script('../assets/agreement/App.Agreements'); ?>
	<?php echo $this->Html->script("../assets/agreement/searchModule"); ?>
	<?php echo $this->Html->script("../assets/agreement/registerModule"); ?>
	<?php echo $this->Html->script('../assets/agreement/authenticationModule'); ?>
	

	<script type="text/javascript">
		App.start();
	</script>
</body>
</html>
