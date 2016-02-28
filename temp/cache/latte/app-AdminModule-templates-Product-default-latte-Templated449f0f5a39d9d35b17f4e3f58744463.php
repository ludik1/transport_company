<?php
// source: C:\xampp\htdocs\TransportCompany\app\AdminModule/templates/Product/default.latte

class Templated449f0f5a39d9d35b17f4e3f58744463 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7110574791', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb4d98c31fb1_content')) { function _lb4d98c31fb1_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<div style="padding-top: 30px; width: 80%; margin:0 auto;">
<?php $_l->tmp = $_control->getComponent("productsGrid"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	</div>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

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
<?php $iterations = 0; foreach ($flashes as $flash) { ?><div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

<a class="button" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Product:add"), ENT_COMPAT) ?>
">Pridať produkt</a>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}