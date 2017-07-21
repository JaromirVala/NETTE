<?php
namespace App\Presenters;

use Nette,
    Nette\Application\UI,
    Nette\Application\UI\Form,
    Nette\Forms\Container,
    Nette\Utils\Html,
    Vendor\Others\jv\Jv,
    Vendor\Others\jv\ExpressionCalculate;
 

class HomepagePresenter  extends BasePresenter
{

    public $display;
    public $expression;




    public function __construct() {
     
    } 




    public function handlegetMyForm()
    {

        $getRadioInput = $this->getHttpRequest()->getPost('inputValue');

        if(isset($getRadioInput)){

	    	$jvMathParser = new Jv;

	    	$getRadioUpper = $jvMathParser->toUpper($getRadioInput);
 
        $this->expression = $this->getHttpRequest()->getPost($getRadioUpper);

        $this->expression = new ExpressionCalculate($this->expression); 

        $expressionsCalculated =  $this->expression->get_expression() ;

        $val = $expressionsCalculated;
        }
        else{

        $val ="Pleas select input.";

        }

       if(strpos($val,'class="red"')){
       
       $_MSG = 'Not calculated! Error with bracket!';
       }
       else{
       
       $_MSG ='Calculeted O.K.';
       
       }

        $this->display = $val;

        if ($this->isAjax()) {

            $this->flashMessage($_MSG);        
        
            $this->redrawControl('flashes');

            $this->redrawControl('calculated');
        }
    }




    public function createComponentMyForm()
    {
        $form = new Form;


        $form->setAction($this->link('getMyForm!'));
        $form->elementPrototype->addAttributes(array('name' => 'MyForm','class' => 'ajax','onclick' => 'console.log("sending form");'));


        $form->addText('INP1', 'Test 1:')->setAttribute('placeholder', 'placeholder_text')
        ->setAttribute('value', '2*6*((26/2)+-3)–(40-20)')
        ->setAttribute('class', 'text')
        ->addRule(Form::MAX_LENGTH,'Maximální délká příkladu je %d znaků',70);


        $form->addText('INP2', 'Test 2:')->setAttribute('placeholder', 'placeholder_text')
        ->setAttribute('value', '6*((26/2)+-3)–20')
        ->setAttribute('class', 'text')
        ->addRule(Form::MAX_LENGTH,'Maximální délká příkladu je %d znaků',70);


        $form->addText('INP3', 'Test 3:')->setAttribute('placeholder', 'placeholder_text')
        ->setAttribute('value', '6*(13-3)-20')
        ->setAttribute('class', 'text')
        ->addRule(Form::MAX_LENGTH,'Maximální délká příkladu je %d znaků',70);


        $form->addText('INP4', 'Test 4:')->setAttribute('placeholder', 'placeholder_text')
        ->setAttribute('value', '10*(10+5)-5*2')
        ->setAttribute('class', 'text')
        ->addRule(Form::MAX_LENGTH,'Maximální délká příkladu je %d znaků',70);


        $form->addText('INP5', 'Test 5:')->setAttribute('placeholder', 'placeholder_text')
        ->setAttribute('value', '240/(2*(20/5))')
        ->setAttribute('class', 'text')
        ->addRule(Form::MAX_LENGTH,'Maximální délká příkladu je %d znaků',70);


        $form->addText('INP6', 'Test 6:')->setAttribute('placeholder', 'placeholder_text')
        ->setAttribute('value', '((8*8)/8-8+2-2)+2*(((17+18)-19-20+21+22+23+24*(25/26)*27)/2)*2/2')
        ->setAttribute('class', 'text')
        ->addRule(Form::MAX_LENGTH,'Maximální délká příkladu je %d znaků',70);


        $form->addText('INP7', 'Test 7:')->setAttribute('placeholder', 'placeholder_text')
        ->setAttribute('value', '(1*((2+3)+(2+2+(3+3)))')
        ->setAttribute('class', 'text')
        ->addRule(Form::MAX_LENGTH,'Maximální délká příkladu je %d znaků',70);


        $options = array('inp1' => ' ◄ ','inp2' => ' ◄ ','inp3' => ' ◄ ','inp4' => ' ◄ ','inp5' => ' ◄ ','inp6' => ' ◄ ','inp7' => ' ◄ ');
        $form->addRadioList('inputValue', 'Type:', $options)
        ->setAttribute('class', 'radio');


        $form->addSubmit('send', 'Calculate')
        ->setAttribute('id', 'MyForm');

        //   $form["reset"]->onClick[] = $this->resetForm;
        //   $form->onSuccess[] = [$form, 'processSelectForm'];
        //   $form->onSubmit[] = callback($this, 'processContactForm');

    return($form);
    }




    public function saveForm($button)
    {
        $form = $button->getForm();

        if($form->isSuccess()){

            $this->onSave($form);
        }

    }




	public function beforeRender()
	{
		//$this->template->registerFilter('Nette\Templates\CurlyBracketsFilter::invoke');
	}




	public function renderMyForm()
	{
	    $this->display = 'test';
  
  		$this->template->dissplay = $this->display;
	}




	public function renderDefault()
	{
		if (empty($this->template->display)) {

        $this->template->display = $this->display;

		}
	}


}
