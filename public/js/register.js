vivvoRegisterForm = Class.create();

Object.extend (vivvoRegisterForm.prototype, {
	
	element : null, //the form itself
	needTOSCheck : false, //TOS check flag
	usernameTaken : null, //Username taken flag
	emailTaken: null, 
	
	usernameField : null, //Username form field
	passwordField1 : null, //Password fomr field 1
	passwordField2 : null, //Password fomr field 2
	emailField : null, //email form field
	websiteField : null, //website form field
	TOSField : null, //TOS form field

	availableElem : null, // username information element
	strengthElem : null, // password 1 information element
	identicalElem : null, // password 2 information element
	emailValidElem : null, // email information element
	websiteELem : null, // website information element

	initialize : function(elementId, needs_tos_check){
		this.element = $(elementId);
		this.needTOSCheck = needs_tos_check || false;
		if (this.element.tagName == "FORM"){
			
			// information divs
			this.strengthElem = $('pass_strength');
			this.identicalElem = $('pass_identical');
			this.emailValidElem = $('email_valid');
			this.availableElem = $('user_availability');
			this.websiteElem = $('www_valid');
			
			// form fields
			this.usernameField = $(this.element.elements['USER_username']);
			this.passwordField1 = $(this.element.elements['USER_password']);
			this.passwordField2 = $(this.element.elements['USER_retype_password']);
			this.emailField = $(this.element.elements['USER_email_address']);
			this.websiteField = $(this.element.elements['USER_www']);
			if (this.needTOSCheck){
				this.TOSField = $(this.element.elements['USER_TOS']);
			}
			//events 
			this.usernameField.observe('blur', this.displayUsernameAvailability.bindAsEventListener(this));
			this.usernameField.observe('keyup', this.displayUsername.bindAsEventListener(this));
			this.passwordField1.observe('keyup', this.displayPasswordStrength.bindAsEventListener(this));
			this.passwordField1.observe('blur', this.displayPasswords.bindAsEventListener(this));
			this.passwordField2.observe('keyup', this.displayPasswords.bindAsEventListener(this));
			this.passwordField2.observe('blur', this.displayPasswords.bindAsEventListener(this));
			this.emailField.observe('keyup', this.displayEmail.bindAsEventListener(this));
			this.emailField.observe('blur', this.checkEmailAvailability.bindAsEventListener(this));
			this.websiteField.observe('keyup', this.displayWebsite.bindAsEventListener(this));
			this.element.focusFirstElement();
			
		}
	},
	//email
	checkEmail : function() { // check email field
		if ( this.emailField.value.match(/^[-_a-zA-Z0-9]+(\.[-_a-zA-Z0-9]+)*@[-a-zA-Z0-9]+(\.[-a-zA-Z0-9]+)*\.[a-zA-Z]{2,6}$/)){
			return true;
		} else {
			return false;
		}
	},
	displayEmail : function(){ // display email field information
		if (this.emailField.value.length==0){
			return false;
		}
		if (this.checkEmail()){
			this.emailValidElem.className = 'valid';
			Element.addClassName(this.emailValidElem, 'validation');
			this.emailValidElem.innerHTML = vivvo.lang.get('LNG_EMAIL_ADDRESS_VALID');
		} else {
			this.emailValidElem.className = 'not_valid';
			Element.addClassName(this.emailValidElem, 'validation');
			this.emailValidElem.innerHTML = vivvo.lang.get('LNG_EMAIL_ADDRESS_NOT_VALID');
		}
	},
	//password
	displayPasswordStrength : function(){ // display password field 1 information
		if (this.passwordField1.value.length==0 && this.passwordField2.value.length==0){
			return;
		}
		strength = this.calculatePasswordStrength(this.passwordField1.value)
		if (strength>0 && strength<=50){
			strength += strength;
			this.strengthElem.removeClassName('valid');
			this.strengthElem.removeClassName('not_valid');
			Element.addClassName(this.strengthElem, 'validation');
			if (strength>=16 && strength <= 35){
				this.strengthElem.style.color = '#F3735D';
				this.strengthElem.innerHTML = vivvo.lang.get('LNG_VERY_WEAK');
			} else if (strength>35 && strength <= 52){
				this.strengthElem.style.color = '#B35545';
				this.strengthElem.innerHTML = vivvo.lang.get('LNG_WEAK');
			} else if (strength>52 && strength <= 69){
				this.strengthElem.style.color = '#6b99c5';
				this.strengthElem.innerHTML = vivvo.lang.get('LNG_GOOD');
			} else if (strength>69 && strength <= 86){
				this.strengthElem.addClassName('valid');
				this.strengthElem.style.color = '#8B9241';
				this.strengthElem.innerHTML = vivvo.lang.get('LNG_STRONG');
			} else if (strength > 86){
				this.strengthElem.addClassName('valid');
				this.strengthElem.style.color = '#80CA73'
				this.strengthElem.innerHTML = vivvo.lang.get('LNG_VERY_STRONG');
			}
		} else if (strength==-1){
			this.strengthElem.className = 'not_valid';
			this.strengthElem.style.color = '#F3735D';
			Element.addClassName(this.strengthElem, 'validation');
			this.strengthElem.innerHTML = vivvo.lang.get('LNG_PASSWORD_TOO_SHORT');
		} else if (strength==-2){
			this.strengthElem.className = 'not_valid';
			Element.addClassName(this.strengthElem, 'validation');
			this.strengthElem.innerHTML = vivvo.lang.get('LNG_PASSWORD_MUST_NOT_CONTAIN_USERNAME');
		} else if (strength==-3){
			this.strengthElem.className = 'not_valid';
			Element.addClassName(this.strengthElem, 'validation');
			this.strengthElem.innerHTML = vivvo.lang.get('LNG_TOO_MANY_REPEATED_CHARACTERS');
		} else if (strength=0 && this.passwordField1.value.length!=0){
			this.strengthElem.className = 'not_valid';
			Element.addClassName(this.strengthElem, 'validation');
			this.strengthElem.innerHTML = vivvo.lang.get('LNG_PASSWORD_INVALID');
		}
		
	},
	checkPasswords : function(){ // check if both passwords are identical
		if (this.passwordField1.value!="" || this.passwordField2.value!=""){
			if (this.passwordField1.value != this.passwordField2.value){
				return false;
			} else {
				return true;
			}
		} else return false;
	},
	displayPasswords : function() { //display information for password field 2
		if (this.passwordField1.value.length==0 && this.passwordField2.value.length==0){
			return;
		}
		if (!this.checkPasswords()){
			this.identicalElem.className = 'not_valid';
			Element.addClassName(this.identicalElem, 'validation');
			this.identicalElem.innerHTML = vivvo.lang.get('LNG_PASSWORDS_ARE_NOT_IDENTICAL');
		} else {
			this.identicalElem.className = 'valid';
			Element.addClassName(this.identicalElem, 'validation');
			this.identicalElem.innerHTML = vivvo.lang.get('LNG_PASSWORDS_ARE_IDENTICAL');
		}
	},
	calculatePasswordStrength : function(pass) { //calculate password strength
		var strength=0;
		//length
		if (pass.length<6) {
			strength=-1;
		} else {
			if (pass.length >6 && pass.length<=10){
				strength+=6;
			} else if (pass.length>10 && pass.length<16){
				strength+=10;
			} else if (pass.length>=16){
				strength+=14;
			}
			// alphanumeric
			if ( pass.match(/.*[a-z].*/)){ //small
				strength+=5;
			}
			if ( pass.match(/.*[A-Z].*/)){ //caps
				strength+=5;
			}
			if ( pass.match(/.*[0-9].*/)){ //numbers
				strength+=5;
			}
			//multi letters
			if ( pass.match(/.*[a-z].*[a-z].*/)){ //multi small (separate)
				strength+=2;
			}
			if ( pass.match(/.*[A-Z].*[A-Z].*/)){ //multi caps (separate)
				strength+=2;
			}
			if ( pass.match(/.*[0-9].*[0-9].*/)){ //multi numbers (separate) 
				strength+=2;
			}
			if ( pass.match(/.*[a-z]+.*[A-Z]+.*[0-9]+.*/)){ //multi combination (separate)
				strength+=5;
			}
			// special
			if ( pass.match(/.*[!,\",@,#,$,%,^,&,\s,*,?,_,~].*/)){ //special (once)
				strength+=5;
			}
			if ( pass.match(/.*[!,@,#,\",$,%,^,&,*,\s,?,_,~].*[!,@,#,\",$,%,^,&,\s,*,?,_,~]/)){ // multi special
				strength+=5;
			}
			if ( pass.match(/.*\s.*/)){
				//strength = false;
			}
			repeats = this.checkRepeatedCharacters(pass);
			if (repeats!=0){
				if (repeats==pass.length-1){
					return(-3);
				} else {
					/*if (strength-repeats <= strength){
						strength -=repeats;
					}*/
				}
			}
			strength = parseInt(strength * 1.2);
			if (parseInt(strength)>50){
				strength=50;
			} else if (parseInt(strength)<0) {
				strength=1;
			}
			if (pass.toLowerCase().match(this.usernameField.value.toLowerCase()) && this.usernameField.value!=""){
				return(-2)
			}
		}
		return strength;
		
	},
	checkRepeatedCharacters : function(pass) { // check for repeated characters in password (returns num of repeats)
		repeats=0;
		charsInPass = pass.split('');
		for (i=0;i<charsInPass.length;i++){
			for (j=0;j<charsInPass.length;j++){
				if (Math.abs(j-i)==1){
					if (charsInPass[j] == charsInPass[i]){
						repeats++;
					}
				}
			}
		}
		return parseInt(repeats/2);
		
	},
	//username
	checkUsernameAvailability : function(){ // check with server if given username is available
		if (!this.displayUsername(1, 'checking username availability')){
			return false;
		}
		var _ = this;
		var params = {};
		params.action = 'user';
		params.cmd = 'checkUsername';
		params.USER_username = _.usernameField.value
		
		_.availableElem.innerHTML = vivvo.lang.get('LNG_CHECKING_USERNAME_AVAILABILITY');
		
		new Ajax.Request('index.php', {
			method: 'POST',
			parameters: params,
			onSuccess: function(transport) {
				response=String(transport.responseText);
				if (response.isJSON()){
					if (response.evalJSON()===true){
						_.usernameTaken = true;
					} else {
						_.usernameTaken = false;
					}
				} else {
						_.usernameTaken = "NA";
				}
				_.populateUsernameAvailability();
			}
		});
	},
	//email
	checkEmailAvailability : function(){ // check with server if given username is available
		//if (!this.displayUsername(1, 'checking username availability')){
		//	return false;
		//}
		var _ = this;
		var params = {};
		params.action = 'user';
		params.cmd = 'checkEmail';
		params.USER_email = _.emailField.value
		
		this.emailValidElem.innerHTML = vivvo.lang.get('LNG_CHECKING_EMAIL_AVAILABILITY');
		
		new Ajax.Request('index.php', {
			method: 'POST',
			parameters: params,
			onSuccess: function(transport) {
				response=String(transport.responseText);
				if (response.isJSON()){
					if (response.evalJSON()===true){
						_.emailTaken = true;
						
					} else {
						_.emailTaken = false;
					}
				} else {
					_.emailTaken = false;
				}
				_.populateEmailAvailability();
			}
		});
	},
	displayUsernameAvailability : function(){ // check username availability
		_ = this;
		if (!this.checkUsernameLength() || !this.checkUsernameValidity()){
			return false;
		}
		this.checkUsernameAvailability();
	},
	populateUsernameAvailability : function(){ // show availability status for username
		if (this.usernameTaken===true){
			this.availableElem.className = 'not_valid';
			Element.addClassName(this.availableElem, 'validation');
			this.availableElem.innerHTML = vivvo.lang.get('LNG_USERNAME_TAKEN');
		} else if (this.usernameTaken===false){
			this.availableElem.className = 'valid';
			Element.addClassName(this.availableElem, 'validation');
			this.availableElem.innerHTML = vivvo.lang.get('LNG_USERNAME_AVAILABLE');
		} else {
			this.availableElem.className = 'checking';
			Element.addClassName(this.availableElem, 'validation');
			this.availableElem.innerHTML = vivvo.lang.get('LNG_COULD_NOT_CHECK_AVAILABILITY');
		}
	},
	
	populateEmailAvailability : function(){ // show availability status for username
		if (this.emailTaken===true){
			this.emailValidElem.className = 'not_valid';
			Element.addClassName(this.emailValidElem, 'validation');
			this.emailValidElem.innerHTML = vivvo.lang.get('LNG_EMAIL_TAKEN');
		} else if (this.emailTaken===false){
			this.displayEmail();
		} else {
			this.emailValidElem.className = 'checking';
			Element.addClassName(this.emailValidElem, 'validation');
			this.emailValidElem.innerHTML = vivvo.lang.get('LNG_COULD_NOT_CHECK_AVAILABILITY');
		}
	},
	
	checkUsernameLength : function(){
		if (this.usernameField.value.length<3){
			return false;
		}
		else return true;
	},
	checkUsernameValidity : function() {
		if (!this.usernameField.value.match(/^[a-zA-Z0-9\_\-]+$/)){
			return false;
		} else return true;
	},
	displayUsername : function(e, message) { // display username information
		if (this.usernameField.value.length==0){
			return false;
		}
		if (!this.checkUsernameLength()){
			this.availableElem.className = 'not_valid';
			Element.addClassName(this.availableElem, 'validation');
			this.availableElem.innerHTML = vivvo.lang.get('LNG_USERNAME_TOO_SHORT');
			return false;
		} else if (!this.checkUsernameValidity()){
			this.availableElem.className = 'not_valid';
			Element.addClassName(this.availableElem, 'validation');
			this.availableElem.innerHTML = vivvo.lang.get('LNG_USERNAME_INVALID');
			return false;
		} else {
			if (message){
				this.availableElem.className = 'checking'
				Element.addClassName(this.availableElem, 'validation');
				this.availableElem.innerHTML = message;
			} else {
				this.availableElem.className = 'valid'
				Element.addClassName(this.availableElem, 'validation');
				this.availableElem.innerHTML = vivvo.lang.get('LNG_USERNAME_VALID');
			}
			return true;
		}
	},
	//website
	checkWebsite : function() { // check website field
		if (this.websiteField.value.match(/^(www\.)?([a-zA-Z0-9\-]*)\.([a-zA-Z0-9\-]*)\.?([\w]{2,3})(\.[A-Za-z]{1,3})?([\/~A-Za-z\d]+)?$/)){
			return true;
		} else {
			return false;
		}
	},
	displayWebsite : function() {// display website field information
		if (this.websiteField.value.length==0){
			return false;
		}
		if (this.checkWebsite()){
			this.websiteElem.className = 'valid';
			Element.addClassName(this.websiteElem, 'validation');
			this.websiteElem.innerHTML = vivvo.lang.get('LNG_REGISTER_VALID_URL');
		} else {
			this.websiteElem.className = 'not_valid';
			Element.addClassName(this.websiteElem, 'validation');
			this.websiteElem.innerHTML = vivvo.lang.get('LNG_REGISTER_INVALID_URL');
		}
	},
	validate : function(){ // validate the form before submitting
		var error="";
		if (!this.checkUsernameLength()){
			error+=vivvo.lang.get('LNG_USERNAME_TOO_SHORT') + "\n";
		} else if (!this.checkUsernameValidity()){
			error+=vivvo.lang.get('LNG_USERNAME_NOT_VALID') + "\n";
		} else if (_.usernameTaken===true){
			error+=vivvo.lang.get('LNG_USER_USERNAME') + " '" + this.usernameField.value +"' " + vivvo.lang.get('LNG_IS_ALREADY_TAKEN') + "\n";
		}
		
		if (!this.checkPasswords()){
			error+=vivvo.lang.get('LNG_YOU_HAVE_TO_ENTER_IDENTICAL_PASSWORD')  + "\n";
		} else if (this.passwordField1.value.length<6 || this.passwordField2.value.length<6){
			error+=vivvo.lang.get('LNG_PASSWORD_TOO_SHORT') + "\n";
		} else if (this.calculatePasswordStrength(this.passwordField1.value)==-2){
			error+=vivvo.lang.get('LNG_PASSWORD_MUST_NOT_CONTAIN_USERNAME') + "\n";
		} else if (this.checkRepeatedCharacters(this.passwordField1.value)==(this.passwordField1.value.length-1)){
			error+=vivvo.lang.get('LNG_TOO_MANY_REPEATED_CHARACTERS') + "\n";
		}
		

		if ( !this.checkEmail()){
			error+=vivvo.lang.get('LNG_YOU_HAVE_TO_TYPE_IN_A_REAL_EMAIL') + "\n";
		}else if (_.emailTaken===true){
			error+=vivvo.lang.get('LNG_USER_EMAIL') + " '" + this.emailField.value +"' " + vivvo.lang.get('LNG_IS_ALREADY_TAKEN') + "\n";
		}
		
		if (this.needTOSCheck){
			if (!this.TOSField.checked){
				error+=vivvo.lang.get('LNG_TERMS_OD_SERVICE_INFO') + "\n";
			}
		}
		if (this.websiteField.value!=""){
			if (!this.checkWebsite()){
				error+=vivvo.lang.get('LNG_YOUR_WEBSITE_MUST_BE_A_VALID_URL') + "\n";
			}
		}
		if (error==""){
			return true;
		} else {
			$('error_message').innerHTML="";
			var errors = new Array();
			errors = error.split('\n');
			for(i=0;i<errors.length;i++){
				if (errors[i]!=""){
					$('error_message').innerHTML += '<p>'+errors[i]+'</p>';
				}
			}
			return false;
		}
	}
});