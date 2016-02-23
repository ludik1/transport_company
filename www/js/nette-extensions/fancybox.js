$.nette.ext('fancybox', {
	init: function () {
		this.init($('body'));
	},
	success: function (payload) {
		var snippets;

		if (!payload.snippets || !(snippets = this.ext('snippets')))
			return;

		for (var id in payload.snippets) {
			this.init(snippets.getElement(id));
		}
	}
}, {
	init: function ($el) {
		$el.find('.fancybox').fancybox();
		$el.find('.fancybox-window').each(function (i, el) {
			var $el = $(el);
			var options = {
				type: 'inline',
				wrapCSS: 'fancybox-window-wrap'
			};
			options = $.extend(options, $el.data('fancybox-opts') || {});
			$.fancybox.open($el, options);
		});
	}
});