var AuthenticationModule;

AuthenticationModule = App.module('AuthenticationModule');
/*
AuthenticationModule.LoginView = Backbone.Marionette.ItemView.extend({
	initialize: function () {
		App.vent.on('authorized', this.onAuthorized);
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

	onAuthorized: function () {
		console.log("authorized..");
		window.location.replace('#index');
		App.vent.trigger("layout:rendered");
	},

	onUnauthorized: function () {
		console.log("unauthorized...");
		$("#error").text('No se ha podido iniciar su sesión.');
		$("#error").slideDown();
	}
});
*/
AuthenticationModule.Controller = Backbone.Marionette.Controller.extend({
/*
	initialize: function (options) {
		var self = this;

		console.log("AuthenticationModule::initialize");

		this.region = options.region;
		this.loginView = options.loginView;

		App.vent.on('authenticate', function (data) {
			self.authenticate(data.username, data.password);
		});
	},
*/
/*
	authenticate: function (username, password ){
		var url = 'core/login';
		
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
					console.log(":)");
					App.vent.trigger('authorized');
				}
			},
			error: function () {
				App.vent.trigger('unauthorized');
				console.log(":(");
				console.log("error");
			}
		});
	},
	login: function () {
		console.log("asdas");
		var view  = new AuthenticationModule.LoginView();
		this.region.show(view);
	},
*/
	logout: function () {
			$.ajax("logout", {
				method: "GET",
				success: function(data) {
					//window.location.hash = 'login';
					// App.vent.trigger("layout:closed");
					return location.href="";
				}
			});
	}
});

AuthenticationModule.Router = Backbone.Marionette.AppRouter.extend({
	appRoutes: {
		// 'login(/)': 'login',
		'logout(/)': 'logout'
	}
});

AuthenticationModule.addInitializer(function () {
	/*
	var checkLogin = function(callback) {
		$.ajax("core/account/authenticated", {
			method: "GET",
			success: function(data) {
				return callback(true);
			},
			error: function(data) {
				return callback(false);
			}
		});
	};

	var runApplication = function(authenticated) {
		if (authenticated) {
			window.location.hash = 'index';
			App.vent.trigger("layout:rendered");
		} else {
			window.location.hash = 'login';
		}
	};
	
	checkLogin(runApplication);

	$.ajaxSetup({
		statusCode: {
			401: function() {
				return window.location.replace('#login');
			},
			403: function() {
				return window.location.replace('#denied');
			}
		}
	});
	
*/
	console.log("AuthenticationModule::addInitializer");
	this.controller = new AuthenticationModule.Controller({ region: App.mainRegion });
	this.router = new AuthenticationModule.Router({ controller: this.controller });
});