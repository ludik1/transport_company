<?php
// source: C:\xampp\htdocs\TransportCompany\app\FrontModule/templates/Auth/registration.latte

class Template010ffc8cc16f1c441fc67ac4ef88e902 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2111bb0158', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/frontend.css">
<div class="content_box">
<?php $_l->tmp = $_control->getComponent("registrationForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Auth:registration"), ENT_COMPAT) ?>
">Registrácia</a>
</div>
<?php $iterations = 0; foreach ($flashes as $flash) { ?><div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?>
</div><?php $iterations++; } 
}}