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
	<?php echo $this->Html->script('jquery-2.0.3'); ?>
	<?php echo $this->Html->script('json2'); ?>
	<?php echo $this->Html->script('underscore'); ?>
	<?php echo $this->Html->script('backbone'); ?>
	<?php echo $this->Html->script('backbone.marionette'); ?>
	
	<?php echo $this->Html->script('FormView'); ?>

	<?php echo $this->Html->script('bootstrap'); ?>
	<?php echo $this->Html->script('backbone-validation'); ?>
	<?php echo $this->Html->script('jsFormy'); ?>
	<?php echo $this->Html->script('JSerialize'); ?>
	<?php echo $this->Html->script('jquery.dateFormat-1.0'); ?>
	
	<?php echo $this->Html->script('moment-2.4.0'); ?>
	
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
