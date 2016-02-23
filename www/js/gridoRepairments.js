/*
Opravuje chyby vykreslovania grid po prevode na nette2.3.
Príčiny chýb: aktualizácia pluginov.
*/

/*
 * Grido v niektorých prípadoch chybne generuje do sĺpca "actions" 
 * biele medzery medzi html tag "search" a html tag "reset".
 * Príkladom je newsGrid z backendu...
 */
var headActions = document.getElementsByClassName("buttons");
if (headActions.length > 0) {
	var search = headActions[0].children[0];
	var reset = headActions[0].children[1];

	headActions[0].innerHTML = "";
	headActions[0].appendChild(search);
	headActions[0].appendChild(reset);
}