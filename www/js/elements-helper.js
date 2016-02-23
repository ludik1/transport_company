function initElementsHelper(elHelper) {
	var ElementsHelper = document.ElementsHelper = {};
	ElementsHelper.selector = SimpleSelector({
		onClick: function(e) {
			var data = {};
			data[elHelper.param] = minifiedLocator(e);
			//Zobrazíme formulár
			$.nette.ajax({
				url: elHelper.formUrl,
				data: data
			});
			ElementsHelper.stop();
		},
		filter: "input, textarea, button, a.btn, h1, h2, h3, h4, h5, h6, label, .select2-container, li > a"
	});
	ElementsHelper.start = (function() {
		this.selector.start();
	});
	ElementsHelper.stop = (function() {
		this.selector.stop();
	});
	
	ElementsHelper.createTooltip = (function(selector, content) {
		var actions = elHelper.actions.replace(new RegExp('__SELECTOR_PLACEHOLDER__', 'g'), encodeURIComponent(selector));

		var showIcon = $(selector).is("input:not([type='submit']), textarea, .select2-container");
		if (!showIcon) {
			$(selector).addClass("inline-help-inline");
		}

		$(selector).tooltipster({
			functionReady: function(origin, tooltip) {
				$('.tooltip-action-icons a').click(function(e) {
					$.nette.ajax($(this).attr('href'));
					e.preventDefault();
				});
			},
			contentAsHTML: true,
			iconDesktop: showIcon,
			iconToutch: showIcon,
			icon: '?',
			position: showIcon ? 'right' : 'top',
			interactive: true,
			theme: 'tooltipster-light',
			content: content.replace(/(?:\r\n|\r|\n)/g, '<br>')+actions
		});
	});
	
	// vypnutie selectora pri stlaceni ESC...
	$(document).keyup(function(e) {
		if (e.keyCode === 27) {
			ElementsHelper.stop(); // esc
		}
	});

	//Po ajaxovom načitani formu tento form presunieme nad element kde sa bude poznámka písať (možno vynechať a zobraziť form na stred obrazovky v modal okne...
	$.nette.ext('elements.helper', {
		init: function () {
			var form = $('#helpFormBox');
			if (form.length > 0) {
				this.setPosition(form);
			}
		},
		success: function (payload) {
			var snippets;
			if (!payload.snippets || !(snippets = this.ext('snippets')))
				return;
			for (var id in payload.snippets) {
				if (this.endsWith(id, 'helpFormSnippet')) {
					this.setPosition($(payload.snippets[id]));
				}
			}
			
			if (payload.helpChanged !== undefined) {
				if (payload.helpChanged.old !== undefined) {
					$(payload.helpChanged.old).tooltipster('destroy');
					$(payload.helpChanged.old).attr('title', '');
				}
				if (payload.helpChanged.new !== undefined) {
					ElementsHelper.createTooltip(payload.helpChanged.new.selector, payload.helpChanged.new.help_message);
				}
			}
		}
	}, {
		setPosition: function(form) {
			var selector = form.find('input[name="selector"]').val();
			if ($(selector).length > 0) {
				var pos = $(selector).position();
				$("#helpFormBox").css("top", pos.top+$(selector).outerHeight());
				$("#helpFormBox").css("left", pos.left);
			}
		},
		endsWith: function(str, suffix) {
			return str.indexOf(suffix, str.length - suffix.length) !== -1;
		}
	});
	
	//Treba aby sa vytvorili až na konci, po všetkých ostatných pluginoch
	$(document).ready(function() {
		//Init tooltipov
		for (var i in elHelper.data) {
			ElementsHelper.createTooltip(i, elHelper.data[i]);
		}
	});
};

$.fn.focusWithoutScrolling = function(){
  var x = window.scrollX, y = window.scrollY;
  this.focus();
  window.scrollTo(x, y);
  return this; //chainability

};
