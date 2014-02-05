/*global TodoMVC */
'use strict';


App.module('Agreement', function (Agreement, App, Backbone, Marionette ) {

	Agreement.Layout = Backbone.Marionette.Layout.extend({
		template: "#resgister-layout",
		regions: {
			message: "#register-message",
			content: "#register-content"
		}
	});

	Agreement.Controller = Backbone.Marionette.Controller.extend({
		initialize: function (options) {
			console.log("Agreement::Controller.initialize");

			this.region = options.region;
			this.loginView = options.loginView;
		},
		initializeRegisterLayout: function () {
			Agreement.layout = new Agreement.Layout();
			this.region.show(Agreement.layout);
		},
		list: function () {
			this.initializeRegisterLayout();
			
			// List View			
			var listView = new Agreement.Views.ListView({collection: Agreement.agreementList});
			Agreement.layout.content.show(listView);

			// ** Message View
			var messageView = new Agreement.Views.MessageView({collection: Agreement.agreementList});
			Agreement.layout.message.show(messageView);
		}
	});

	Agreement.Router = Backbone.Marionette.AppRouter.extend({
		appRoutes: {
			'list': 'list'
		}
	});

	Agreement.addInitializer(function () {
		console.log("RegisterModule::addInitializer");
		
		App.agreements = new App.Agreements.AgreementSearchList();
		
		Agreement.agreementList = new App.Agreements.AgreementList();
		Agreement.agreementList.fetch();

		this.controller = new Agreement.Controller({region: App.mainRegion, loginView: this.loginView});
		this.router = new Agreement.Router({controller: this.controller});
	});
});

App.module('Agreement.Views', function (Views, App, Backbone, Marionette, $, _) {
	
	var EditFormModalView = Backbone.Marionette.ItemView.extend({
		template: "#edit-form-template",
		ui: {
			form: '.form-content'
		},
		events: {
			'click .save-modal': 'onSave',
			// 'submit form': 'onSave'
		},
		initialize: function () {
			Backbone.Validation.bind(this);
		},
		onRender: function () {
			
			var response = this.model.toJSON();
			console.log("model:: ", this.model);
			
			collectorDatapicker();

			var squema = {
				id:"yo",
				class: "",
				title: "Nuevo Convenio",
				inputs: [
					{type: "textarea", name:"title", label: "Título", rows: 3, required: true, content: "col-lg-12", class:"i-focus", value: response.title},
					{type: "textarea", name:"objetives", label: "Objetivos", rows: 6, required: true, content: "col-lg-12", value: response.objetives},
					{type: "radio", name:"coverage_type", label: "Según tipo de covertura", options: ["Marco", "Específico"], content: "col-lg-4", value: response.coverage_type},
					{type: "select", name:"purpose_type", label: "Según tipo de propósito", 
						options: ["Coolaboración", "Cooperación", "Docente Asistencial", "Interinstitucional", "Investigación", "Institucional", "Movilidad Académica", "Prestaciones Recíprocas", "Otros"], 
						 required: true, content: "col-lg-4", value: response.purpose_type
					},
					{type: "select", name:"location_type", label: "Según tipo de localización", options: ["", "Internacional", "Nacional", "Local"], required: true, content: "col-lg-4", value: response.location_type},
					{type: "select", name:"institution_type", label: "Según tipo de Institución", 
						options: [ "", "Compañias Mineras", "Direcciones Regionales de Salud", "Direcciones Regionales de Educación", "EsSalud", "Fundaciones", "Municipios", "Ministerios", "ONG's", "Gobierno Regionales", "Universidades", "Unidades de Gestion Ejecutoras Locales (UGEL)", "Otros"], 
						required: true, content: "col-lg-4", value: response.institution_type
					},
					{type: "empty"},
					{type: "text", name:"responsible", label: "Responsables", required: true, content: "col-lg-12", value: response.responsible},
					{type: "group", label: "Suscripcion", inputs: [
						// {type: "date", name: "suscription_date", label: "Fecha de Suscripción", required: true, content: "col-lg-3", value: response.suscription_date},
						{type: "text", class: "datepicker-item", data: [ {name: 'format', value: "DD/MM/YYYY"} ], name: "suscription_date", label: "Fecha de Suscripción", required: true, content: "col-lg-3", value: moment(response.suscription_date).format("L"), help: "Ejm. 31/01/2014"},
						{type: "text", name:"rectory_resolution", label: "Resolucion Rectoral", required: true, content: "col-lg-3", value: response.rectory_resolution},
						{type: "text", name:"validity", label: "Vigencia", required: true, content: "col-lg-6", value: response.validity, help: "Ejm. 2 días | 15 meses | 5 años | 30/10/2014 | indefinido"},

						], 
						content: "col-lg-12"
					},
					{type: "button", label: "Guardar", name:"save",class:"btn-default save-modal", content: "col-lg-12 center"}
				]
			};
			
			this.ui.form.html(Formy.render(squema));

			var items = this.ui.form.find('.datepicker-item');
			$(items).datetimepicker({
				// startDate: '1/1/1991', 
				language: 'es',
				pickTime: false
			});
		},
		onSave: function (e) {
			e.preventDefault();

			var data = JSerialize.get(this);
			data = this.normalizeData(data);
			
			this.model.set(data);
			
			if(this.model.isValid(true)){
				// App.vent.trigger("modal:hide");

				this.model.beforeSave();
	            console.log(this.model.toJSON());
				this.model.save();
	            
				App.vent.trigger("modal:hide");
	        }else{
	        	var els = this.$el.find('.has-error');
	        	$(els[0]).find(':input').focus();
	        }

		},
		normalizeData: function (data) {
			moment.lang('es');
			var ndate = moment(data.suscription_date, "DD/MM/YYYY");
			data.suscription_date = ndate.format("YYYY-MM-DD");
			// data.suscription_date = ndate.format("L");
			return data;
		}
	});

	// detail-view-template
	var ShowModalView = Backbone.Marionette.ItemView.extend({
		template: "#show-modal-template"
	});

	var AddFormModalView = Backbone.Marionette.ItemView.extend({
		template: "#add-form-modal-template",
		events: {
			// 'submit form': 'onSave'
			'click button#save': 'onSave'
		},
		initialize: function () {
			Backbone.Validation.bind(this);
			this.listenTo(this.collection, "add", this.render);	
		},
		squema: {
			id:"new-agreement-form",
			inputs: [
				{type: "textarea", name:"title", label: "Título", rows: 3, required: true, content: "col-lg-12", class:"i-focus"},
				{type: "textarea", name:"objetives", label: "Objetivos", rows: 6, required: true, content: "col-lg-12"},
				{type: "radio", name:"coverage_type", label: "Según tipo de covertura", options: ["Marco", "Específico"], content: "col-lg-4"},
				{
					type: "select", name:"purpose_type", label: "Según tipo de propósito", 
					options: ["Coolaboración", "Cooperación", "Docente Asistencial", "Interinstitucional", "Investigación", "Institucional", "Movilidad Académica", "Prestaciones Recíprocas", "Otros"], 
					multiple: true, required: true, content: "col-lg-4"
				},
				{type: "select", name:"location_type", label: "Según tipo de localización", options: ["", "Internacional", "Nacional", "Local"], required: true, content: "col-lg-4"},
				{
					type: "select", name:"institution_type", label: "Según tipo de Institución", 
					options: [ "", "Compañias Mineras", "Direcciones Regionales de Salud", "Direcciones Regionales de Educación", "EsSalud", "Fundaciones", "Municipios", "Ministerios", "ONG's", "Gobierno Regionales", "Universidades", "Unidades de Gestion Ejecutoras Locales (UGEL)", "Otros"], 
					required: true, content: "col-lg-4"
				},
				{type: "empty"},
				{type: "group", label: "Suscripción", inputs: [
					{type: "text", name:"rectory_resolution", label: "Resolución Rectoral", required: true, content: "col-lg-3"},
					{type: "text", class: "datepicker-item", data: [ {name: 'format', value: "DD/MM/YYYY"} ], name: "suscription_date", label: "Fecha de Suscripción", required: true, content: "col-lg-3", help: "Ejm. 31/01/2014"},
					{type: "text", name:"validity", label: "Vigencia", required: true, content: "col-lg-6", help: "Ejm. 2 días | 15 meses | 5 años | 30/10/2014 | indefinido"},
					{type: "empty"},
					{type: "text", name:"responsible", label: "Responsables", required: true, content: "col-lg-12"}

					], 
					content: "col-lg-12"
				},
				{type: "button", label: "Guardar", name:"save",class:"btn-default", content: "col-lg-12 center"}
			]
		},
		onRender: function () {
			collectorDatapicker();

			var items = this.$('.form-content').find('.datepicker-item');

			if (items.length > 1) {
				_.each(items, function (item) {
					$(item).datetimepicker({
						// startDate: '1/1/1991', 
						language: 'es',
						pickTime: false
					});	
				});
			} else{
				$(items).datetimepicker({
					// startDate: '1/1/1991', 
					language: 'es',
					pickTime: false
				});
			};
		},
 		onSave: function (event) {
			event.preventDefault();
			App.vent.trigger("init:events:collection");

			var data = JSerialize.get(this);
			data = this.normalizeData(data);

        	this.model.set(data);
			
			if(this.model.isValid(true)){
				
				this.model.beforeSave();
				this.collection.add(this.model);
				this.model.save();
	            
	            // console.log(this.model.toJSON());
				App.vent.trigger("modal:hide");
	        }else{
	        	var els = this.$el.find('.has-error');
	        	$(els[0]).find(':input').focus();
	        }

		},
		normalizeData: function (data) {
			moment.lang('es');
			var ndate = moment(data.suscription_date, "DD/MM/YYYY");
			// data.suscription_date = ndate.format("L");

			data.suscription_date = ndate.format("YYYY-MM-DD");
			return data;
		}
	});

	var AlertModalView = Backbone.Marionette.ItemView.extend({
		template: "#alert-modal-template",
		events: {
			'click .acepted': 'onAceptedButton'
		},
		onAceptedButton: function () {
			App.vent.trigger("modal:hide");
			this.model.destroy();
		}
	});
	
	var ItemView = Backbone.Marionette.ItemView.extend({
		tagName: 'tr',
		template : '#agreement-item-template',
		events: {
			'click .edit-agreement': 'onEdit',
			'click .remove-agreement': 'onRemove',
			'click .show-agreement': 'onShowAgreement'
		},
		modelEvents: {
			'change' : 'render'
		},
		onShowAgreement: function (e) {
			var view = new ShowModalView({model: this.model});
			App.modal.show(view);
		},
		onEdit: function (e) {
			var view = new EditFormModalView({model: this.model});
			App.modal.show(view);
		},
		onRemove: function (e) {
			var view = new AlertModalView({model: this.model});
			App.modal.show(view);
		}
	});

	Views.MessageView = Backbone.Marionette.ItemView.extend({
		template: "#add-message-template",
		ui: {
			spinner: '#spinner'
		},
		firts: true,
		initialize: function () {
			var self = this;
			
			App.vent.on("init:events:collection", function () {
				if (self.firts) {
					self.listenTo(self.collection, "add", function (model) {
						console.log("add");
						self.$el.slideDown("slow");
					});
					
					self.listenTo(self.collection, "request", function () {
						console.log("request");
						self.ui.spinner.html("cargando..");
					});

					self.listenTo(self.collection, "sync", function (model) {
						console.log("sync.." + self.firts);

						self.ui.spinner.html("Listo..!");
						setTimeout(function() {
							self.$el.slideUp("slow");
						}, 3000);
					});
					self.firts = false;
				};
			});
		},
		
		onRender: function (argument) {
			this.$el.hide();
		}
	});

	Views.ListView = Backbone.Marionette.CompositeView.extend({
		template : '#agreement-list-composite-template',
		itemView: ItemView,
		// itemViewContainer: '.agreement-list',
		events: {
			'click #add-agreement': 'onAddButton'
		},
		appendHtml: function(collectionView, itemView, index){
			collectionView.$('.agreement-list').prepend(itemView.el);
		},
		onAddButton: function () {
			var addModalView = new AddFormModalView({collection: this.collection, model: new App.Agreements.Agreement()});
			App.modal.show(addModalView);
		}
	});

	var collectorDatapicker = function () {
		var items = $('body').find('.bootstrap-datetimepicker-widget');

		_.each(items, function (item) {
			$(item).remove();
		});
	}
});