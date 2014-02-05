var AuthenticationModule;

AuthenticationModule = App.module('AuthenticationModule');

AuthenticationModule.LoginView = Backbone.Marionette.ItemView.extend({
	initialize: function () {
		App.vent.on('unauthorized', this.onUnauthorized);
	},
	template: "#login-template",

	events: {
		"click #loginButton": "login"
	},
	ui: {
		inputEmail: "input#username",
		inputPassword: "input#password",
		loginButton: "button#loginButton"
	},

	login: function (event) {
		event.preventDefault();

		this.onBeforeLogin();
		var username = this.ui.inputEmail.val();
		var password = this.ui.inputPassword.val();
		
		App.vent.trigger('authenticate', {username: username, password: password});
	},

	onBeforeLogin: function () {
		$('#error').hide();
	},

	onUnauthorized: function () {
		console.log("unauthorized...");
		$("#error").text('No se ha podido iniciar su sesión.');
		$("#error").slideDown();
	}
});

AuthenticationModule.Controller = Backbone.Marionette.Controller.extend({
	initialize: function (options) {
		var self = this;

		console.log("AuthenticationModule::initialize");

		this.region = options.region;
		this.loginView = options.loginView;


		App.vent.on('authenticate', function (data) {
			self.authenticate(data.username, data.password);
		});
	},
	authenticate: function (username, password ){
		var url = 'login';
		
		console.log('Loggin in... ');
		
		var formValues = {
			username: username,
			password: password
		}

		$.ajax({
			url:url,
			type:'POST',
			dataType:"json",
			data: formValues,
			success: function(data){
				console.log(":D", data);
				if(data.ok){
					return location.href="main";
				}
			},
			error: function () {
				App.vent.trigger('unauthorized');
				console.log(":(");
				console.log("error");
			}
		});
	},
	restart: function (argument) {
		return location.href="";
	},
	login: function () {
		console.log("login");
		var view  = new AuthenticationModule.LoginView();
		this.region.show(view);
	}
});

AuthenticationModule.Router = Backbone.Marionette.AppRouter.extend({
	appRoutes: {
		'': 'login',
		'/': 'restart',
		'list': 'restart',
		'search': 'restart'
	}
});

AuthenticationModule.addInitializer(function () {
	console.log("AuthenticationModule::addInitializer");

	this.controller = new AuthenticationModule.Controller({ region: App.mainRegion });
	this.router = new AuthenticationModule.Router({ controller: this.controller });
});