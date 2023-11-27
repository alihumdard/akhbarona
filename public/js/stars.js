/*  Starry Set Form Widget
 *  (c) 2006 Chris Iufer <chris@duarte.com>
 *  Starry is freely distributable under the terms of an MIT-style license.
 *  See the Duarte Design web site: http://www.duarte.com/portfolio/
/*--------------------------------------------------------------------------*/
var debug = false;

var StarryDefaults = {
		sprite: "/themes/akhbarona210/img/stars.gif",
		width: 30,
		height: 30,
		startAt: 0,
		maxLength: 5,
		multiplier: 1,
		showNull: true,
		align: 'left',
		feedback: false,
		callback: false,
		voted: false
};

// The Starry Class
// new Starry('id_of_element'[, {options}]);
// This is the main starry widget. Create new widgets after window load
var Starry = Class.create();
Starry.prototype = {
	initialize: function(element) {
		this.element = $(element);
		this.element.className = "starry";
		this.options = {};
		// get our defaults
		Object.extend(this.options, StarryDefaults);
		Object.extend(this.options, arguments[1] || {});
		this.name = this.options.name || "starry" + id.next();
		if(debug) console.log(this.options.showNull);
		// lets build our array with an extra one for null
		this.children = new Array(this.options.maxLength + 1);
		if(debug) console.log('children length '+ this.children.length);
		// lets make the hidden form value
		this.hidden = document.createElement("input");
		this.hidden.type = "hidden";
		this.hidden.name = this.name;
		this.element.appendChild(this.hidden);
		// build out each child
		for(i=0; i < this.children.length; i++) {
			this.children[i] = new SingleStar(this, i);
			this.element.appendChild(this.children[i].element);
		}
		if( this.options.feedback ) {
			this.feedback = document.createElement('div');
			this.feedback.className = "feedback";
			Element.setStyle(this.feedback,{'float' : this.parent.options.align});
			this.element.appendChild(this.feedback);
		}
		// startup
		this.selected = this.options.startAt;
		this.reset(this.selected);
	},
	set: function(index) {
		if(debug) console.log('set index '+ index);
		// set the child
		for(var i=1; i < this.children.length; i++)
			this.children[i].element.style.backgroundPosition = (i <= index) ? "0 -" + this.options.height * 2 + "px" : "0 0";
		if(this.options.feedback)
			this.feedback.innerHTML = this.children[index].value;
		this.selected = index;
		// set the form value
		this.hidden.value = this.children[index].value;
		if(debug) console.log('set value ' + this.hidden.value);
	},
	click : function (index){
		if (!this.options.voted){
			this.set(index);
			if (this.options.callback) {
				this.options.callback(index);
			}
			this.options.voted = true;
		}else{
			this.options.callback(false);
		}
	},
	show: function(index) {
		if(debug) console.log('show index '+ index);
		// show the child
		for(var i=1; i < this.children.length; i++)
			this.children[i].element.style.backgroundPosition = (i <= index) ? "0 -" + this.options.height + "px" : "0 0";
		if(this.options.feedback)
			this.feedback.innerHTML = this.children[index].value;
	},
	reset: function() { this.set(this.selected); },
	clear: function() {
		for(var i=1; i < this.children.length; i++)
			this.children[i].element.style.backgroundPosition = "0 0";
	}
};

// Class: SingleStar(parent_object, index of that parent's children)
// Not to be called directly, inherits its options from a Starry object
var SingleStar = Class.create();
SingleStar.prototype = {
	initialize: function(parent, index) {
		this.parent = parent;
		this.index = index;
		if(debug) console.log('Creating star at index '+ this.index);
		this.value = this.index * this.parent.options.multiplier;
		if(debug) console.log('value '+ this.value);
		this.element = document.createElement("div");
		this.element.style.width = this.parent.options.width + "px";
		this.element.style.height = this.parent.options.height + "px";
		this.element.style.backgroundImage = "url(" + this.parent.options.sprite + ")";
		this.element.style.backgroundPosition = (this.index == 0) ? "0 -" + this.parent.options.height * 3  +"px" : "0 0";
		this.element.className = "standard_star";
		Element.setStyle(this.element,{'float' : this.parent.options.align});
		if(!this.parent.options.showNull && this.index == 0) this.element.style.display = "none";
		if (!this.parent.options.voted){
			this.element.onclick = function() { this.parent.click(this.index); }.bind(this);
			this.element.onmouseover = function() { this.parent.show(this.index); }.bind(this);
			this.element.onmouseout = this.parent.reset.bind(this.parent);
		}else{
			this.element.style.cursor = 'default';
		}
		if(debug) console.log('set onclick handler');
	}
};

// this function manages an auto_increment for id's
var id = { start: 0, prev: 0, next: function() { return this.start + this.prev++; } };
