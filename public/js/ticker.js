vivvoTicker = Class.create ();
		
Object.extend (vivvoTicker.prototype,
	{
		element : null,
		tickets : [],
		tickerPe : function() {},
		current : 0,
		
		initialize : function (elem){
			this.element = $(elem);
			if (this.element){
				this.tickets = $A(this.element.getElementsByTagName('div'));
				this.glider = new Glider(this.element, {duration:0.5});
				if (this.tickets.length > 0){ 
					Event.observe(this.element, 'mouseover', this.stopTicker.bind(this));
					Event.observe(this.element, 'mouseout', this.startTicker.bind(this));
					this.startTicker();
				}
			}
		},
		
		startTicker : function (){
			var _ = this;
			this.tickerPe = new PeriodicalExecuter(function(pe) {
				_.glider.next();
			}, 7);
		},

		stopTicker : function (){
			this.tickerPe.stop();
		}
	}
);