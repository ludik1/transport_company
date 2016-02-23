(function($, undefined) {

    $.nette.ext('spinner', {
        init: function() {
            this.spinner = $('<div id="ajax-spinner"></div>');
            $('body').append(this.spinner);
            this.spinner.hide();
        },
        start: function() {
            this.spinner.show();
        },
        complete: function() {
            this.spinner.hide();
        }
    });

})(jQuery);