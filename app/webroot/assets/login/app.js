App = new Backbone.Marionette.Application();

App.addRegions({
  mainRegion: "#main",
});

App.on('initialize:after', function () {
  console.log("App::initialize:after")
  Backbone.history.start();
});

App.on('initialize:before', function () {
  console.log("App::initialize:before")
});
