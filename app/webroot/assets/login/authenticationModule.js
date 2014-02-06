var Authentication;

Authentication = App.module('Authentication');

App.module('Authentication', function (Authentication) {

	Authentication.addInitializer(function () {
		this.controller = new Authentication.Controller({ region: App.mainRegion });
		this.router = new Authentication.Router({ controller: this.controller });
	});

	Authentication.Controller = Backbone.Marionette.Controller.extend({
		initialize: function (options) {
			var self = this;

			this.region = options.region;
			this.loginView = options.loginView;

			App.vent.on('authenticate', function (data) {
				self.authenticate(data.username, data.password);
			});
		},
		authenticate: function (username, password ){
			var formValues = {
				username: username,
				password: password
			}

			$.ajax({
				url:'login',
				type:'POST',
				dataType:"json",
				data: formValues,
				success: function(data){
					if(data.ok){
						location.href="main";
					}
				},
				error: function () {
					App.vent.trigger('unauthorized');					
				}
			});
		},
		restart: function (argument) {
			window.location.replace('/#');
		},
		login: function () {
			var view  = new Authentication.Views.Login();
			this.region.show(view);
		}
	});

	Authentication.Router = Backbone.Marionette.AppRouter.extend({
		appRoutes: {
			'': 'login',
			'/': 'restart',		
			'denied': 'restart'
		}
	});
});


App.module('Authentication.Views', function (Views) {
	
	Views.Login = Backbone.Marionette.ItemView.extend({
		template: "#login-template",
		events: {
			"click #loginButton": "login"
		},
		ui: {
			inputEmail: "input#username",
			inputPassword: "input#password",
			loginButton: "button#loginButton"
		},
		initialize: function () {
			App.vent.on('unauthorized', this.onUnauthorized);
		},
		login: function (event) {
			event.preventDefault();
			$('#error').hide();

			var username = this.ui.inputEmail.val();
			var password = this.ui.inputPassword.val();
			
			App.vent.trigger('authenticate', {username: username, password: password});
		},
		onUnauthorized: function () {
			$("#error").text('No se ha podido iniciar su sesión.');
			$("#error").slideDown();
		}
	});
});
