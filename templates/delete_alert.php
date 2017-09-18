<div id="myModal<?php echo $book->id?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Delete</h4>

      </div>

      <div class="modal-body">

        <p>Are you sure want to delete this ?</p>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Calncel</button>

        <a href="delete.php?book=<?php echo $book->id;?>" class="btn btn-danger">Delete</a>

      </div>
      
    </div>

  </div>
</div>