/*global Backbone */
'use strict';

App.module('Agreements', function (Agreements, App, Backbone) {
  // Room Model
  // ----------
  Agreements.Agreement = Backbone.Model.extend({
    urlRoot: 'agreements',
    validation: {
      title: [{
        required: true,
        msg: "Este campo es obligatorio.",
        fn: 'validateString'
      }],
      objetives: [{
        required: true,
        // msg: "Este campo es obligatorio.",
        fn: 'validateString'
      }],
      coverage_type: [{
        required: true,
        msg: "Este campo es obligatorio."        
      }],
      purpose_type: [{
        required: true,
        msg: "Este campo es obligatorio.",
      }],
      location_type: [{
        fn: 'validateSelect'        
      }],
      institution_type: [{
        fn: 'validateSelect'        
      }],
      rectory_resolution: [{
        required: true,
        msg: "Este campo es obligatorio."
      }],
      suscription_date: {
        required: true,
        fn: 'validateSuscriptionDAte'
      },
      validity: [{
          required: true,
          msg: "Este campo es obligatorio."
        },{
          fn: 'validateValidity'
      }],
      responsible: {
        required: true,
        fn: 'validateString'
      }
    },
    validateString: function (value) {
      var isString = RegExp("^[^\\d].*");

      if(!isString.test(value)){
        return "Formato incorrecto.";
      };
    },
    validateSelect: function (value) {
      if (value === "") {
        return "Este campo es obligatorio.";
      };
    },
    validateValidity: function (value, attr, computedState) {
      var fixValue = value.trim();
      var fixValue = value.toLowerCase();

      console.log(value, ":P")

      var isYear = function () {
        var yearTest = RegExp("^0?([1-9]{1,} {1}(año|años))$");
        return yearTest.test(fixValue);
      }();

      var isMonth = function () {
        var monthTest = RegExp("^0?([1-9]{1,} {1}(mes|meses))$");
        return monthTest.test(fixValue);
      }();
      
      var isDay = function () {
        var dayTest = RegExp("^0?([1-9]{1,} {1}(día|días))$");
        return dayTest.test(fixValue);
      }();

      var isDate = function () {

        var arrayDate = fixValue.split("/");

        if (arrayDate.length == 3) {
          var dayValidate = RegExp("^0?([1-9]|1[0-9]|2[0-9]|3[0-1])$");
          var monthValidate = RegExp("^0?([1-9]|1[0-2]|)$");
          var yearValidate = RegExp("^19|20([0-9]{2})$");

          if(dayValidate.test(arrayDate[0]) && monthValidate.test(arrayDate[1]) && yearValidate.test(arrayDate[2])){
            return true;
          }
        };
        return false;
      }();

      var isUndefinied = (fixValue === "indefinido") ? true : false;

      var result = {isValid: false};
      

      if (isYear || isMonth || isDay || isDate) {
        var ss = fixValue.split(" ");
        var n = parseInt(ss[0]);
        result.isValid = (n != undefined) ? true: false;

      }else if(isUndefinied){
        result.isValid = true;
      }else{
        result = {dType: 0, value: fixValue, isValid: false};
      };

      if(!result.isValid) {
        return 'Valor invalido';
      }
    },
    validateSuscriptionDAte: function (value, attr, computedState) {
      if (value == "Invalid date") {
        return 'Name is invalid';
      };
    },
    toJSON: function () {
      var json = Backbone.Model.prototype.toJSON.call(this);
      json.is_expired = moment(this.get('expired_date')).diff(moment(), 'days') < 0 ? "Expirado" : "Vigente";
      return json;
    },
    beforeSave: function () {
      console.log("suscription_date: %o", this.get("suscription_date"));
      this.set("expired_date", this.getExpiredDate(this.get('suscription_date'), this.get('validity')));
    },
    getDate: function (date) {
      date = date.trim().toLowerCase();

      var isYear = date.indexOf("año") > 0 ? true : false;
      var isMonth = date.indexOf("mes") > 0 ? true : false;
      var isDay = date.indexOf("día") > 0 ? true : false;
      var isDate = date.split("/").length == 3 ? true : false;
      var isUndefinied = (date === "indefinido") ? true : false;
      
      var result = {isValid: false};

      if (isYear) {
        var ss = date.split(" ");
        var n = parseInt(ss[0]);

        if (n != undefined ) {
          result = {dType: 1, value: n, uDate: "years", isValid: true};
        };
      }else if (isMonth) {
        var ss = date.split(" ");
        var n = parseInt(ss[0]);
        
        if (n != undefined ) {
          result = {dType: 1, value: n, uDate: "months", isValid: true};
        };
      }else if (isDay) {
        var ss = date.split(" ");
        var n = parseInt(ss[0]);
        if (n != undefined ) {
          result = {dType: 1, value: n, uDate: "days", isValid: true};
        };
      }else if (isDate) {
        result = {dType: 2, value: date, isValid: true};
      }else if (isUndefinied) {
        result = {dType: 3, value: "undefined", isValid: true};
      }

      return result;
    },
    getExpiredDate: function (suscriptionDate, validity) {

      var eDate = this.getDate(validity);
      var result = {state: false, date: null};

      moment.lang('es');
      var sDate = moment(suscriptionDate);

      if (eDate.isValid) {
        result.state = true;

        switch(eDate.dType){
          case 1:
            var nDte = sDate.add(eDate.uDate, eDate.value);
            result.date = nDte.format('L');
            break;
          case 2:
            result.date = eDate.value;
            break;     
          case 3:
            result.date = moment().add('years', 10).format('L');
            this.set('is_undefined', true);
            break;
        }
      }

      return result.date;
    }

  });
  
  Agreements.AgreementList = Backbone.Collection.extend({
    model: Agreements.Agreement,
    url: 'agreements'
  });
  
  // Agreement Collection
  // ---------------
  Agreements.AgreementSearchList = Backbone.Collection.extend({
    model: Agreements.Agreement,
    url: 'agreements',
    initialize: function () {
      var self = this;
      _.bindAll(this, "search");
      App.vent.on("search:term", function (term) { self.search(term); });
      this.previousSearch = null;
    },
    search: function (dataSearch) {
      var self = this;
      if(!_.isEqual(dataSearch, this.previousSearch)){
        this.fecthAgreements(dataSearch, function (agreements) {
          if(agreements.length < 1){
            App.vent.trigger("search:noResults");
          }
          else{
            App.vent.trigger("search:results");
            console.log("agreements: %o ", agreements);
            self.reset(agreements);
          }
        });
        this.previousSearch = dataSearch; 
      }
    },
    fecthAgreements: function (dataSearch, callback) {

          App.vent.trigger("search:start");
      
      $.ajax({
        url: 'agreements/search',
        dataType: 'json',
        data: dataSearch,
        success: function (res) {
                App.vent.trigger("search:stop");
          callback(res);
        }
      });
    }
  }); 
});