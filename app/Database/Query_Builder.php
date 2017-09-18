<?php 
namespace App\Database;

use App\Database\Connection;

use PDO;
/**
*  Database Class
*
* @class database action
*/
class Query_Builder
{	

	/**
	 * SQL Queery
	 * 
	 * @var query string
	 */
	private $query;


	/**
	 * Fetch All Table row
	 * 
	 * @var array
	 */
	private $result;


	/**
	 * Count all table row
	 * 
	 * @var integer
	 */
	private $count;
	

	/**
	 * PDO Class object
	 * 
	 * @var object
	 */
	private $pdo;

	/**
	 * Error
	 * 
	 * @var boolean
	 */
	private $error = false;

	public function __construct() {

		$connect =  Connection::init();

		$this->pdo = $connect->pdo();
	}

	/**
	 * SQL Query
	 * 
	 * @param  string $sql    
	 * 
	 * @param  array  $params 
	 * 
	 * @return void         
	 */
	public function query( $sql, $params = [] ) {

		if( $this->query = $this->pdo->prepare( $sql ) ){

			$x = 1;

			if(count( $params )){

				foreach( $params as $param ) {

					$this->query->bindValue($x, $param);

					$x++;
				}
			}
		}

		if( $this->query->execute() ){

			//Fetch All row from database table
			$this->result = $this->query->fetchAll(PDO::FETCH_OBJ);

			// Count all database table row
			$this->count = $this->query->rowCount();

		}else{ 

			$this->error = true;
		}

		return $this;

	}

	/**
	 * Get the error
	 * 
	 * @return bool
	 */
	public function error()
	{
		return $this->error;
	}


	/**
	 * Insert Data
	 * 
	 * @param  string $table 
	 * 
	 * @param  array $fields 
	 * 
	 * @return bool
	 */
	public function insert( $table, $fields ){

		if( count( $fields ) ){

			$keys = array_keys( $fields );

			$values = '';

			$x = 1;

			foreach( $fields as $field ){

				$values .= '?';

				if( $x < count( $fields )){

					$values .= ', ';
				}

				$x++;
			}

			$sql = "INSERT INTO {$table}(`".implode('`, `', $keys)."`) VALUES({$values})";

			 if( !$this->query($sql, $fields)->error() ){

				return true;
			}
		}
			return false;
	}


	/**
	 * Update data
	 * 
	 * @param  string $table 
	 * 
	 * @param  integer $id 
	 * 
	 * @param  array $fields
	 * 
	 * @return bool
	 */
	public function update($table, $id, $fields) {

		if( count($fields) ){

			$x = 1;

			$set = '';

			foreach( $fields as $field  => $value) {

				$set .= "{$field} = ?";

				if( $x < count( $fields )){

					$set .= ", ";
				}

				$x++;
			}

			$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

			if(!$this->query($sql, $fields)->error()){

				return true;
			}
		}

		return false;
	}

	/**
	 * Database action
	 * 
	 * @param  string $action 
	 * 
	 * @param  string $table  
	 * 
	 * @param  array  $where  
	 * 
	 * @return bool      
	 */
	public function action( $action, $table, $where = [] ){

		if( count( $where ) === 3 ){


			$operators = array('=', '<', '>', '>=', '<=');

			$field = $where[0];

			$operator = $where[1];

			$value = $where[2];
			

			if( in_array( $operator, $operators ) ){

				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				if( !$this->query($sql, array( $value ))->error() ){

					return $this;
				}
			}
		}

		return false;
	}

	/**
	 * Delete data form table
	 * 
	 * @param  string $table 
	 * 
	 * @param  integer $id 
	 *  
	 * @return bool      
	 */
	public function delete($table, $id) {

		if( ! $this->query("DELETE FROM {$table} WHERE id = ?", ['id' => $id] )->error() ){

			return true;
		}

		return false;
	}


	/**
	 * Fetch all row from a table
	 * 
	 * @return array
	 */
	public function result() {

		return $this->result;
	}

	/**
	 * Fetch a single database table row
	 * 
	 * @return object
	 */
	public function first() {

		return $this->result[0];
	}


	/**
	 * Get All data from a table
	 * 
	 * @param  string $table
	 *  
	 * @return array
	 */
	public function all( $table ) {

		$sql = "SELECT * FROM {$table}";

		$data = $this->query( $sql )->result();

		return $data;
	}


	/**
	 * Get single table row
	 * 
	 * @param  string $table 
	 * 
	 * @param  array $data  
	 * 
	 * @return object 
	 */
	public function get( $table, $data ) {

		$data = $this->action("SELECT *", $table, $data);

		return $data->first();
	}
}