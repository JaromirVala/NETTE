<?php
namespace App\Models;





// pokud používáte verzi pro PHP 5.3, odkomentujte následující řádek:
 use Nette\Object;


class Model extends Object
{
	const COFFEE_PRICE = 10;


	public function buyCoffee($money)
	{
		if ($money < self::COFFEE_PRICE) {
			return FALSE;
		}

		// uschovej peníze, vyrob kávu
		return TRUE;
	}

}
