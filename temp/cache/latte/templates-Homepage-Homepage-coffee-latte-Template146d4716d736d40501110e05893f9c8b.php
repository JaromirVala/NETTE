<?php
// source: I:\server\www\projects\sandbox\app\presenters/templates/Homepage/./Homepage.coffee.latte

class Template146d4716d736d40501110e05893f9c8b extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('da61826921', 'html')
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
<div id="machine">
	<p id="display">Dobrou chuť</p>



	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("buy!"), ENT_COMPAT) ?>"><img id="button" src="images/button.png" alt="Kup kávu"></a>

	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("default"), ENT_COMPAT) ?>"><img id="cup" src="images/cup.png" alt="Kelímek s kávou"></a>




</div>
<ul id="coins">
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("insert!", array(1)), ENT_COMPAT) ?>" class="ajax"><img src="images/coin-1.png" alt="Vhoď 1 Kč"></a></li>
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("insert!", array(2)), ENT_COMPAT) ?>" class="ajax"><img src="images/coin-2.png" alt="Vhoď 2 Kč"></a></li>
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("insert!", array(5)), ENT_COMPAT) ?>" class="ajax"><img src="images/coin-5.png" alt="Vhoď 5 Kč"></a></li>
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("insert!", array(10)), ENT_COMPAT) ?>" class="ajax"><img src="images/coin-10.png" alt="Vhoď 10 Kč"></a></li>
</ul>
<p id="caution"><b>Upozornění: odeberte kelímek, a kupte kávu i kamarádovi</b></p>

<?php
}}