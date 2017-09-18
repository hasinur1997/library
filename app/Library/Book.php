<?php 
namespace App\Library;

use App\Database\Query_Builder;
/**
*  Book Class
*
* @class Book Model
*/
class Book extends Query_Builder
{
	/**
	 * Get the table name
	 * 
	 * @var string
	 */
	protected $table = 'books';


	/**
	 * Create Book
	 * 
	 * @param  array $data [description]
	 * 
	 * @return void
	 */
	public function create($data) {

		$this->insert($this->table, $data);
	}


	/**
	 * Update Book
	 * 
	 * @param  integer $id  
	 * 
	 * @param  array $data 
	 * 
	 * @return void
	 */
	public function update_book($id, $data) {

		$this->update($this->table, $id, $data);
	}

	/**
	 * Delete Book
	 * 
	 * @param  integer $id
	 * 
	 * @return void
	 */
	public function destroy( $id ) {

		$this->delete($this->table, $id);
	}


	/**
	 * Get All Books
	 * 
	 * @return array
	 */
	public function get_all() {

		return $this->all( $this->table );
	}

	/**
	 * Find the book
	 * 
	 * @param  integer $id 
	 * 
	 * @return object   
	 */
	public function find($id) {

		return $this->get($this->table, [ 'id', '=', $id]);
	}
}