<?php
// source: C:\xampp\htdocs\TransportCompany\app\FrontModule/templates/Homepage/default.latte

class Templatede91ea83e91ed9277942601a64d0ecd6 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('f6fa7f1c8c', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb5553f1d232_content')) { function _lb5553f1d232_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($user->loggedIn) { ?><div>
	<a style="text-align: right;" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Homepage:"), ENT_COMPAT) ?>
">administrácia</a>
</div>
<?php } if (!$user->loggedIn) { ?><div>
	<a style="text-align: right;" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Auth:login"), ENT_COMPAT) ?>
">prihlásenie</a>
</div>
<?php } ?>
<div id="banner">
<?php call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>
</div>
<div class="btn">
	aa
</div>
<div id="content">
	<h2>You have successfully created your Nette Framework project.</h2>
	<div>
 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam efficitur sapien sit amet placerat egestas. Integer sit amet mattis odio. Vivamus egestas dui est, eu lacinia lorem maximus nec. Nullam efficitur tincidunt justo, ac congue justo. Nam erat tortor, vulputate ut lacus ut, semper convallis odio. Donec consequat convallis facilisis. Aliquam vitae euismod urna, eu porta magna. Nulla non eros ac velit hendrerit pellentesque. Sed quis semper sem, vel viverra ipsum. Duis eget porttitor ante, eget varius dolor. Quisque vel tortor scelerisque, imperdiet lorem vitae, vulputate urna. Nunc hendrerit, lacus eget viverra ultricies, ex odio lacinia dolor, in interdum neque turpis ut nisl.

Nullam interdum tellus dolor, et luctus urna semper eget. Cras pulvinar condimentum erat, finibus consectetur sem sodales ac. Suspendisse nisi purus, ullamcorper vitae viverra non, interdum non velit. Fusce in nisi elit. Sed neque odio, porttitor sit amet pellentesque non, dapibus ac augue. Phasellus vitae semper erat. Duis tincidunt enim in lectus vulputate luctus. Sed condimentum velit dui, eu cursus nunc tristique eget.

Vivamus elit sapien, consequat sollicitudin pharetra vel, eleifend non est. Maecenas blandit arcu id mattis faucibus. Proin nisi augue, pellentesque id neque in, lobortis scelerisque dui. Morbi sollicitudin tempus enim a aliquet. Phasellus maximus feugiat lorem, id auctor leo venenatis sit amet. Cras eget blandit ligula. Etiam nec erat quam. Suspendisse et dictum orci. Donec ut finibus lacus. Aenean vitae ipsum vitae est dapibus interdum ac vitae enim.

Vestibulum id tortor quis nulla porttitor vehicula eget vitae justo. Phasellus elit tellus, euismod id ex id, hendrerit tincidunt est. Fusce nec massa mi. Sed in lorem leo. Nullam semper risus vitae diam tincidunt egestas. Donec ut faucibus ante. Morbi varius nisl at dui tincidunt, at aliquet nisi faucibus. In ac fermentum ligula. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque eu fermentum sapien, at condimentum nulla. Sed a neque at arcu porta tempus in vel arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nec sapien ut sem facilisis iaculis. Ut felis eros, sodales eu nibh nec, hendrerit finibus leo. Praesent mauris elit, tristique vitae semper non, porttitor nec velit. Vivamus molestie erat a sapien commodo imperdiet.

Nam dignissim est id ex mollis, eu vestibulum mi consequat. Cras purus neque, lacinia eget convallis ac, rhoncus quis urna. Suspendisse tincidunt ac metus in accumsan. Mauris mattis finibus felis. Aenean mattis dapibus suscipit. Suspendisse vitae tortor vitae diam porttitor maximus. Phasellus vel purus dolor. Aliquam ut iaculis magna, nec euismod est. Phasellus a faucibus lectus, eu elementum mauris.

Donec mollis tellus volutpat urna ultricies, sit amet pharetra magna fringilla. Mauris nibh elit, sagittis et augue et, pretium tristique nulla. Quisque sagittis non tellus sed lacinia. Nulla sapien mi, tempor vel elementum vitae, tincidunt non justo. Donec varius in ligula at congue. Duis sed nisl semper, iaculis turpis at, pharetra quam. In non suscipit nisl. Donec convallis est ac pulvinar blandit. Aenean porta risus eu est pretium laoreet. Vestibulum ac rutrum magna.

Vivamus luctus vulputate hendrerit. Donec consectetur, lectus ac suscipit sodales, libero velit ultricies libero, a dapibus est turpis a risus. Praesent et erat est. In porttitor neque lorem, sed tristique lectus commodo euismod. Praesent eget volutpat urna. Etiam convallis blandit ante, ac lacinia augue tempor id. Etiam vestibulum lectus a lectus gravida tincidunt. Fusce turpis ligula, iaculis quis commodo a, posuere id lectus. Pellentesque et arcu nisl. Nam imperdiet velit magna, ac lobortis ex hendrerit eget. Donec nisi nulla, auctor ut mauris a, dignissim condimentum augue. In quis tincidunt nibh. Maecenas vehicula interdum mi.

Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut nulla purus, dictum et odio ut, vulputate suscipit nisl. Proin sit amet lectus enim. Vivamus vel vestibulum libero. Suspendisse sagittis augue nec fringilla consequat. Praesent interdum, lorem et cursus pretium, quam mauris auctor erat, nec fermentum elit mauris vitae tellus. Vivamus quis blandit urna, vel sagittis arcu. Donec tincidunt nibh tempus nulla faucibus semper. Aenean sed elit fermentum, convallis diam interdum, condimentum ligula. Etiam semper scelerisque augue eget vehicula. Sed suscipit blandit purus rutrum tristique. Mauris et nulla id odio pharetra lobortis ac sed nibh. Quisque fermentum et odio eget scelerisque. Donec vitae tincidunt odio, nec mollis sapien.

Curabitur non nisi tempus mauris lacinia consectetur. Fusce finibus rutrum nisi eu mattis. Aliquam justo ipsum, tempor nec magna eget, volutpat aliquet magna. Duis sit amet gravida urna. In ut euismod nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin commodo mi in erat tincidunt, quis eleifend mi accumsan. In eu porttitor ex. Aenean eget eleifend felis. Aenean sagittis imperdiet mi. Cras a nisi maximus, ultricies lorem eu, placerat eros. Morbi auctor velit ac lacus pulvinar semper. Duis tortor elit, pellentesque nec nibh ac, lacinia lobortis lectus. Duis consequat nisi erat, eget lacinia diam sollicitudin pellentesque. Vestibulum ac leo vestibulum, fermentum ex ut, tincidunt neque.

Mauris ultricies nisl arcu, ut euismod ipsum congue sed. Donec cursus urna vitae enim pharetra blandit. Donec id auctor lacus, eu maximus est. Nullam hendrerit elit sapien. Phasellus ultrices libero vel condimentum commodo. Donec volutpat semper nibh viverra suscipit. Donec eget nisl sem.

Cras mauris tellus, finibus at ultrices a, feugiat nec nibh. Ut eget nunc hendrerit massa facilisis fringilla. Fusce luctus libero non molestie elementum. Sed quam risus, tristique vitae tempor eget, dignissim id mi. Sed aliquam pharetra hendrerit. Maecenas at urna nunc. Sed ultrices, lectus in condimentum tincidunt, tellus mauris lobortis mi, sed sollicitudin risus mi id urna. Fusce ultrices, dui vel interdum eleifend, nisi leo auctor elit, ut vulputate quam odio quis mi. Integer dapibus pulvinar faucibus. In imperdiet iaculis velit, et malesuada sem convallis et. Duis rhoncus at nisi ac porta. Nam nec ullamcorper tellus.

Sed sollicitudin arcu lacus, sed dictum eros faucibus interdum. Suspendisse accumsan eget nibh quis sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce pellentesque urna ex, in euismod orci varius sed. Vestibulum eget pharetra dui. Curabitur sed justo in leo tempor feugiat ornare vel mi. Aenean vel eros turpis. Cras vestibulum nec dui ac ultrices. Aliquam ac maximus erat, quis maximus augue. Quisque egestas venenatis mollis. Etiam ut viverra erat. Sed rutrum enim sed ipsum accumsan feugiat. Proin sit amet libero ac ipsum aliquam consequat sed id lorem. Maecenas facilisis convallis velit eu gravida. Aliquam convallis, magna a finibus ultrices, leo tellus posuere felis, eu vehicula ante tortor convallis mi. Morbi at massa placerat, consectetur risus in, faucibus ante.

Mauris a fermentum magna. Fusce est nulla, posuere ac ante non, vestibulum lobortis eros. Aliquam tortor lectus, vulputate sed tristique a, interdum id eros. Aenean dolor dolor, volutpat vitae iaculis vitae, lobortis vitae odio. Donec ut pharetra diam. Duis bibendum augue sit amet odio luctus mollis. Mauris sit amet felis ultricies, dignissim diam ac, laoreet orci. Sed in ante vulputate, pulvinar est ut, lacinia ligula.

Ut quis neque velit. Suspendisse tempor, felis et viverra malesuada, dolor purus egestas nibh, vel ultricies ligula nibh sit amet dui. Mauris vulputate dui eu dolor fermentum congue. Ut id neque massa. Nunc scelerisque nisi eget elit semper consectetur. Aliquam interdum luctus dui, vitae posuere lorem posuere ac. Nam feugiat dui tortor, non sodales felis varius eget. Curabitur in orci risus. In leo est, egestas vel auctor eu, blandit vitae risus.

Aliquam sit amet rutrum nunc, a blandit nulla. Morbi vel arcu ac tortor maximus posuere. Praesent placerat magna mi, sit amet cursus orci consequat sed. Duis eleifend odio vel ligula lobortis, sit amet consequat erat tincidunt. Quisque ligula erat, volutpat venenatis finibus auctor, tempor eget enim. Pellentesque iaculis et nibh ac varius. Phasellus ut dolor feugiat, egestas nisi ac, aliquet dui. Phasellus fermentum sagittis dui nec dictum. Suspendisse et fringilla nisi. Mauris sit amet est quis metus egestas dictum. Donec lobortis arcu ut velit placerat, eu eleifend massa dignissim. Curabitur euismod libero ut turpis placerat tincidunt. Suspendisse potenti. Integer sed tortor eu lacus varius finibus. Proin sed maximus turpis.

Nullam porta sem in sodales aliquam. Vestibulum vulputate leo elit, quis aliquet neque hendrerit a. Morbi ac posuere est, a vehicula sapien. Proin bibendum semper purus. Duis sapien ligula, pellentesque tincidunt nisl id, consectetur mattis justo. Proin in porta ante. Nam rutrum, nunc a cursus dapibus, metus leo pulvinar purus, a sollicitudin sem odio non lectus. Nulla eget ipsum at nisl tincidunt sagittis. Proin eget iaculis orci, id volutpat arcu. Maecenas dignissim auctor leo ut lobortis. Nullam vitae nunc sit amet augue interdum luctus. Suspendisse varius molestie massa. Donec sagittis mauris eget ipsum cursus sagittis. 

	</div>

	<section id="template">
		<h2>This page template located at <span><?php echo Latte\Runtime\Filters::escapeHtml(strstr($presenter->template->getFile(), 'app'), ENT_NOQUOTES) ?></span></h2>

		<pre><code class="jush"><?php echo Latte\Runtime\Filters::escapeHtml($template->replacere(file_get_contents($presenter->template->getFile()), '#[\w+/]{60,}#', '…'), ENT_NOQUOTES) ?></code></pre>
	</section>

	<section id="layout">
		<h2>Layout template located at <span><?php echo Latte\Runtime\Filters::escapeHtml(strstr($template->getName(), 'app'), ENT_NOQUOTES) ?></span></h2>

		<pre><code class="jush"><?php echo Latte\Runtime\Filters::escapeHtml(file_get_contents($template->getName()), ENT_NOQUOTES) ?></code></pre>
	</section>

	<section id="presenter">
		<h2>Current presenter located at <span><?php echo Latte\Runtime\Filters::escapeHtml(strstr($presenter->getReflection()->getFileName(), 'app'), ENT_NOQUOTES) ?></span></h2>

		<pre><code class="jush-php"><?php echo Latte\Runtime\Filters::escapeHtml(file_get_contents($presenter->getReflection()->getFileName()), ENT_NOQUOTES) ?></code></pre>
	</section>
</div>
<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbb710fea7b6_title')) { function _lbb710fea7b6_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<h1>L-Trans</h1>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb7712cbb3d6_head')) { function _lb7712cbb3d6_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>



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