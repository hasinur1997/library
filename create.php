<?php 
	
	require_once 'vendor/autoload.php';

	use App\Validator\Validator;

	use App\Validator\ErrorHandler;

	use App\Library\Book;

	$errorHandler = new ErrorHandler;

	$message = [];

	if( !empty($_POST) ){

		

		$validator = new Validator( $errorHandler );

		$validator->check($_POST, [ 

			'book_title' => [ 

				'required' => true,
			],

			'author_name' => [ 

				'required' => true,
			],

			'publish_date' => [ 

				'required' => true,
			]

		]);

		if( !$validator->fails() ){

			$book = new Book;

			$book->create([ 

				'book_title' => $_POST['book_title'],

				'author' => $_POST['author_name'],

				'publis_date' => $_POST['publish_date']
			]);

			$message['success'] = 'Book has been created successfully !';
		}
	}

?>

<?php include 'templates/header.php';?>


<div class="contaer">

	<div class="col-md-6 col-md-offset-3">
		
		<?php  if(isset($message['success'])):?>
			<div class="alert alert-success"> 
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<?php echo $message['success']?>

			</div>
		<?php endif?>
		<div class="panel panel-default"> 
			
			<div class="panel-heading">

				Add New Book

			</div>

			<div class="panel-body"> 

				<!-- Book Create From -->
				<form action="" method="post">

					<!-- Book Title Field -->

					<div class="form-group<?php echo $errorHandler->first('book_title') != null ? ' has-error' : ''?>"> 

						<label for="book-title" class="control-label">Book Title</label>

						<input type="text" name="book_title" id="book-title" class="form-control">

						<?php if($errorHandler->first('book_title')):?>

							<p class="help-block"><?php echo $errorHandler->first('book_title')?></p>

						<?php endif?>

					</div>


					<!-- Book Author Field -->

					<div class="form-group<?php echo $errorHandler->first('author_name') != null ? ' has-error' : ''?>"> 

						<label for="author-name" class="control-label">Author</label>

						<input type="text" name="author_name" id="author-name" class="form-control">
						
						<?php if($errorHandler->first('author_name')):?>

							<p class="help-block"><?php echo $errorHandler->first('author_name')?></p>

						<?php endif?>
					</div>


					<!-- Book Author Field -->

					<div class="form-group<?php echo $errorHandler->first('publish_date') != null ? ' has-error' : ''?>"> 

						<label for="publish-date" class="control-label">Publish Date</label>

						<input type="text" name="publish_date" id="publish-date" class="form-control datepicker">

						<?php if($errorHandler->first('publish_date')):?>

							<p class="help-block"><?php echo $errorHandler->first('publish_date')?></p>

						<?php endif?>

					</div>


					<!-- Submit Field -->

					<div class="form-group"> 
						<input type="submit" class="btn btn-info">
					</div>

					<a href="index.php" class="pull-right">Back</a>

				</form>

			</div>

		</div>
		

	</div>

</div>



<?php include 'templates/footer.php';?>