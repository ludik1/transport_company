// TODO add description - what's going on?

$.nette.ext('gridItemsPerPage', {
	load: function () {
		$('select[name=count]').unbind('change').change(function () {
			$(this).next().trigger('click');
		});
	}
});