  /*
  Požadovaná knižnica: 
  <script src="jquery-2.1.4.js"></script>
  */


  /* ----------------------------- CORE-CODE -------------------------------- */

  /*
  Navráti true, ak element má "súrodenca" s rovnakým tagom.
  */
  function hasEqualTagSibling(e) {
      var sibcount = $(e).parent().children().filter(function(){
          return e.tagName === this.tagName;
      }).length - 1;
      return sibcount > 0;
  }

  /*
  Navráti selektor, ktorý je zostavený z id-ečka (ak je dostupné) alebo
  z názvu tagu a indexu. 
  */
  function locator(e) {
      var id = $(e).attr("id");
      // non-identity with 'undefined' can be replaced by if (!id)
      if (typeof id !== 'undefined') {
        return "#" + id;

      } else {
          /*return (hasEqualTagSibling(e))
              ? e.tagName + ":eq(" + $(e).index() + ")"
              : e.tagName;*/
		  
		  // index je povinný nakoľko samotný selector "div a" pokrýva anchor tagy na všetkých úrovniach divu...
		  
		  return ":eq(" + $(e).index() + ")"; // vdzdz
      }
  }

  /*
  Navráti absolútny unikátny selektor elementu, ktorý zostavený z celej cesty
  počnúc html tagom a končiac tagom samotného elementu, pričom každý tag cesty
  je indexovaný.
  */
  function absoluteLocator(e) {
      var parents = $(e).parents()
          .map(function() {return locator(this);})
          .get()
          .reverse()
          .concat([this.nodeName])
          .join(">");

      return parents + locator(e);
  }

  /*
  To isté čo {@link absoluteLocator} až na to, že cesta je orezaná na najmenšiu
  možnú cestu, ktorá jednoznačne identifikuje element (začína prvým id-ečkom
  nájdeným od konca cesty).
  */
  function minifiedLocator(e) {
      var locator = absoluteLocator(e);
      var index = locator.lastIndexOf("#");
      return (index !== -1)
          ? locator.substring(index)
          : locator;
  }