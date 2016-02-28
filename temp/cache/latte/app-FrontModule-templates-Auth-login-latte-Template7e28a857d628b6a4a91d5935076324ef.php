<?php
// source: C:\xampp\htdocs\TransportCompany\app\FrontModule/templates/Auth/login.latte

class Template7e28a857d628b6a4a91d5935076324ef extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('19961f23ee', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6116c5a41d_content')) { function _lb6116c5a41d_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="banner">
<?php call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>
</div>
<div class="content_box">
<?php $_l->tmp = $_control->getComponent("loginForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Auth:registration"), ENT_COMPAT) ?>
">Registrácia</a>
</div>
<?php $iterations = 0; foreach ($flashes as $flash) { ?><div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
<script src="https://files.nette.org/sandbox/jush.js"></script>
<script>
	jush.create_links = false;
	jush.highlight_tag('code');
	$('code.jush').each(function(){ $(this).html($(this).html().replace(/\x7B[/$\w].*?\}/g, '<span class="jush-latte">$&</span>')) });

	$('a[href^=#]').click(function(){
		$('html,body').animate({ scrollTop: $($(this).attr('href')).show().offset().top - 5 }, 'fast');
		return false;
	});
</script>



<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lb035336e3bb_title')) { function _lb035336e3bb_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1>L-Trans</h1>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbd25ba43630_head')) { function _lbd25ba43630_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
	html { overflow-y: scroll; }
	body { font: 14px/1.65 Verdana, "Geneva CE", lucida, sans-serif; background: #ffffff; color: #333; margin: 38px auto; max-width: 940px; min-width: 420px; }

	h1, h2 { font: normal 150%/1.3 Georgia, "New York CE", utopia, serif; color: #1e5eb6; -webkit-text-stroke: 1px rgba(0,0,0,0); }

	img { border: none; }

	a { color: #006aeb; padding: 3px 1px; }

	a:hover, a:active, a:focus { background-color: #006aeb; text-decoration: none; color: white; }

	#banner { border-radius: 12px 12px 0 0; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAB5CAMAAADPursXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGBQTFRFD1CRDkqFDTlmDkF1D06NDT1tDTNZDk2KEFWaDTZgDkiCDTtpDT5wDkZ/DTBVEFacEFOWD1KUDTRcDTFWDkV9DkR7DkN4DkByDTVeDC9TDThjDTxrDkeADkuIDTRbDC9SbsUaggAAAEdJREFUeNqkwYURgAAQA7DH3d3335LSKyxAYpf9vWCpnYbf01qcOdFVXc14w4BznNTjkQfsscAdU3b4wIh9fDVYc4zV8xZgAAYaCMI6vPgLAAAAAElFTkSuQmCC); }
	#banner h1 { color: white; font-size: 50px; line-height: 121px; margin: 0; padding-left: 4%; }
	@media (max-width: 600px) {
		#banner h1 { background: none; }
	}

	#content { background: white; border: 2px solid #929292; border-radius: 0 0 12px 12px; padding: 10px 4%; overflow: hidden; }
	#content > h2 { font-size: 130%; color: #666; clear: both; padding: 1.2em 0; margin: 0; }

	h2 span { color: #87A7D5; }
	h2 a { text-decoration: none; background: transparent; }

	.boxes { -webkit-justify-content: space-between; justify-content: space-between; display: -webkit-flex; display: flex; margin-right: -2em; }
	.boxes > div { background: #f0f0f0; border: 1px solid #e6e6e6; border-radius: 5px; -webkit-flex: 1; flex: 1; margin-right: 2em; }
	.boxes h2 { text-align: right; margin: 1em; }
	.boxes img { float: left; }
	.boxes p { clear: both; margin: 1em; }
	.boxes p a { color: #006aeb; background: #f7f7f7; padding: 1px 3px; border-radius: 3px; text-decoration: none; box-shadow: 0 2px 5px rgba(0, 0, 0, .10); }
	.boxes p a:hover, .boxes p a:active, .boxes p a:focus { color: white; background-color: #006aeb; }
	.boxes > div:nth-child(3n - 2) h2 { color: #00a6e5; }
	.boxes > div:nth-child(3n - 2) img { margin: -1em -1em 0 -1em; }
	.boxes > div:nth-child(3n - 1) h2 a { color: #db8e34; background: transparent; }
	.boxes > div:nth-child(3n) h2 a { color: #578404; background: transparent; }
	@media (max-width: 760px) {
		.boxes { -webkit-flex-direction: column; flex-direction: column; }
		.boxes > div { margin-bottom: 1em; flex-basis: auto; }
		.boxes h2 br { display: none; }
	}

	section { display: none; }

	pre { font-size: 12px; line-height: 1.4; padding: 10px; margin: 1.3em 0; overflow: auto; max-height: 500px; background: #F1F5FB; border-radius: 5px; box-shadow: 0 1px 1px rgba(0, 0, 0, .1); }

	.jush-com, .jush-php_doc { color: #929292; }
	.jush-tag, .jush-tag_js { color: #6A8527; font-weight: bold; }
	.jush-att { color: #8CA315 }
	.jush-att_quo { color: #448CCB; font-weight: bold; }
	.jush-php_var { color: #d59401; font-weight: bold; }
	.jush-php_apo { color: green; }
	.jush-php_new { font-weight: bold; }
	.jush-php_fun { color: #254DB3; }
	.jush-js, .jush-css { color: #333333; }
	.jush-css_val { color: #448CCB; }
	.jush-clr { color: #007800; }
	.jush a { color: inherit; background: transparent; }
	.jush-latte { color: #D59401; font-weight: bold }
</style>
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
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/frontend.css">
<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}