var rotating_headlines = {};
rotating_headlines.tickets = [];
rotating_headlines.rh_pe = function() {};
rotating_headlines.current = 0;

rotating_headlines.init = function (){
	var _ = this;
	new Ajax.Request(
		'ajax.php?init', 
		{
			method: 'get',
			onSuccess: function(transport) {
				if (transport.responseXML){
					var rotation_time_node = transport.responseXML.getElementsByTagName('rotation_time')[0];
					if (rotation_time_node && rotation_time_node.firstChild){
						_.rotation_time = parseInt(rotation_time_node.firstChild.nodeValue);
						if (_.rotation_time <= 0) _.rotation_time = 3000;
					}else{
						_.rotation_time = 3000;
					}
					_.rotation_ids = $A (transport.responseXML.getElementsByTagName('header'));
					_.start();
				}
			}
		}
	);
}

rotating_headlines.load_headline = function (id) {
	var _ = this;
	console.log(id);return false;
	if (id){
		new Ajax.Request(
			'ajax.php', 
			{
				asynchronous: true, 
				method: 'get',
				parameters: {id: id},
				onSuccess: function(transport) {
					//var headline = $('headline_article');
//					if (headline){
//							new Effect.Fade(headline, {duration: 1.0, afterFinish : _.change.bind(_)});
	//				}
					_.new_text = transport.responseText;
					_.change();

				}
			}
		);
	}else{
		return;
	}
}

rotating_headlines.start = function (){
	var _ = this;
	this.started = true;
	this.hr_pe = new PeriodicalExecuter(function(pe) {
		_.load_next();
	}, _.rotation_time / 1000);
}

rotating_headlines.change = function (new_text) {
	var headline = $('headline_article');	
	if (headline){
		headline.update(this.new_text);
//		new Effect.Appear(headline, {duration: 1.0});	
	}
}

rotating_headlines.stop = function (){
	this.hr_pe.stop();
}

rotating_headlines.pause = function (){
	if (this.started){
		$('pause').src = $('pause').src.replace(/player_pause/, 'player_play');
		this.stop();
		this.started = false;
	}else{
		$('pause').src = $('pause').src.replace(/player_play/, 'player_pause');
		this.next();
		this.started = true;
	}
}

rotating_headlines.load_prev = function () {
	if (this.rotation_ids[this.current - 1]){
		if (this.rotation_ids[this.current - 1].firstChild){
			var load_id = this.rotation_ids[this.current - 1].firstChild.nodeValue;
		}
		this.current--;
	}else{
		if (this.rotation_ids.last().firstChild){
			var load_id = this.rotation_ids.last().firstChild.nodeValue;
		}
		this.current = this.rotation_ids.length - 1;
	}
	this.load_headline(load_id);
}

rotating_headlines.load_next = function () {
	if (this.rotation_ids[this.current + 1]){
		if (this.rotation_ids[this.current + 1].firstChild){
			var load_id = this.rotation_ids[this.current + 1].firstChild.nodeValue;
		}
		this.current++;
	}else{
		if (this.rotation_ids[0].firstChild){
			var load_id = this.rotation_ids[0].firstChild.nodeValue;
		}
		this.current = 0;
	}
	this.load_headline(load_id);
}

rotating_headlines.next = function () {
	this.stop();
	this.load_next();
	this.start();
}

rotating_headlines.prev = function () {
	this.stop();
	this.load_prev();
	this.start();	
}


Event.observe(window, 'load', function() {
	var headline = $('headline_article');
	if (headline) rotating_headlines.init();
});
    
var ticker = {};
ticker.tickets = [];
ticker.ticker_pe = function() {};
ticker.current = 0;
ticker.start_ticker = function (){
	var _ = this;
	this.ticker_pe = new PeriodicalExecuter(function(pe) {
		
		if (_.tickets[_.current]){
			new Effect.Fade(
				_.tickets[_.current],
				{
					duration: 1.0, 
					queue: {position:'end', scope: 'ticker'}
				}
			);
		}
		
		if (_.tickets[_.current + 1]){
			_.current++;
		}else{
			_.current = 0;
		}
		
		new Effect.Appear(
			_.tickets[_.current],
			{
				duration: 1.0, 
				queue: {position:'end', scope: 'ticker'}
			}
		);
	}, 5);
}

ticker.stop_ticker = function (){
	this.ticker_pe.stop();
}

Event.observe(window, 'load', function() {
	ticker.tickets = $$('#ticker div');
	if (ticker.tickets.length > 0){
		new Effect.Appear(
			ticker.tickets[0],
			{
				duration: 1.0, 
				queue: {position:'end', scope: 'ticker'}
			}
		);
		ticker.start_ticker();
	}
});