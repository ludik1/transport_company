

/*
 * Jednoduchá verzia FireBug selektora založená na jquery funkciách.
 *
 * @param options.clickOn: callback funkcia volaná pri kliknutí na element,
 *                         ktorý prešiel filtrom (default: no-op).
 *
 * @param options.filter: jquery selektor pre určenie, ktorých elementov
 *                        sa bude týkať selekcia (default: "*").
 *
 * Príklad:
 * ----------------------------------------------------------------
 * <html>
 *    <script src="jquery-2.1.4.js"></script>
 *    <script src="SimpleSelector/simple-selector.js"></script>
 *    <link rel="stylesheet" type="text/css" href="SimpleSelector/simple-selector.css" />
 *    ...
 *    <body>
 *        <script>
 *            $( document ).ready(function() {
 *                var simpleSelector = SimpleSelector({
 *                    onClick: function(e) {
 *                        alert(e.tagName);
 *                    },
 *                    filter: "ul, li"
 *                });
 *
 *                simpleSelector.start();
 *                ...
 *                simpelSelector.stop();
 *            });
 *        </script>
 *        ...
 *    <body>
 * </html>
 * ----------------------------------------------------------------
 *
 * Pre zmenu štýlov označeného elementu treba upraviť súbor
 * "simple-selector.css", konkrétne štýly "actived".
 *
 * Spracované podľa (upravené označovanie):
 * http://jsfiddle.net/Jkj2n/255/#
 *
 * Plugin pattern (implementácia nie je to pajcnutá :D):
 * https://github.com/smmalmansoori/jQuery.DomOutline
 */
var SimpleSelector = function( options ) {
    options = options || {};

    // privátne členy funkcie SimpleSelector obalené v štruktúre (zapuzdrenie)
    var self = {
        opts: {
            onClick: options.onClick || function(e) {},
            filter: options.filter || "*"
        },
        current: null,
		markerClass: "actived",
        mynamespace: "SimpleSelector",
    };

    // štruktura navrátená ako výsledok funkcie - bude obsahovať funkcie,
    // pre zmenu stavu selectora (controller).
    var pubStruct = {};

    pubStruct.start = function() {
        bindActions();
    };

    function bindActions() {
      /*
      V nasledujúcom riešení neoznačuje správne elementy
      pri odchode z elementu na element
      ______________________
     |                     |
     |  e2    _____________|
     |       |      e1     |
     |_______|_____________|
      ------------------------------------------------
      $("*").on("mouseenter", function(event) {
            $(this).addClass("actived");
            $(this).parents().removeClass("actived");
            event.stopPropagation();

      }).on("mouseleave", function() {
          $(this).removeClass("actived");
          $(this).parent().addClass("activted");
      });
      */
      $(self.opts.filter).on("click."+self.mynamespace, function(event) {
          self.opts.onClick(this);
          // zhodné s event.stopPropagation();
          return false;

      }).on("mouseenter."+self.mynamespace, function(event) {
          if (self.current == null) {
              $(this).addClass(self.markerClass);
              self.current = this;

          } else {
              $(self.current).removeClass(self.markerClass);
              $(this).addClass(self.markerClass);
              self.current = this;
          }
          // zabranuje notifikácií parenta o evente
          event.stopPropagation();

      }).on("mouseleave."+self.mynamespace, function(event) {
          $(self.current).removeClass(self.markerClass);
          self.current = $(this).parent();
          $(self.current).addClass(self.markerClass);
          // zabranuje notifikácií parenta o evente
          event.stopPropagation();
      });
    }

    pubStruct.stop = function() {
        unbindActions();
		// pri ukonceni zostane posledny element oznaceny = treba odobrat marker triedu...
		$("."+self.markerClass).removeClass(self.markerClass);
    };

    function unbindActions() {
        $(self.opts.filter).off("click."+self.mynamespace);
        $(self.opts.filter).off("mouseenter."+self.mynamespace);
        $(self.opts.filter).off("mouseleave."+self.mynamespace);
    }

    // navrátenie "kontrolera" pre ovládanie pluginu...
    return pubStruct;
};
