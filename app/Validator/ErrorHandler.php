<?php 
namespace App\Validator;

/**
* ErrorHandler Class
*
* @class error handaling
*/
class ErrorHandler
{
	/**
	 * Hold The errors
	 * 
	 * @var array
	 */
	protected $errors = [];
	
	/**
	 * Add the errors
	 * 
	 * @param string $error
	 * 
	 * @param string $key   [description]
	 * 
	 * @return void
	 */
	public function addError($error, $key = null)
	{
		if($key)
		{
			$this->errors[$key][] = $error;
		}
		else
		{
			$this->errors[] = $error;
		}
	}
	
	/**
	 * Set all error key
	 * 
	 * @param  string $key
	 * 
	 * @return void
	 */
	public function all($key = null)
	{
		return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
	}
	
	/**
	 * Check the error
	 * 
	 * @return boolean
	 */
	public function hasError()
	{
		return count($this->all()) ? true : false;
	}
	
	/**
	 * Get the first error
	 * 
	 * @param  string $key [description]
	 * 
	 * @return void
	 */
	public function first($key)
	{
		return isset($this->all()[$key][0]) ? $this->all()[$key][0] : '';
	}
}