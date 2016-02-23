$(function () {
	// nette extension
	$.nette.ext('boostrap.datetime', {
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
		init: function (el) {
			$(el).find('input.datetimepicker').datetimepicker({
				format: $(this).data('date-format'),
				autoclose: true
			});

			$(el).find('input.date, input.datepicker').daterangepicker({
				format: 'DD.MM.YYYY',
				showDropdowns: false,
				singleDatePicker: true,
				locale: {
					firstDay: 1
				}
			});

			$(el).find('input.daterange').daterangepicker({
				format: 'DD.MM.YYYY',
				showDropdowns: false,
				locale: {
					firstDay: 1
				}
			});
		}
	});
});