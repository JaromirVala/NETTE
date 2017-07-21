<?php
namespace App\Models;

use Nette\Application\UI,
    Nette\Application\UI\Form;




// pokud používáte verzi pro PHP 5.3, odkomentujte následující řádek:
 use Nette\Object;


class ModelFrm extends Object
{
	const COFFEE_PRICE = 10;


	public function countValue($money)
	{

		if ($money =='inp') {
		//	return 'inp';

		}



//$c = $this->getHttpRequest();//new Component($this->getHttpRequest());
//$money = $form->getHttpData(Form::DATA_TEXT, 'foo');
//$this->displeyxz=$exampleValue;
 //dump($exampleValue);
// = $c->foo;
//$add = $this->inp1;

//$money = $this->getHttpData(Form::DATA_LINE, '[foo]');
//$money = $form->getValues(TRUE);









/*		if ($money < self::COFFEE_PRICE) {
			return FALSE;
		}

		// uschovej peníze, vyrob kávu
		return TRUE;
*/
   return $money;
	}

}
