vivvoFormValidator = Class.create ();

Object.extend (
	vivvoFormValidator.prototype,
	{
		formElements: [],

		redirectUrl: false,

		initialize: function (element){
			if ($(element)) {
				this.element = $(element);
			}
			if (this.element.readAttribute('action') != ''){
				this.redirectUrl = this.element.readAttribute('action');
			}
			this.initFormElements();
			this.onSubmitHandle = this.onSubmit.bindAsEventListener(this);
			Event.observe (this.element, 'submit', this.onSubmitHandle);
		},

		initFormElements: function(){
			var _ = this;
			this.formElements = [];

			this.element.select('.form_line').each(
				function (div, index){
					var obj = {};
					obj.element = div;
					if (div.down('label')){
						obj.required = div.down('label').hasClassName('required');
					}else{
						obj.required = false;
					}

					obj.errorMessage = div.readAttribute('title');
					div.title = '';

					if (div.down('.formElement')){
						obj.regExp = div.down('.formElement').readAttribute('title')
						div.down('.formElement').title = '';
					}else{
						obj.regExp = false;
					}

					_.formElements.push(obj);

					if (div.down('img.info_help')){
						new Tooltip(div.down('img.info_help'), {mouseFollow: false});
					}
				}
			);
		},

		onSubmit: function(e){
			if (this.validation()){

				if (this.element.match('.noajax')) {
					return true;
				}

				document.body.style.cursor = 'wait';
				var url = "index.php?template_output=box/plugin_form_builder";
				var _ = this;
				new Ajax.Updater(this.element.up(), url, {
					evalScripts: true,
					parameters: this.element.serialize(true),
					onComplete: function () {
						document.body.style.cursor = 'default';
						if (_.redirectUrl){
							window.location = _.redirectUrl;
						}
					}
				});
			}
			e.preventDefault();
			return false;
		},

		validation: function (){
			var validate = true;
			var errorBox = this.element.down('.error_message');
			if (errorBox) errorBox.update();
			errorBox.hide();

			this.formElements.each(
				function(elem){
					var error = false;
					elem.element.removeClassName('error');
					if (elem.regExp){
						var re = new RegExp('^' + elem.regExp + '$', 'im');
						if (elem.element.down('input')){
							if (!elem.element.down('input').value.match(re)){
								error = true;
								validate = false;
							}
						}else if (elem.element.down('textarea')){
							if (!elem.element.down('textarea').value.match(re)){
								error = true;
								validate = false;
							}
						}
					}

					if (elem.required){
						if (elem.element.down('input')){
							if (elem.element.down('input').type == 'text'){
								if (elem.element.down('input').value.match(/^\s*$/)){
									error = true;
									validate = false;
								}
							}else if (elem.element.down('input').type == 'checkbox'){
								if (!elem.element.down('input').checked){
									error = true;
									validate = false;
								}
							}else if (elem.element.down('input').type == 'radio'){
								var radioChecked = false;
								$A(elem.element.getElementsByTagName('input')).each(
									function(radio){
										if (radio.checked) radioChecked = true;
									}
								);
								if (!radioChecked) {
									error = true;
									validate = false;
								}
							}else if (elem.element.down('input').type == 'file'){
                                if (elem.element.down('input').value.match(/^\s*$/)){
                                    error = true;
                                    validate = false;
                                }
                            }
						}else if (elem.element.down('textarea')){
							if (elem.element.down('textarea').value.match(/^\s*$/)){
								error = true;
								validate = false;
							}
						}
					}

					if (error){
						elem.element.addClassName('error');
						if (elem.errorMessage){
							if (errorBox){
								new Insertion.Bottom(errorBox, '<p>' + elem.errorMessage + '</p>');
								errorBox.show();
							}
						}
					}
				}
			);
			return validate;
		}
	}
);

Event.observe(window, 'load', function() {
	$$('form.form_builder').each(
		function(f){
			new vivvoFormValidator(f);
		}
	);
});
