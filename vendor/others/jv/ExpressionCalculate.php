<?php
/**
 * Created Jaromir Vala 2017
 * jaromir.vala@jaromirvala.cz
 *
 */
 
 
namespace Vendor\Others\jv;



class ExpressionCalculate
{

    // for value type bolean
    public $calculation;

    // calculation expression string
    public $expression_string;


    public function __construct($expression_string)
    {
    $this->expression_string = $expression_string;
    }




/**
 * Helper function: decode HTML entity
 */
    private function uchr ($codes)
    {
        if (is_scalar($codes)) {
            $codes= func_get_args();
        }
            $str= '';
        foreach ($codes as $code) { 
            $str.= html_entity_decode('&#'.$code.';',ENT_NOQUOTES,'UTF-8');
        }
        return $str;
    }




/**
 * Helper function: decode Unicode
 */
    private function unichr($dec)
    { 
        if ($dec < 128) { 
            $utf = chr($dec); 
        } else if ($dec < 2048) { 
            $utf = chr(192 + (($dec - ($dec % 64)) / 64)); 
            $utf .= chr(128 + ($dec % 64)); 
        } else { 
            $utf = chr(224 + (($dec - ($dec % 4096)) / 4096)); 
            $utf .= chr(128 + ((($dec % 4096) - ($dec % 64)) / 64)); 
            $utf .= chr(128 + ($dec % 64)); 
        } 
        return $utf;
    }




/**
 * Easy calculate
 */
    private function calculate($a,$b,$c)
    {

        switch ($c) {
            case "*" : $fn = $a*$b; $this->fn=$fn;
                break;
            case "/" : $fn = $a/$b; $this->fn=$fn;
                break;
            case "+" : $fn = $a+$b; $this->fn=$fn;
                break;
            case "-" : $fn = $a-$b; $this->fn=$fn;
                break;
        }

        return  $this->fn;
    }




/**
 * Get selected regular expression
 */
    private  function getRegEx($o)
    {
        switch ($o) {
            case "*" : $object = function(){

                $a=[];

                $a['spliter']="/([\d\.]*)(\*)([\d\.]+)((?:.{1}[\d\.]*)*)/";

                $a['easyShape']="/([0-9\.]+)(\*)([0-9\.]+)/";

                $a['addFirsrCrop']="/(?:^[^0-9](?:.*?)(?:\w){1,}(?:.*?)(?:\d){1,})/";

                return $a;
                };
                break;

            case "/" : $object = function(){

                $a=[];

                $a['spliter']="/([\d\.]*)(\/)([\d\.]+)((?:.{1}[\d\.]*)*)/";

                $a['easyShape']="/([0-9\.\/]+)(\/)([0-9\.\/]+)/";

                $a['addFirsrCrop']="/(?:^[^0-9](?:.*?)(?:\w){1,}(?:.*?)(?:\d){1,})/";

                return $a;
                };
                break;

            case "+" : $object = function(){

                $a=[];

                $a['spliter']="/([\d\.]*)(\+)([\d\.]+)((?:.{1}[\d\.]*)*)/";

                $a['easyShape']="/([0-9\.]+)(\+)([0-9\.]+)/";

                $a['addFirsrCrop']="/(?:^[^0-9](?:.*?)(?:\w){1,}(?:.*?)(?:\d){1,})/";

                return $a;
                };
                break;

            case "-" : $object = function(){

                $a=[];

                $a['spliter']="/([\d\.]*)(\-)([\d\.]+)((?:.{1}[\d\.]*)*)/";

                $a['easyShape']="/([\-0-9\.]+)(\-)([\-0-9\.]+)/";

                $a['addFirsrCrop']="/(?:^[^0-9](?:.*?)(?:\w){1,}(?:.*?)(?:\d){1,})/";

                return $a;
                };
                break;
        }
        return $object=$object();
    }




/**
 * Get regular expression for priority operation
 */
    private function priorityLeft($x)
    {
        $priorityFirst   ="/^(?:.*?)(\*|\/){1}/";

        $prioritySecond  ="/^(?:.*?)(\+|\-){1}/";
        
        if (preg_match($priorityFirst, $x)){

            preg_match_all($priorityFirst, $x, $match);

            return $match[1][0];
            }
       
        if (preg_match($prioritySecond, $x)){

            preg_match_all($prioritySecond, $x, $match);

            return $match[1][0];
            }
        return false;
    }




/**
 * If exist substring
 */
    private function is($x, $y)
    {
        $y = (string)$y;

        $pos = strpos($y, $x);

        if ($pos !== false) {

            return true; 
        }
        else {

        return false;
        }
    }




/**
 * If this is type number
 */
    private function isNumber($n)
    {
        if (is_numeric($n)){

        return (bool)1;
         }
    return (bool)0;
    }




/**
 * Calculation engine  ( this working recursively )
 */
    private  function calc($x)
    {
        $x = str_replace('(', '', $x);

        $x = str_replace(')','', $x);

        if ($this->priorityLeft($x) != false) {

            $o=$this->priorityLeft($x);

        }

        $spliter    = $this->getRegEx($o)['spliter'];

        $expression = '';

        $xx=[];

        preg_match($spliter,$x,$match);

        $left     = $match[1];

        $right    = $match[3];

        $operator = $match[2];

        $residue  = $match[4];

        if($left && $right  && $operator){

            $replacer = $left.$operator.$right; 

            $calc = $this->calculate($left, $right, $operator);

            $xx[0] =  str_replace($replacer, $calc, $x);

            $xx[1] = '';
        }
        else{
            $cropper    = $this->getRegEx($o)['addFirsrCrop'];

            $cr =  preg_match("/(\W{1})(\d*\.?\d*)(.*)/",$residue,$matchCrop);

            if(!$left){

                if($cr){

                    $left     = $operator.$right;

                    $right    = $matchCrop[2];

                    $operator = $matchCrop[1];

                    $residue  = $matchCrop[3];
                }
            $xx[0] = $this->calculate($left, $right, $operator);

            $xx[1] = $residue;
            }
        }

        while(list($key,$value) = each($xx)) {
            $expression = $expression.''.$value;
        }

        if($this->isNumber($expression) === true) {
            return $expression;
        }

        if($this->priorityLeft($expression)!=false) {
            $o=$this->priorityLeft($expression);
        }

        if($this->is($o,$expression)) {
            $expression = $this->calc($expression);
        }

        return $expression;
    }




/**
 * Filter
 */
    private function filter_open_bracket()
    { 

        $_REGEX_OPEN_BRACKET = '/\(([^\(\)]*)\)/';    

          //Left Bracket Exist      (temp replacer)
        $lbe ='#LBE#';
          //Right Bracket Exist     (temp replacer)
        $rbe ='#RBE#';
          //Left Bracket Matches    (temp replacer)
        $lbm ='#LBM#';
          //Right Bracket Matches   (temp replacer)
        $rbm ='#RBM#';
          //Left Replacer Red       (real replacer)
        $lrr ='<span class="red" style="color:red;background:pink;padding-right:1px;">(</span>';
          //Right Replacer Red      (real replacer)
        $rrr ='<span class="red" color="red">)</span>';


        $string = $this->expression_string;

        $out_string = array(); // []

        while( preg_match_all($_REGEX_OPEN_BRACKET, $string,$match)){

            $string=preg_replace($_REGEX_OPEN_BRACKET,'#LBE#$1 $2#RBE#', $string);

        }

        $string = preg_replace('/(\()/', $lbm, $string);

        $string = preg_replace('/(\))/', $rbm, $string);

        $string = preg_replace('/(#LBE#)/', '(', $string);

        $string = preg_replace('/(#RBE#)/', ')', $string);

        if (preg_match('/(#LBM#)|(#RBM#)/', $string))
           {
            $string = preg_replace('/(#LBM#)/', $lrr, $string);

            $string = preg_replace('/(#RBM#)/', $rrr, $string);

            $this->expression_string = $string;

            $out_string['out'] = $this->expression_string;

            $out_string['result'] = 0;

            return  $out_string;

           }

        $out_string['out'] = $this->expression_string;

        $out_string['result'] = 1;

        return $out_string;
    }




/**
 * Filter
 */
    private function filter_operator()
    { 

        $this->expression_string = str_replace($this->uchr(150), '-', $this->expression_string);    // endash entity

        $this->expression_string = str_replace($this->uchr(151), '-', $this->expression_string);    // emdash entity

        $this->expression_string = str_replace($this->unichr(8211), '-', $this->expression_string); // endash Unicode

        $this->expression_string = str_replace($this->unichr(8212), '-', $this->expression_string); // emdash Unicode

        return $this->expression_string;
    }




/**
 * Filter
 */
    private function filter_whitespace()
    { 

        $this->expression_string = str_replace(' ', '', $this->expression_string);

        return $this->expression_string;
    }





/**
 * Filter
 */
    private function filter_empty_brackets()
    { 

        $this->expression_string = str_replace('()', '', $this->expression_string);

        return $this->expression_string;
    }





/**
 * Filter
 */
    private function filter_subtraction()
    { 

        $this->expression_string = str_replace('+-', '-', $this->expression_string);

        return $this->expression_string;
    }




/**
 * Filter
 */
    private function filter_fix_multiplier()
    { 

        $_REGEX_FIX_MULTIPLIER = '/(:?[^\*\/\+\-\)\(]+)([0-9\.]*\()/';
        
          //Left Bracket            (temp replacer) 
        $lb ='/(#LB#)/';

        $string = $this->expression_string;
          //Matches missing multiplier before left bracket and use temp replacer
        $string = preg_replace($_REGEX_FIX_MULTIPLIER, '$1#LB#', $string);
          //Fix multiplier
        $string = preg_replace($lb,'*(',$string);

        $this->expression_string = $string;

        return $this->expression_string;
    }




/**
 * Parsing and get easy brackets  ( this working recursively )
 */
    private function bracket_Parser()
    {

        if($this->calculation==false){
            return $this->expression_string;
        }

        $x = $this->expression_string;
        $arrHelper = [];  
        $strHelper = '';         
        $number    = null; 
        $strHelper = $x;
           if(($this->is('(', $strHelper)===true) && ($this->is(')', $strHelper)==true) ){ 
               $priority1= "/(\([^\)\(]*\))/";          //"/([(]{1}\s*\d*\s*\.*\s*\d*\s*\W{1}\s*\d*\s*\.*\s*\d*\s*[)]{1})/";
               preg_match($priority1, $strHelper, $MATCH_BRACKET);
                   if ($MATCH_BRACKET){
                       $number    = $this->calc($MATCH_BRACKET[0]);
                       $arrHelper = explode((string)$MATCH_BRACKET[0],(string)$strHelper);
                       $strHelper = $arrHelper[0].$number.$arrHelper[1];
                 
        //print_r('<br /><br /> O.K.<br /> First internal brackets is calculated,<br />  ...continue searching  for another brackets.<br />'.$strHelper.'<br />');
                    
                   }
                   $this->expression_string = $strHelper;
                   $strHelper = $this->bracket_Parser(true);
            }
        else{

        //print_r('<br /><br /> No more brackets,<br /> ...switching calculate residue.<br />');
           
               $strHelper = $this->calc($strHelper);

        //print_r(' Residue is calculated.<br /><br />'.$strHelper.'<br /><br />');

            }    

    return $this->expression_string = $strHelper; 
    }




/**
 * Setings the parser compositely
 */
    private function compose_Parser()
    { 

       // true  is returned calculated expression 
       // false is returned all string
       // use   : use is for method mathParser()
       $this->calculation = true;
     
       if ($this->filter_open_bracket()['result'] == 0)
           {
            return $this->filter_open_bracket()['out'];
           }
        $this->expression_string = $this->filter_whitespace();

        $this->expression_string = $this->filter_empty_brackets();

        $this->expression_string = $this->filter_operator();

        $this->expression_string = $this->filter_subtraction();

        $this->expression_string = $this->filter_fix_multiplier();

        $this->expression_string = $this->bracket_Parser();

        return $this->expression_string;
    }




/**
 *  The get expression
 */
    public function get_expression()
    { 

     return $this->compose_Parser();

    }




/**
 *  END CLASS
 */
}
