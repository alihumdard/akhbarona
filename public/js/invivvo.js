vivvo = {};
myvivvo = {};
myvivvo.options = {};
myvivvo.utils = {};

myvivvo.utils.updateWidgetContent = function (id, params){	
	if (params == undefined){
		params = {};
	}
	
	params.cookie_name = myvivvo.options.cookieName;
	params.search_peid = id;
	params.template_output = 'box/widget_content_output';
	
	new Ajax.Updater('content_widget_' + id, 'index.php', {
		method: 'get',
		parameters: params,
		evalScripts: true
	});
}