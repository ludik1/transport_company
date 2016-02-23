$.nette.ext('confirm-delete', {
	load: function () {
		$("a.ajax.btn-danger").off('click.nette').on("click.nette", function (e) {
			if (confirm('Naozaj?')) {
				$(this).netteAjax(e);
			}

			return false;
		});
	}
});