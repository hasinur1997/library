<?php 

require_once "vendor/autoload.php";

use App\Library\Book;

$books = new Book;

$books = $books->get_all();

?>

<?php include "templates/header.php";?>
	
	<!-- Data -->
	<div class="container"> 

		<div class="col-md-10 col-md-offset-1"> 
			
			<?php if( count( $books ) ):?>

			<div class="panel panel-default">

				<div class="panel-heading"> 

					Data Table

					<a href="create.php" class="btn btn-info btn-xs pull-right">Add New</a>

				</div>

				<div class="panel-body">

					<!-- Data Table -->

					<table class="table table-striped table-hover table-condensed">

						<thead>

							<th>Sl</th>

							<th>Book Title</th>

							<th>Author</th>

							<th>Publish Date</th>

							<th>Action</th>

						</thead>

						<?php $x = 1; ?>

						<?php foreach( $books as $book ):?>

							<tr> 
								<td><?php echo $x;?></td>

								<td><?php echo $book->book_title;?></td>

								<td><?php echo $book->author;?></td>

								<td><?php echo $book->publis_date;?></td>

								<td> <a href="edit.php?book=<?php echo $book->id;?>" class="btn btn-info btn-xs">Edit</a
									> <a href="" class="btn btn-danger btn-xs" data-target="#myModal<?php echo $book->id?>" data-toggle="modal">Delete</a> </td>

									<?php include "templates/delete_alert.php";?>


									
							</tr>
							<?php $x++; ?>
						<?php endforeach?>

					</table>

				</div>

			</div>

		<?php else:?>

			<div class="text-center"> 
				<h3>No Books were found, <a href="create.php"> Crate New </a></h3>
			</div>

		<?php endif?>

		</div>

	</div>

<?php include 'templates/footer.php';?>



