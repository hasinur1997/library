<?php 
namespace App\Database;

use PDO;
/**
* Connection class
*
* @class Database connection
*/
class Connection
{
	/**
	 * Host Name
	 * 
	 * @var string
	 */
	private $host = 'localhost';

	/**
	 * Database Name
	 * 
	 * @var string
	 */
	private $db_name = 'library';

	/**
	 * Database User Name
	 * 
	 * @var string
	 */
	private $db_user = 'root';


	/**
	 * Database Password
	 * 
	 * @var string
	 */
	private $db_password = '';


	/**
	 * Database class instance
	 * 
	 * @var null
	 */
	private static $instance = null;

	/**
	 * PDO class object
	 * 
	 * @var object
	 */
	private $pdo;


	public function __construct()
	{
		 $this->connection();
	}

	/**
	 * PDO Class Instantiate
	 * 
	 * @return void
	 */
	public function connection() {

		try{

			$this->pdo = new PDO("mysql:host={$this->host}; dbname={$this->db_name}", $this->db_user, $this->db_password);
		}catch(PDOException $e) {
			$e->getMessage();
		}
	}

	/**
	 * Instantiate Databse class
	 * 
	 * @return object
	 */
	public static function init() {

		if( !self::$instance ) {

			self::$instance = new Connection;
		}

		return self::$instance;
	}


	/**
	 * PDO Class instance
	 * 
	 * @return object
	 */
	public function pdo() {

		return $this->pdo;
	}
}