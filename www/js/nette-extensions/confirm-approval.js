$.nette.ext('confirm-approval', {
	load: function () {
		$("a.approval-confirm").off('click.nette').on("click.nette", function (e) {
			if (confirm('Schválením sa projekt schváli aj pre druhý študijný program.')) {
				$(this).netteAjax(e);
			}

			return false;
		});
	}
});