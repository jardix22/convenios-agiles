App.module('Search', function (Search, App, Backbone, Marionette, $, _) {
  var SearchLayout = Backbone.Marionette.Layout.extend({
    template: "#search-layout",

    regions: {
      search: "#search-bar",
      agreements: "#agreement-container"
    }
  });

  Search.Controller = Backbone.Marionette.Controller.extend({
    initialize: function (options) {
      var self = this;
      this.region = options.region;
    },
    initializeSearchLayout: function () {
      Search.layout = new SearchLayout();
      Search.layout.on("show", function () {
        Search.trigger("layout:rendered");
      });

      this.region.show(Search.layout);
    },
    search: function (term) {
      this.initializeSearchLayout();
      
      var view = new Search.Views.AgreementListView({collection: App.agreements});
      App.vent.trigger("search:term", term);
      Search.layout.agreements.show(view);
    },
    defaultSearch: function () {
      this.search(App.agreements.previousSearch || {title: 'convenio'});
    }
  });

  Search.Router = Backbone.Marionette.AppRouter.extend({
    appRoutes: {
      '': 'defaultSearch', 
      '#search': 'search'
    }
  });

  Search.addInitializer(function () {

    this.on("layout:rendered", function () {
      var searchView = new Search.Views.SearchView();
      Search.layout.search.attachView(searchView);
    });

    this.controller = new Search.Controller({region: App.mainRegion});
    this.router = new Search.Router({controller: this.controller});
  });
});

App.module('Search.Views', function (Views, App, Backbone, Marionette, $, _) {
  Views.SearchView = Backbone.View.extend({
    el: "#search-bar",
    events: {
      'submit form': 'search',
      'change #location_type': 'search',
      'change #coverage_type': 'search',
      'change #responsible': 'search',
			'change #is_validity': 'search'
    },
    initialize: function(){
      var self = this;
      var $spinner = this.$('#search');

      App.vent.on("search:start", function(){ 
        $spinner.html("Buscando..").attr("disabled", true); 
        console.log("start");
      });
      App.vent.on("search:stop", function(){
        $spinner.html("Buscar").attr("disabled", false); 
        console.log("stop");
      });
      App.vent.on("search:term", function(term){

        self.$('#searchTerm').val(term.title);
        self.$('#location_type').val(term.location_type);
        self.$('#coverage_type').val(term.coverage_type);
        self.$('#responsible').val(term.responsible);
				self.$('#is_validity').val(term.is_validity);
      });

      App.vent.on("change:date", function() {
        self.defaultSearch();
      });

      this.$selectDate = this.$('#select-date');
      this.render();
    },
    render: function () {
      var selectDate = new SelectDateView();
      this.$selectDate.html(selectDate.render().el);
      return this;
    },

    defaultSearch: function(){
      var data = JSerialize.get(this);
      console.log("data: %o", data);
      App.vent.trigger('search:term', data);
    },
    search: function (event) {
      event.preventDefault();
      var data = JSerialize.get(this);
      console.log("data: %o", data);
      App.vent.trigger('search:term', data);
    }
  });

  var SelectDateView = Backbone.Marionette.ItemView.extend({
    template: "#select-date-template",
    defaultOptions: {
      val: "interval",
      text: "Intervalo perzonalizado"
    },
    lastSelection: null,
    onBeforeRender: function () {
    },    
    events: {
      'change .select-item': 'onChange',
    },
    onRender: function () {
      var self = this;
      
      App.vent.on("interval:selected", function (arguments) {
        var option =  $("option[data-interval-date=true]");
        option.val(arguments[0].start_date +","+ arguments[0].end_date);
        option.text( $.format.date( new Date( arguments[0].start_date ), 'dd/MM/yyyy') +" al "+ $.format.date( new Date( arguments[0].end_date ), 'dd/MM/yyyy'));

        App.vent.trigger("change:date");
        
        console.log("cambio", arguments);
      });

      App.vent.on("interval:reset", function () {
        var option =  $("option[data-interval-date=true]");
        option.val(self.defaultOptions.val);
        option.text(self.defaultOptions.text);
      });

      App.vent.on("interval:set:cancel", function () {
        $(self.lastSelection).attr("selected", true);
      });

      this.lastSelection =  this.$("option[value='']");

    },
    onChange: function (e, i) {
      var optionSelected = this.$('.select-item option:selected');
      if (optionSelected.data('interval-date')) {
        var view = new intervalDateModal();
        App.modal.show(view);

      } else{
        App.vent.trigger("interval:reset");
        this.lastSelection = optionSelected;
        App.vent.trigger("change:date");
      };
    }
  });

  var intervalDateModal = Backbone.Marionette.ItemView.extend({
    template: "#interval-date-modal",
    events: {
      'click .send-form': 'onSendModal',
      'click button[data-dismiss=modal]': 'onCancel',
      'submit form': 'onSave'
    },
    ui: {
      modal: ".modal-body",
      startDate: '#start_date',
      endDate: '#end_date'
    },
    onSendModal: function () {
      if (this.ui.startDate.val() == "" || this.ui.startDate.val().length < 1) {
        this.ui.startDate.focus();
        return;
      };

      if (this.ui.endDate.val() == "" || this.ui.endDate.val().length < 1) {
        this.ui.endDate.focus();
        return;
      };

      this.$('form').submit();
    },
    onSave: function (e) {
      e.preventDefault();
      var data = JSerialize.get(this);
      
      App.vent.trigger("interval:selected", [data]);
      App.vent.trigger("modal:hide");
    },
    onCancel: function () {
      App.vent.trigger("interval:set:cancel");
    }
  });

  // detail-view-template
  DetailView = Backbone.Marionette.ItemView.extend({
    template: "#detail-view-template"
  });

  Views.AgreementView = Backbone.Marionette.ItemView.extend({
    template: "#agreement-template",
    className: "agreement",
    tagName: "tr",
    events: {
      'click .btn-details': 'detail'
    },
    detail: function () {
      var view = new DetailView({model: this.model});
      App.modal.show(view);
    }
  });

  Views.AgreementListView = Backbone.Marionette.CompositeView.extend({
    template: "#agreement-list-template",
    itemView: Views.AgreementView,
    events: {
      'click #pdf-report': 'onClickPdfReport',
      'click #xls-report': 'onClickXlsReport'
    },
    initialize: function () {
      _.bindAll(this, "showMessage");
      var self = this;
      App.vent.on("search:error", function(){ self.showMessage("Error, por favor intente despues :s") });
      App.vent.on("search:noSearchTerm", function(){ self.showMessage("Hummmm, can do better :)") });
      App.vent.on("search:noResults", function(){ self.showMessage("No hay convenios encontrados.") });
      App.vent.on("search:results", function(){
        self.$('tr.message').remove();
      });

    },
    appendHtml: function(collectionView, itemView){
      collectionView.$(".agreements").append(itemView.el);
    },
    showMessage: function(message){
      this.$('.agreements').html('<tr class="message"><td class="notFound" colspan="6">' + message + '</td></tr>');
    },
    onClickPdfReport: function () {
      var idList = [];
      this.collection.each(function (model) {
        idList.push(model.get('id'));
      });

      location.href = "reports/pdf?ids="+idList;
    },
    onClickXlsReport: function () {
      var idList = [];
      this.collection.each(function (model) {
        idList.push(model.get('id'));
      });

      location.href = "reports/xls?ids="+idList;
    }
  });
});