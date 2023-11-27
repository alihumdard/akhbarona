window.vivvoForgotPassForm = Class.create();

Object.extend(vivvoForgotPassForm.prototype, {
	element : null,
	initialize : function(){
		/*if ($('forgot_password_form')){
			this.element = $('forgot_password_form');
            this.element.observe('submit', this.sendData.bindAsEventListener(this));
		}else{
            return false;
        }*/
	},
	sendData : function(){
		$$('body')[0].style.cursor = 'wait';
		if (!this.validate()){
			return false;
		}
		var _ = this;
		var url = 'index.php';
		var params = $('forgot_password_form').serialize();



		new Ajax.Updater($('forgot_form_holder'), url, {
			parameters : params,
			evalScripts : true,
			insertion : 'top',
			onComplete : function(){
				$$('body')[0].style.cursor = 'default';
				if (!($('forgot_form_holder').down('.error'))){ // if no error returned, remove the form
					$('forgot_password_form').remove();
					$('forgot_form_holder').down('div.fp_info').remove();
					$('forgot_form_holder').down('div.inline_error').remove();
				}

			}
		});
	},
	validate : function(){
		var error = '';
		if ($($('forgot_password_form').elements['LOGIN_username']).value=='' && $($('forgot_password_form').elements['LOGIN_email']).value == ''){
			if ($$('.inline_error').length>0){
				$$('.inline_error')[0].remove();
			}
			Element.insert($('forgot_form_holder'), {top : '<div class="inline_error">' + vivvo.lang['LNG_ERROR_2712'] + '</div>'});
			return false;
		} else {
			return true;
		}
	}
});


Event.observe(window, 'load', function(){

    var onsubmit = (function(){

        this.sendData();

    }).bind(new vivvoForgotPassForm);

	var forgot_form_holder = $('forgot_form_holder');

	if (!forgot_form_holder) return;

    forgot_form_holder.select('.formElement.submit')[0].insert(

        (new Element('input', {type: 'button', 'class': 'button', name: 'login'}))

        .writeAttribute('value', $$('#forgot_form_holder .formElement.submit input')[0].remove().readAttribute('value'))

        .observe('click', onsubmit)
    );

    $('LOGIN_email').observe('keyup', function(e){ if (e.keyCode == 13) onsubmit(); });
});
