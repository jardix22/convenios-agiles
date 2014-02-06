/*global TodoMVC */
'use strict';

App.module('Authentication', function (Authentication) {
	Authentication.Controller = Backbone.Marionette.Controller.extend({
		logout: function () {
			$.ajax("logout", {
				method: "GET",
				success: function(data) {
					return location.href="";
				}
			});
		}
	});

	Authentication.Router = Backbone.Marionette.AppRouter.extend({
		appRoutes: {
			'logout(/)': 'logout'
		}
	});
  
	Authentication.addInitializer(function () {
		this.controller = new Authentication.Controller({ region: App.mainRegion });
		this.router = new Authentication.Router({ controller: this.controller });
	});
});



