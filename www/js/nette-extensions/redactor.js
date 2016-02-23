$.nette.ext('redactor', {
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
		$el.find('.editor').redactor({
			lang: 'sk',
			imageUpload: $('body').data('image-upload'),
			fileUpload: $('body').data('file-upload'),
			imageGetJson: false,
			minHeight: 200,
			formattingTags: ['p', 'blockquote', 'h2', 'h3', 'h4'],
			allowedTags: ['code', 'a', 'br', 'p', 'b', 'i', 'img', 'iframe', 'blockquote',
				'cite', 'ul', 'ol', 'li', 'hr', 'dl', 'dt', 'dd', 'sup', 'sub',
				'big', 'pre', 'code', 'strong', 'em', 'table', 'tr', 'td',
				'th', 'tbody', 'thead', 'tfoot', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
			buttons: ['html', '|', 'formatting', '|', 'bold', 'italic', '|', 'fontcolor', 'backcolor', '|', 'unorderedlist', 'orderedlist', '|', 'table', 'link', '|', 'image', 'file', '|', 'horizontalrule'],
			plugins: ['fullscreen']
		});
	}
});