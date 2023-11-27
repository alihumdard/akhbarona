
var iPodStyleMenu = Class.create({

	initialize: function(options, onload){

		if (options && options.constructor == String) {
            options = {selector: options};
        }

		this.options = Object.extend({
            selector: '.ipod_style_menu',
            duration: 0.3,
            transition: Effect.Transitions.sinoidal
        }, options || {});

		var menus = $$(this.options.selector);

		if (!menus || !menus.length) {
			if (!onload) {
				Event.observe(window, 'load', arguments.callee.bindAsEventListener(this, options, true));
			}
			return;
		}

		this.instance_id = iPodStyleMenu.instances.length;
		iPodStyleMenu.instances.push(this);
		this.max_height = 0;
		this.menu_width = menus[0].getWidth();

		var ul = (this.menu_holder = menus[0]).select('ul');

		if (ul && ul.length) this.process_list(this.active_list = ul[0], 0);

		this.menu_holder.select('ul').each(function(ul){
			this.max_height = Math.max(this.max_height, ul.getHeight());
		}.bind(this));

		this.menu_holder.setStyle({height: (this.max_height + 6) + 'px'});
	},

	process_list: function(ul, index) {

		if (index != 0) {
			this.menu_holder.insert({bottom: ul.remove()});
		}

		ul.setStyle({
			position: 'absolute',
			left: (this.menu_width * index) + 'px',
			top: 0,
			width: this.menu_width + 'px'
		})
		.select('li').each(function(li){

			var submenu, back, next;
			if (submenu = li.down('ul')) {

				li.insert({top: next = new Element('span', {'class': 'jump_to'}).update('&raquo;')});
				next.observe('click', iPodStyleMenu.next.bind(li, this.instance_id));

				submenu.insert({top: back = new Element('li', {'class': 'first'}).update('<span class="jump_to back">&laquo; Back</span>')});
				back.observe('click', iPodStyleMenu.back.bind(back, this.instance_id));

				submenu.addClassName('child_' + li.identify());
				ul.addClassName('parent_' + back.identify());

				this.process_list(submenu, index + 1);
			}
		}.bind(this));
	}
});

iPodStyleMenu.instances = [];

iPodStyleMenu.next = function(id) {
	var ul = this.up('ul'),
		next_ul = this.up('div').select('.child_' + this.identify())[0],
		instance = iPodStyleMenu.instances[id];

	new Effect.Parallel([
		new Effect.Move(ul, {sync: true, x: -instance.menu_width}),
		new Effect.Move(next_ul.setStyle({left: instance.menu_width + 'px'}), {sync: true, x: -instance.menu_width})
	], {
		duration: instance.options.duration,
		transition: instance.options.transition
	});
};

iPodStyleMenu.back = function(id) {
	var ul = this.up('ul'),
		prev_ul = this.up('div').select('.parent_' + this.identify())[0],
		instance = iPodStyleMenu.instances[id];

	new Effect.Parallel([
		new Effect.Move(ul, {sync: true, x: +instance.menu_width}),
		new Effect.Move(prev_ul.setStyle({left: -instance.menu_width + 'px'}), {sync: true, x: +instance.menu_width})
	], {
		duration: instance.options.duration,
		transition: instance.options.transition
	});
};
