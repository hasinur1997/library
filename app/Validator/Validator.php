<?php 
namespace App\Validator;

use App\Validator\ErrorHandler;
/**
* Validator Class
*
* @class validation
*/

class Validator {
	/**
	 * ErrorHandler class object
	 * 
	 * @var object
	 */
	protected $errorHandler;

	/**
	 * Validation rules
	 * 
	 * @var array
	 */
	protected $rules = ['required','maxlength', 'minlength'];

	public function __construct(ErrorHandler $errorHandler)
	{	

		$this->errorHandler = $errorHandler;
	}


	/**
	 * Validation message
	 * 
	 * @var array
	 */
	public $messages = [

		'required' => ' :field  is required',

		'minlength' => ':field  is minimum :satisifer character',

		'maxlength' => ':field  is maximum :satisifer character'
		
	];

	/**
	 * Check input item and it's required rule
	 * 
	 * @param  array $items
	 * 
	 * @param  array $rules
	 * 
	 * @return void 
	 */
	public function check($items, $rules)
	{	
		foreach($items as $item => $value)
		{
			if(in_array($item, array_keys($rules)))
			{
				$this->validate([
					'field' => $item,
					'value' => $value,
					'rules'  => $rules[$item]
				]);
			}
		}
		return $this;
	}

	/**
	 * [errors description]
	 * 
	 * @return [type] [description]
	 * 
	 */
	public function errors()
	{
		return $this->errorHandaler;
	}

	/**
	 * Check the validation
	 * 
	 * @return void
	 */
	public function fails()
	{
		return $this->errorHandler->hasError();
	}

	/**
	 * validate the input item
	 * 
	 * @param  array $item
	 * 
	 * @return void
	 */
	protected function validate($item)
	{
		$field = $item['field'];

		foreach($item['rules'] as $rule => $satisifer)
		{
			if(in_array($rule, $this->rules))
			{
				if( !call_user_func_array( [$this, $rule], [$field, $item['value'],$satisifer] ) )
				{
					$this->errorHandler->addError(
						str_replace([':field', ':satisifer'], [$field, $satisifer], $this->messages[$rule]),
						$field
					);
				}
			}
		}
	}

	/**
	 * Check input field empty or not
	 * 
	 * @param  string $field    
	 * 
	 * @param  string $value     
	 * 
	 * @param  string $satisifer 
	 * 
	 * @return bool           
	 */
	protected function required($field, $value, $satisifer)
	{
		return !empty( trim( $value) );
	}

	/**
	 * Check the input maximum value
	 * 
	 * @param  string $field 
	 *  
	 * @param  string $value  
	 *  
	 * @param  string $satisifer 
	 * 
	 * @return bool            
	 */
	protected function maxlength($field, $value, $satisifer)
	{
		return mb_strlen($value) <= $satisifer;
	}

	/**
	 * Check the input value minimum length
	 * 
	 * @param  string $field 
	 *     
	 * @param  string $value  
	 *    
	 * @param  string $satisifer
	 *  
	 * @return bool            
	 */
	protected function minlength($field, $value, $satisifer)
	{
		return mb_strlen($value) >= $satisifer;
	}


	
}