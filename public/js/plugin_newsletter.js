function updateNewsletter(){
	if ($('newsletter_dump')){
		$('newsletter_dump').remove();
	}
	newsletterParam = $('newsletter_form').serialize(true);
	newsletterParam.template_output = 'box/plugin_newsletter';
								
	new Ajax.Updater('newsletter_form_holder', 'index.php', {
		parameters: newsletterParam,
		evalScripts: true
	});
}