<style type="text/css">
		.bannner{
			text-align: center;
		}
		.banner-image{
			display: block;
			text-align: center;
			background-color: transparent;
		}	

		.banner-text{
			display: block;
			text-align: center;
			font-size: 2em;
			text-shadow: 1px 1px 1px #ccc;
			/*border: 1px solid #222;*/
		}

		.banner-tip{
			color: #888;
			font-weight: normal;
			font-size: 1.1em;
			margin-top: 10px;
			margin-bottom: 0px;
			text-align: center;
			display: block;
		}
</style>


<div class="container">
	<div class="row" id="main"></div>
</div>


<script type="text/template" id="login-template">
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

		<div class="banner">
			<span class="banner-text">Convenios Ágiles</span>
			<label class="banner-tip"> Iniciar sesión para acceder a la aplicación </label>
			<div class="banner-image">
					<img src="images/documents-1.png" width="60%">
			</div>			
		</div>

		<form role="form">
			<fieldset>
				<p class="error" id="error" style="display: none;"></p>
				<div class="form-group">
					<input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
				</div>

				<div class="checkbox">
					<label>
						<input type="checkbox"> No cerrar Sesión
					</label>
				</div>
				
				<button type="submit" class="btn btn-default btn-primary" style="width: 100%;" id="loginButton">Iniciar sesión</button>
			</fieldset>
		</form>
	</div>
</script>