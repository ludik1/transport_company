<?php
// source: C:\xampp\htdocs\TransportCompany\app\AdminModule/templates/Product/add.latte

class Template3fe490f48fa574075a3055e164a35d43 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2bc57e9a6d', 'html')
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
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/grido.js"></script>
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/gridoBackendRepairments.css">
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/grido.css">
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/backend.css">
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/menu.css" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<div id='cssmenu'>
<ul>
   <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Homepage:"), ENT_COMPAT) ?>
"><span>Home</span></a></li>
<?php if ($user->isInRole(1)) { ?>   <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:User:default"), ENT_COMPAT) ?>
">Užívatelia</a></li>
<?php } if ($user->isInRole(1)) { ?>   <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Car:default"), ENT_COMPAT) ?>
">Vozidlá</a></li>
<?php } ?>
   <li class='active has-sub'><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Product:default"), ENT_COMPAT) ?>
">Produkt</a></li>
   <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Homepage:"), ENT_COMPAT) ?>
">Prejsť na web</a></li>
   <li class='last'><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Auth:out"), ENT_COMPAT) ?>
">Odhlásiť</a></li>
</ul>
</div>
<div class="content_box">
<?php $_l->tmp = $_control->getComponent("productForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
</div><?php
}}