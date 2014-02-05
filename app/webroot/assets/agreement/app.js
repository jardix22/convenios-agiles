App = new Backbone.Marionette.Application();
 
var ModalRegion = Backbone.Marionette.Region.extend({
  el: "#modal",

  constructor: function(){
    var self = this;
    _.bindAll(this, "getEl", "showModal", "hideModal");
    Backbone.Marionette.Region.prototype.constructor.apply(this, arguments);
    this.on("show", this.showModal, this);

    App.vent.on("modal:hide", function () { self.hideModal(); })
  },

  getEl: function(selector){
    console.log("getEl");

    var $el = $(selector);
    $el.on("hidden", this.close);

    return $el;
  },

  showModal: function(view){
    console.log("showModal");

    view.on("close", this.hideModal, this);
    this.$el.modal({
      keyboard: false
    });
  },

  hideModal: function(){
    console.log("hideModal");

    this.$el.modal('hide');
  }
});


App.addRegions({
  headerRegion: "#_menu",
  messageRegion: "#message-box",
  mainRegion: "#main",
  footerRegion: "#footer",
 modal: ModalRegion
});

App.MenuView = Backbone.Marionette.ItemView.extend({
  template: "#menu-template",
  
  events: {
    'click .navbar-nav li': 'changeState'
  },
  
  showLibraryApp: function(e){
    e.preventDefault();
    App.LibraryApp.defaultSearch();
  },
  
  closeApp: function(e){
    e.preventDefault();
    App.Closer.close();
  },

  changeState: function (e) {
    this.setInactive();
    $(e.currentTarget).addClass('active');
  },
  setInactive: function () {
    var items = this.$el.find('li.active');

    _.each(items, function (item) {
      $(item).removeClass('active');
    });
  }
});


// App.vent.on("layout:rendered:logged", function(){
App.vent.on("layout:rendered", function(){
  console.log("App::initialize:rendered <menu>")
  var menu = new App.MenuView();
  App.headerRegion.show(menu);
});

App.vent.on("layout:closed", function(){
  console.log("App::initialize:closed")
  App.headerRegion.close();
});

App.on('initialize:after', function () {
  console.log("App::initialize:after")
  App.vent.trigger("layout:rendered");
  Backbone.history.start();
});

App.on('initialize:before', function () {
  console.log("App::initialize:before");

  // initialize internationalization Time Moment
  moment.lang('es');

  Backbone.Validation.configure({
      forceUpdate: true
  });

  _.extend(Backbone.Validation.callbacks, {
      valid: function (view, attr, selector) {
          var $el = view.$('[name=' + attr + ']'), 
              $group = $el.closest('.form-group');
          
          $group.removeClass('has-error');
          $group.find('.help-block').html('').addClass('hidden');
      },
      invalid: function (view, attr, error, selector) {
          var $el = view.$('[name=' + attr + ']'), 
              $group = $el.closest('.form-group');
          
          $group.addClass('has-error');
          $group.find('.help-block').html(error).removeClass('hidden');
      }
  });

  window.$.ajaxSetup({
      statusCode: {
          401: function(){
              // Redirec the to the login page.
              window.location.replace('/#login');
           
          },
          403: function() {
              // 403 -- Access denied
              window.location.replace('/#denied');
          }
      }
  });

});

