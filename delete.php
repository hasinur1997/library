<?php 
require_once 'vendor/autoload.php';
use App\Library\Book;

use App\Database\Query_Builder;

$book = new Book;

if( !empty( $_GET['book'] ) ){

	$id = $_GET['book'];

	$book->destroy($id);

	header("location:index.php");
}