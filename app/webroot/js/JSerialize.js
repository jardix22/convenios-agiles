// 0.a
var JSerialize = function () {
	JSerialize = {};

	JSerialize.get = function (view) {
		var data = view.$('form').serializeArray();

		var inputsData = {};

		_.each(data, function (item, i) {
			
			if (inputsData[item.name] != undefined) {
				inputsData[item.name]  += ", " + item.value;
			}else{
				inputsData[item.name]  = item.value;
			};

		});

		return inputsData;
	};

	return JSerialize;
}();