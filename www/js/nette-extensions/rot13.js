$(function () {
	// nette extension
	$.nette.ext('rot13', {
		init: function () {
			this.convert($('body'));
		},
		success: function (payload) {
			var snippets;
			if (!payload.snippets || !(snippets = this.ext('snippets')))
				return;

			for (var id in payload.snippets) {
				this.convert(snippets.getElement(id));
			}
		}
	}, {
		convert: function (el) {
			var reg = new RegExp("[0-9a-zA-Z\.]+@[0-9a-zA-Z\.]+$");

			$.each($(el).find("a").not(".user-content a"), function () {
				if (this.href.match(reg)) {
					this.href = "mailto:" + Rot13.convert(this.href.substring(7)); // remove mailto: from start
				}

				var text = $(this).text();

				if (text.match(reg)) {
					if (text.indexOf('mailto:') === 0) {
						$(this).text(Rot13.convert(text.substring(7)));
					}
					else {
						$(this).text(Rot13.convert(text));
					}
				}
			});

			reg = new RegExp("[0-9a-zA-Z\.]+@[0-9a-zA-Z\.]+", "g");
			$.each($(el).find(".user-content"), function () {
				var content = $(this).html();
				$(this).html(content.replace(reg, function (mail) {
					return Rot13.convert(mail)
				}));

			});
		}
	});
});