vivvoRotatingHeadlines=Class.create(),Object.extend(vivvoRotatingHeadlines.prototype,{element:null,rotationPe:function(){},current:0,initialize:function(t,e){this.time=e||5,this.elementId=t,this.element=$(t),this.playerElement=$(t+"_player"),this.playerElement&&(this.tabs=new Control.Tabs(this.playerElement,{afterChange:this.onHeadlineChange.bind(this)}),this.tabLinks=$A(this.playerElement.getElementsByTagName("a")),this.tabLinks.length>0&&(Event.observe(this.element,"click",this.stopRotation.bind(this)),this.startRotation()))},onHeadlineChange:function(t){var e=t.id.split("_").last(),i=$$("#"+this.elementId+"_"+e+" .headline_body").first();i&&resizeShort($(this.elementId+"_article_"+e),i)},startRotation:function(){var t=this;this.rotationPe=new PeriodicalExecuter(function(e){t.tabs.next()},this.time)},stopRotation:function(){this.rotationPe.stop()}});