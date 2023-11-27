var vivvoTickerTyper = Class.create({		
    
	initialize : function (elem, options){
	
        var o = this.options = Object.extend({
	        
	        type_speed: 0.05,
	        wait_period: 4,
	        
	        categories_selector: 'li.category',
	        category_selector: 'a',
	        articles_selector: 'li',
	        article_selector: 'a'
	        
        }, options);	
	
		var categories = $(elem).select(o.categories_selector),
		
		    data = this.data = [];
		    
		categories.each(function(category){
		    
		    var anchor = category.select(o.category_selector)[0],
		        
		        articles = category.select(o.articles_selector),
				    
                category_data = {
					
					title: anchor.innerHTML,
					href: anchor.href,
					articles: [],
					counter: 0
				};
			
			articles.each(function(article){
			    
			    var anchor = article.select(o.article_selector)[0];
			    
			    category_data.articles.push({
			        
			        title: anchor.innerHTML,
			        href: anchor.href
			    });
			});
			
			data.push(category_data);
		});
		
		
		elem.innerHTML = '<li><strong><a class="a_category" href=""></a></strong><ul><li><a class="a_article" href=""></a></li></ul></li>';
		
		this.cat_holder = elem.select('.a_category')[0];
		this.art_holder = elem.select('.a_article')[0];

		this.switchCategory(0);
	},
		
	switchCategory: function(cid){
		
		if (cid < 0 || cid >= this.data.length) {
			
			cid = 0;
		}
		
		this.cat_holder.href = this.data[cid].href;
		this.cat_holder.innerHTML = this.data[cid].title;
		this.data[cid].counter = 0;
		
		this.startTyper(cid);
	},
	
	startTyper: function (cid){
		
		var cat = this.data[cid];
		
		if (cat.counter >= cat.articles.length) {
			
			return this.switchCategory(++cid);
		}
		
		var article = cat.articles[this.data[cid].counter++];
		
		var self = this;
		
		this.art_holder.innerHTML = '';
		this.art_holder.href = article.href;
		
		var len = article.title.length, pos = 1;
		
		new PeriodicalExecuter(function(pe){
			
			self.art_holder.innerHTML = article.title.substr(0, pos++) + ((pos & 1) && (pos <= len) ? '<span class="blink">_</span>' : '');
			
			if (pos > len) {
				
				pe.stop();
				
				setTimeout(function(){ self.startTyper(cid); }, self.options.wait_period * 1000);
			}
			
		}, this.options.type_speed);
	}
});
