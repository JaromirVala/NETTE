<?php
// source: I:\server\www\projects\sandbox\app\presenters/templates/@layout.latte

class Template7a507b755e5d3b73650af6d1120ccf33 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9b440db571', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb5f6e38f886_head')) { function _lb5f6e38f886_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block _flashes
//
if (!function_exists($_b->blocks['_flashes'][] = '_lba882d492f8__flashes')) { function _lba882d492f8__flashes($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('flashes', FALSE)
;$iterations = 0; foreach ($flashes as $flash) { ?>  	<div<?php if ($_l->tmp = array_filter(array('flash', $flash->type))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>


<?php call_user_func(reset($_b->blocks['scripts-1']), $_b, get_defined_vars())  ?>

<?php
}}

//
// block scripts-1
//
if (!function_exists($_b->blocks['scripts-1'][] = '_lbff91acc044_scripts_1')) { function _lbff91acc044_scripts_1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <script>
        setTimeout(function(){ $(".flash").fadeOut(3000); }, 3000);
    </script>

<?php
}}

//
// block _calculated
//
if (!function_exists($_b->blocks['_calculated'][] = '_lb8a91e26ece__calculated')) { function _lb8a91e26ece__calculated($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('calculated', FALSE)
?>    <div id="display"><?php echo Latte\Runtime\Filters::escapeHtml($display, ENT_NOQUOTES) ?></div>


<?php call_user_func(reset($_b->blocks['scripts-2']), $_b, get_defined_vars())  ?>

<?php
}}

//
// block scripts-2
//
if (!function_exists($_b->blocks['scripts-2'][] = '_lbf1b4898d7c_scripts_2')) { function _lbf1b4898d7c_scripts_2($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        <script>
            var str = $("#display").html();
            str = htmlDecode(str);
            var $displayCalculate   = $( '#displayCalculate' );
            var $displayCalculateIn = $( '<span id="displayLabel">Output: </span><div id="displayCalculateIn" class="text"></div>' );
            $displayCalculate.html( $displayCalculateIn );
            str = str.replace(/  /g, "");
            $("#displayCalculateIn").html(str);
            $("#display").html('');
        </script>

<?php
}}

//
// block scripts-3
//
if (!function_exists($_b->blocks['scripts-3'][] = '_lbe3d6dbee9a_scripts_3')) { function _lbe3d6dbee9a_scripts_3($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<!--script src="https://code.jquery.com/jquery-1.12.0.min.js"></script-->
	<!--script src="https://nette.github.io/resources/js/netteForms.min.js"></script-->
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/nette.ajax.js"></script> 
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>

<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start(function () {});}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title><?php if (isset($_b->blocks["title"])) { ob_start(function () {}); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Nette Sandbox</title>

	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/style.css">
	<meta name="viewport" content="width=device-width">
  <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery-3.2.1.js"></script>
  <script>
      /* HTML tag to HTML entity*/
      function htmlEncode(value){ return $('<div/>').text(value).html();}
      /* HTML entity to HTML tag */
      function htmlDecode(value){ return $('<div/>').html(value).text();}
  </script>


	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>


</head>

<body>





<div id="<?php echo $_control->getSnippetId('flashes') ?>"><?php call_user_func(reset($_b->blocks['_flashes']), $_b, $template->getParameters()) ?>
</div>



<div id="<?php echo $_control->getSnippetId('calculated') ?>"><?php call_user_func(reset($_b->blocks['_calculated']), $_b, $template->getParameters()) ?>
</div>

<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>



<?php call_user_func(reset($_b->blocks['scripts-3']), $_b, get_defined_vars())  ?>


</body>
</html>
<?php
}}