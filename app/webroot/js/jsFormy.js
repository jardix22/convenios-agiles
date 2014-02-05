/***
  Formy version 0.0.8c
  + Add
  - value set properties <Not All>
***/

var Formy = function () {
	var Formy = {};

	var theme = {};

	theme.Bootstrap2 = {
		width: {
			label: "",
			input: ""
		},
		// form: "row",
		group: "form-group",
		label: "control-label",
		input: "form-control",
		help: "tips",
		button: "btn"
	};	

	Formy.render = function (squema) {
		return _form(squema);
	};

	Formy.renderInput = function (input) {
		var inputs = [];
		inputs.push(input);
		return _form(selector(inputs));
	};

	_form = function (squema) {
		_html = _.template("<form  role='form' id='<%= obj.id ? obj.id : '' %>' class='<%= obj.class ? obj.class : '' %>'><%= _inputs %></form>", { obj: squema, _inputs : selector(squema.inputs) });
		return _html;
	};

	selector = function (inputs) {
		var _inputHtml = "";
		
		_.forEach(inputs, function(input){
			switch(input.type){
				case "text":
	            case "number":
	            case "file":
					_inputHtml += _input(input);
					
					// var newInput = new input({options: options});
					// _inputHtml += newInput.render();
					
					break;
	            case "date":
					_inputHtml += _input(input);
					break;
				case "textarea":
					_inputHtml += _textarea(input);
					break;
				case "radio":
					_inputHtml += _radio(input);
					break;
				case "checkbox":
					_inputHtml += _checkbox(input);
					break;
				case "select":
					_inputHtml += _select(input);
					break;
				case "button":
					_inputHtml += _button(input);
					break;
				case "cradio":
					_inputHtml += _cradio(input);
					break;
				case "group":
					_inputHtml += _group(input);
					break;
				case "empty":
					_inputHtml += _empty(input);
					break;
				case "title":
					_inputHtml += _title(input);
					break;
				case "subtitle":
				case "subgroup":
					_inputHtml += _subtitle(input);
					break;
				case "box":
					_inputHtml += _box(input);
					break;
				default:
					_inputHtml += "<span class='tip-message'>Error</span>";
			};
		});
		return _inputHtml;
	};

	_input= function (options) {
		var item = {};
		
		item.options = {
			type: 'text',
			label: 'Input Label Formy',
			name: 'input-name-formy',
			required: true,
			value: null,
			// content: 'col-lg-12',
			data: [],
			autocomplete: "off"
		};

		item.options = _.extend(item.options, options)
		item.options.dataItems = getData(item.options.data);

		var objHtml =  _.template("<input type='<%= obj.type %>' id='<%= obj.name %>' name='<%= obj.name %>' class='<%= theme.input %> <%= obj.class ? obj.class :'' %>' <%= obj.required ? 'required' : '' %> value='<%= obj.value ? obj.value : '' %>' placeholder='<%= obj.placeholder %>' <%= obj.dataItems %> >", {obj: item.options, theme: theme.Bootstrap2});
		return groupForm(item.options, objHtml);
	};

	_textarea = function (obj) {
		var objHtml =  _.template("<textarea id='<%= obj.name %>' name='<%= obj.name %>' class='<%= theme.input %> <%= obj.class ? obj.class :'' %>' rows='<%= obj.rows %>' <%= obj.required ? 'required' : '' %> placeholder='<%= obj.placeholder %>' ><%= obj.value %></textarea>", {obj: obj, theme: theme.Bootstrap2});	
		return groupForm(obj, objHtml);
	};

	_radio = function (options) {
		var objHtml = "";
		var item = {};

		item.options = {
			type: 'radio',
			label: 'Input Label Formy',
			name: 'input-name-formy',
			required: true,
			value: null,
			// content: 'col-lg-12',
			data: [],
			autocheck: true
		};

		item.options = _.extend(item.options, options);

		if (item.options.value != null){
			item.options.autocheck = false;
		};
		
		var obj = item.options;

		if(!obj.inline){
			objHtml =  _.template("<% _.forEach(obj.options, function (option, i) { %><div class='<%= obj.type %>'><label><input type='<%= obj.type %>' name='<%= obj.name %>' id='<%= obj.name %>' value='<%= option.value ? option.value : option %>' <%= obj.required ? 'required' : '' %> <%=  obj.autocheck && i == 0? 'checked': '' %>  <%= obj.value == option ? 'checked': '' %> <%=  option.value && obj.value == option.value ? 'checked': '' %>   ><%= option.label ? option.label : option %></label></div><%}) %>", {obj: obj, theme: theme.Bootstrap2});	
			// console.log(objHtml, obj, obj.options);
		}else{
			objHtml =  _.template("<div class='_radio'><% _.forEach(obj.options, function (option, i) { %><label class='<%= obj.inline ? 'radio-inline': '' %>' ><input type='radio' name='<%= obj.name %>' id='<%= obj.name %>' value='<%= option.value ? option.value : option  %>' <%= obj.required ? 'required' : '' %>  <%=  obj.autocheck && i == 0? 'checked': '' %>  <%= obj.value == option ? 'checked': '' %> <%=  option.value && obj.value == option.value ? 'checked': '' %> ><%= option.label ? option.label : option %></label><%}) %></div>", {obj: obj, theme: theme.Bootstrap2});
		};

		return groupForm(obj, objHtml);
	};

	_checkbox = function (obj) {
		var objHtml = "";
		if(!obj.inline){
			objHtml =  _.template("<% _.forEach(obj.options, function (option, i) { %><div class='<%= obj.type %>'><label><input type='<%= obj.type %>' name='<%= obj.name %>' id='<%= obj.name %>' value='<%= option.value ? option.value : option %>' <%= obj.required ? 'required' : '' %> <%= obj.value == option ? 'checked': '' %> <%=  option.value && obj.value == option.value ? 'checked': '' %> ><%= option.label ? option.label : option %></label></div><%}) %>", {obj: obj, theme: theme.Bootstrap2});	
			console.log(objHtml, obj, obj.options);
		}else{
			objHtml =  _.template("<div class='_radio'><% _.forEach(obj.options, function (option, i) { %><label class='<%= obj.inline ? 'radio-inline': '' %>' ><input type='radio' name='<%= obj.name %>' id='<%= obj.name %>' value='<%= option.value ? option.value : option  %>' <%= obj.required ? 'required' : '' %> <%= obj.value == option || obj.value == option.value ? 'checked': '' %> ><%= option.label ? option.label : option %></label><%}) %></div>", {obj: obj, theme: theme.Bootstrap2});
		};
			
		return groupForm(obj, objHtml);
	};

	_select = function (obj) {
		// console.log("objHtml:", obj);

		var objHtml =  _.template("<select class='<%= theme.input %> <%= obj.class ? obj.class :'' %>' name='<%= obj.name %>' id='<%= obj.name %>' <%= obj.multiple ? 'multiple' : ''%> <%= obj.required ? 'required' : '' %> style='<%= obj.style %>'  > <% _.forEach(obj.options, function (option, i) { %><option  value='<%= (option.value)? option.value : option %>' <%= obj.value == option ? 'selected' : '' %>  ><%= (option.label)? option.label : option %></option><%}) %></select>", {obj: obj, theme: theme.Bootstrap2});	
		return groupForm(obj, objHtml);
	};

	_file = function (obj) {
		var html = _.template("<div class='form-group'><label class='control-label'><%= obj.label %></label><input type='file' id='<%= obj.name %>' name='<%= obj.name %>' class='form-control input-sm'><span class='tip-message'><%= obj.tip %></span></div>", obj);
		return html;	
	};

	_button = function (obj) {

		var objHtml = _.template("<div class='col-lg-12' style='clear: both; margin-bottom: 30px; padding-top: 5px; text-align: center;' ><button type='submit' id='<%= obj.name %>' name='<%= obj.name %>' class='<%= theme.button %> <%= obj.class ? obj.class :'' %>'><%= obj.label %></button></div>", {obj: obj, theme: theme.Bootstrap2});
		// return groupForm(obj, objHtml);
		return objHtml;
	};

	_cradio = function (obj) {
		var self = this;
		obj.htmlConditions = Array();

		obj.area = {name: "area" +'-'+ obj.name.replace(".", "-"), class: ".area" + '-'+ obj.name.replace(".", "-")};

		// console.log(obj.area);

		_.forEach(obj.conditions, function (condition, i) {
			obj.htmlConditions.push(selector(condition.items));
		});

		var html = _.template("<div class='form-group'><label class='control-label'><%= obj.label %></label><% _.forEach(obj.options, function (option, i) { %><div class='radio'><label><input type='radio' name='<%= (obj.name) %>' id='<%= obj.name %>' value='<%= option %>' data-xtype='cradio' data-case='#<%= (obj.name+'-'+i).replace('.', '-') %>' data-area='<%= obj.area.class %>' <%= i == 0 ? 'checked': '' %> ><%= option %></label></div><%}) %></div><div class='<%= obj.area.name %>'> <%= obj.htmlConditions[0]%></div>"
			, obj);

		// console.log(html);

		var cHtml = _.template("<div class='content-formy' style='display: none;'> <% _.forEach(obj.conditions, function (condition, i) { %> <div id='<%= (obj.name+'-'+i).replace('.', '-') %>'><%= obj.htmlConditions[i] %></div> <%}) %> </div>"
			, obj);

		$('body').append(cHtml);
		// console.log(cHtml);
		return html;
	};

	// --- Content functions ---

	content = function(contentClass, html){
	    return _.template("<div class='<%= contentClass %>'> <%= html %></div>", { contentClass: contentClass, html: html});
	};

	groupForm = function(obj, inputHtml){
		var objHtml =  _.template("<div class='<%= theme.group %>'><label class='<%= theme.label +' '+ obj.labelclass %>' style='color: #555;' ><%= obj.label %></label><div class='<%= obj.inputclass %>'> <%= inputHtml %> </div><span class='<%= theme.help %>'><%= obj.help %></span></div>", {obj: obj, inputHtml: inputHtml, theme: theme.Bootstrap2});
		return obj.content ? content(obj.content, objHtml): objHtml;
	};

	_group = function (obj) {
		if (obj.name != undefined ) {
			_.forEach(obj.inputs, function (input, i) {
				obj.inputs[i].name = obj.name+"."+input.name;
			});
		};

		var objHtml = _.template("<fieldset><legend><%= group.label %></legend><div class='row'><%= inputs %></div></fieldset>", { group: obj, inputs: selector(obj.inputs) });
		return obj.content ? content(obj.content, objHtml): objHtml;
	}

	_subtitle = function (obj) {
		return _.template("<div class='col-lg-12' style='clear: both; margin-bottom: 5px; padding-top: 10px;'><label><%= obj.label %></label></div>", { obj: obj });
	}

	_title = function (obj) {
		return _.template("<div class='col-lg-12' style='clear: both; margin-bottom: 10px; padding-top: 10px;'><h4><%= obj.label %></h4></div>", { obj: obj });
	}

	_empty = function (obj) {
		return _.template("<div class='row'><%= inputs %></div>", { inputs: selector(obj.inputs) });
	},

	_box = function (obj) {
		console.log("box", obj);
		var objHtml = _.template("<div class='<%= obj.class %>' style='clear: both; margin-bottom: 10px; padding-top: 10px;'>Box</div>", { obj: obj });

		return groupForm(obj, objHtml);
	}

	// >> small function
	getData = function (data) {
		var cdata = "";

		if (data != undefined) {
			if (data.length > 0) {
				_.forEach(data, function (item) {
					itemData  = "data-"+item.name+"='" + item.value + "'";
					cdata = cdata + " " + itemData;
				});
			};
		};

		return cdata;
	}

	splitText = function (text) {
		var data = [];
		var results = text.split(",");

		_.each(results, function (result) {
			result.trim();
			data.push(result.trim());
		});

		return data;	
	};
	// << small function

	return Formy;
}();