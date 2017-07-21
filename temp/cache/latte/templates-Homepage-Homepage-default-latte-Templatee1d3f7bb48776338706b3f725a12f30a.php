<?php
// source: I:\server\www\projects\sandbox\app\presenters/templates/Homepage/./Homepage.default.latte

class Templatee1d3f7bb48776338706b3f725a12f30a extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('369bdc1ecf', 'html')
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

<?php echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin($form = $_form = $_control["myForm"], array()) ?>

<div style="background:lightblue;width:100%;">
<br>


<div style="background:lightblue;width:auto;float:left;">
<?php echo $_form["inputValue"]->getControl() ?>

</div>


<div style="background:lightblue;width:auto;float:left;">
<?php if ($_label = $_form["INP1"]->getLabel()) echo $_label  ?> <?php echo $_form["INP1"]->getControl() ?><br>
<?php if ($_label = $_form["INP2"]->getLabel()) echo $_label  ?> <?php echo $_form["INP2"]->getControl() ?><br> 
<?php if ($_label = $_form["INP3"]->getLabel()) echo $_label  ?> <?php echo $_form["INP3"]->getControl() ?><br>
<?php if ($_label = $_form["INP4"]->getLabel()) echo $_label  ?> <?php echo $_form["INP4"]->getControl() ?><br> 
<?php if ($_label = $_form["INP5"]->getLabel()) echo $_label  ?> <?php echo $_form["INP5"]->getControl() ?><br>
<?php if ($_label = $_form["INP6"]->getLabel()) echo $_label  ?> <?php echo $_form["INP6"]->getControl() ?><br>
<?php if ($_label = $_form["INP7"]->getLabel()) echo $_label  ?> <?php echo $_form["INP7"]->getControl() ?>

</div>

<hr style="width:100%;clear:both;height:0;border:0;">

<br>

<div style="width:82px;height:22px;margin:0;margin:auto;">
 <?php echo $_form["send"]->getControl() ?>

</div>

<br>
</div>


<?php echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd($_form) ?>


<div id="displayCalculate"></div>
<?php
}}