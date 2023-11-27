vivvoRotatingHeadlines = Class.create ();
		
Object.extend (vivvoRotatingHeadlines.prototype,
	{
		element : null,
		rotationPe : function() {},
		current : 0,
		
		initialize : function (id, time){
			if (time){
				this.time = time;
			}else{
				this.time = 5;
			}
			this.elementId = id;
			this.element = $(id);
			this.playerElement = $(id + '_player');
			if (this.playerElement){
				this.tabs = new Control.Tabs(this.playerElement, {afterChange: this.onHeadlineChange.bind(this)});
				this.tabLinks = $A(this.playerElement.getElementsByTagName('a'));
				if (this.tabLinks.length > 0){ 
					Event.observe(this.element, 'click', this.stopRotation.bind(this));
					this.startRotation();
				}
			}
		},
		
		onHeadlineChange: function (key){
			var index = key.id.split('_').last(); 
			var summary = $$('#' + this.elementId + '_' + index + ' .headline_body').first();
			if (summary) resizeShort($(this.elementId + '_article_' + index), summary);	
		},
		
		startRotation : function (){
			var _ = this;
			this.rotationPe = new PeriodicalExecuter(function(pe) {
				_.tabs.next();
			}, this.time);
		},

		stopRotation : function (){
			this.rotationPe.stop();
		}
	}
);