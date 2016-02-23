<?php
// source: C:\xampp\htdocs\TransportCompany\app\FrontModule/templates/Auth/login.latte

class Template7e28a857d628b6a4a91d5935076324ef extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('19961f23ee', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
$_l->tmp = $_control->getComponent("loginForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Auth:registration"), ENT_COMPAT) ?>
">Registrácia</a>

<?php
}}