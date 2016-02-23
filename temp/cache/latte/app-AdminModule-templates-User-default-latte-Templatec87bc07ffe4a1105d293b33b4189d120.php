<?php
// source: C:\xampp\htdocs\TransportCompany\app\AdminModule/templates/User/default.latte

class Templatec87bc07ffe4a1105d293b33b4189d120 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('998e5fa64b', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe906035bc2_content')) { function _lbe906035bc2_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<div style="padding-top: 30px; width: 80%; margin:0 auto;">
<?php $_l->tmp = $_control->getComponent("usersGrid"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
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
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Homepage:"), ENT_COMPAT) ?>
"><span>Home</span></a></li>
   <li class='active has-sub'><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:User:default"), ENT_COMPAT) ?>
">Užívatelia</a></li>
   <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Car:default"), ENT_COMPAT) ?>
">Vozidlá</a></li>
   <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Product:default"), ENT_COMPAT) ?>
">Produkt</a></li>
   <li class='last'><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Homepage:"), ENT_COMPAT) ?>
">Prejsť na web</a></li>
</ul>
</div>

</body>
</html>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/grido.js"></script>
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/gridoBackendRepairments.css">
<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/grido.css">

<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:User:add"), ENT_COMPAT) ?>
"><span>Pridať užívateľa</span></a>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>
<style>
#cssmenu ul,
#cssmenu li,
#cssmenu span,
#cssmenu a {
  border: 0;
  margin: 0;
  padding: 0;
  position: relative;
}
#cssmenu {
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  background: #f2edea url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAA0CAIAAADEwMXAAAAAA3NCSVQICAjb4U/gAAAAMklEQVQImWP49PYV0////6GYAcFm+I9d/P9/JgZkcRR12NVDzMMihlMtRJyBkHpMNwIA6ZmLp7k56KwAAAAASUVORK5CYII=) 100% 100%;
  box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.15);
  background: -moz-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f2edea), color-stop(100%, #c0bebf));
  background: -webkit-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: -o-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: -ms-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: linear-gradient(to bottom, #f2edea 0%, #c0bebf 100%);
  font-weight: 600;
  height: 52px;
  width: auto;
}
#cssmenu:after,
#cssmenu ul:after {
  content: '';
  display: block;
  clear: both;
}
#cssmenu a {
  box-shadow: inset 0 1px 0 whitesmoke;
  -moz-box-shadow: inset 0 1px 0 whitesmoke;
  -webkit-box-shadow: inset 0 1px 0 whitesmoke;
  background: #f2edea url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAA0CAIAAADEwMXAAAAAA3NCSVQICAjb4U/gAAAAMklEQVQImWP49PYV0////6GYAcFm+I9d/P9/JgZkcRR12NVDzMMihlMtRJyBkHpMNwIA6ZmLp7k56KwAAAAASUVORK5CYII=) 100% 100%;
  background: -moz-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f2edea), color-stop(100%, #c0bebf));
  background: -webkit-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: -o-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: -ms-linear-gradient(top, #f2edea 0%, #c0bebf 100%);
  background: linear-gradient(to bottom, #f2edea 0%, #c0bebf 100%);
  color: #666666;
  display: inline-block;
  font-family: Arial, Verdana, sans-serif;
  font-size: 12px;
  line-height: 52px;
  padding: 0 28px;
  text-decoration: none;
}
#cssmenu ul {
  list-style: none;
  box-shadow: inset 0 1px 0 whitesmoke;
  -moz-box-shadow: inset 0 1px 0 whitesmoke;
  -webkit-box-shadow: inset 0 1px 0 whitesmoke;
}
#cssmenu > ul {
  float: left;
}
#cssmenu > ul > li {
  float: left;
}
#cssmenu > ul > li:first-child a {
  border-radius: 5px 0 0 5px;
  -moz-border-radius: 5px 0 0 5px;
  -webkit-border-radius: 5px 0 0 5px;
}
#cssmenu > ul > li.active a,
#cssmenu > ul > li:hover > a {
  box-shadow: inset 0 -2px 3px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: inset 0 -2px 3px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: inset 0 -2px 3px rgba(0, 0, 0, 0.15);
  color: white;
  background: #4a5662 url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAA0CAIAAADEwMXAAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkNDNkM2QzM1NDk0QjExRTI5NjFDQzlFM0NGQzY5RDNBIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkNDNkM2QzM2NDk0QjExRTI5NjFDQzlFM0NGQzY5RDNBIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6Q0M2QzZDMzM0OTRCMTFFMjk2MUNDOUUzQ0ZDNjlEM0EiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6Q0M2QzZDMzQ0OTRCMTFFMjk2MUNDOUUzQ0ZDNjlEM0EiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6bEPV5AAAAUUlEQVR42mSO0RWAMAgDc4znAA7g/jvUFKj66gevCT0COs4rJLkIoSC1X+j+7GFfupj+a4bFu+isydcMr88dY/PkLL8bPnrLXTvHk2NdzC3AAIj5BKfn0x2aAAAAAElFTkSuQmCC);
  background: -moz-linear-gradient(top, #4a5662 0%, #606f7f 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #4a5662), color-stop(100%, #606f7f));
  background: -webkit-linear-gradient(top, #4a5662 0%, #606f7f 100%);
  background: -o-linear-gradient(top, #4a5662 0%, #606f7f 100%);
  background: -ms-linear-gradient(top, #4a5662 0%, #606f7f 100%);
  background: linear-gradient(to bottom, #4a5662 0%, #606f7f 100%);
}
#cssmenu .has-sub {
  z-index: 1;
}
#cssmenu .has-sub:hover > ul {
  display: block;
}
#cssmenu .has-sub ul {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
  display: none;
  position: absolute;
  width: 200px;
  top: 100%;
  left: 0;
}
#cssmenu .has-sub ul li a {
  background: #606f7f;
  border-bottom: 1px solid #59636f;
  border-bottom: 1px solid #556371;
  box-shadow: inset 0 1px 0 #606f7f;
  -moz-box-shadow: inset 0 1px 0 #606f7f;
  -webkit-box-shadow: inset 0 1px 0 #606f7f;
  color: white;
  display: block;
  line-height: 160%;
  padding: 15px 10px;
  font-size: 12px;
}
#cssmenu .has-sub ul li:hover a {
  background: #4a5662;
  box-shadow: inset 0 0 3px 1px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: inset 0 0 3px 1px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: inset 0 0 3px 1px rgba(0, 0, 0, 0.15);
}
#cssmenu .has-sub .has-sub:hover > ul {
  display: block;
}
#cssmenu .has-sub .has-sub ul {
  display: none;
  position: absolute;
  left: 100%;
  top: 0;
}
#cssmenu .has-sub .has-sub ul li a {
  background: #606f7f;
  box-shadow: none;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
}
#cssmenu .has-sub .has-sub ul li a:hover {
  background: #4a5662;
  box-shadow: inset 0 0 3px 1px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: inset 0 0 3px 1px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: inset 0 0 3px 1px rgba(0, 0, 0, 0.15);
}

</style><?php
}}