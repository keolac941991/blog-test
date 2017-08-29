<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <!-- Custom styles for this template -->
      <link href="assett/modern-business.css" rel="stylesheet">
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
         <div class="container">
            <a class="navbar-brand" href="<?php echo BASEURL ?>">Blog</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo BASEURL . 'index.php?url=addPost' ?>">Add Post</a>
                  </li>
                  <?php
                     if($_SESSION['username']){
                         ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo BASEURL . 'index.php?url=logout' ?>">Logout</a>
                  </li>
                  <?php
                     } else {
                         ?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo BASEURL . 'index.php?url=login' ?>">Login</a>
                  </li>
                  <?php
                     }
                     ?>
               </ul>
            </div>
         </div>
      </nav>
      <!-- Page Content -->
      <div class="container">
         <!-- Page Heading/Breadcrumbs -->
         <!-- Blog Post -->
         </br>
         </br>
         <?php 
            if($count > 0){
                while ($row = $posts->fetch(PDO::FETCH_ASSOC)) { ?>
         <div class="card mb-4">
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-12">
                     <h2 class="card-title"><?php echo $row['title'] ?></h2>
                     <p class="card-text"><?php echo $row['body'] ?></p>
                     <?php
                        if($row['status'] == 0 && $_SESSION['role'] == ADMIN){
                            echo "<a href='" .BASEURL .'index.php?url=publicPost&id='.$row['id']. "' class='btn btn-primary'>Public</a>";
                        }
                        ?>
                     <button  class="btn btn-info" data-toggle="modal" data-target="#detail" data-id="<?php echo $row['id'] ?>">Read More &rarr;</button>
                  </div>
               </div>
            </div>
         </div>
         <?php }
            }
            
            ?>
         <!-- Pagination -->
         <ul class="pagination justify-content-center mb-4">
            <?php
               for($i = 1; $i <= $pages; $i ++){ 
                   if($i == $page){
                       ?>
            <li class="page-item disabled">
               <a class="page-link" href="#"><?php echo $i ?></a>
            </li>
            <?php
               } else {
                   ?>
            <li class="page-item">
               <a class="page-link" href="<?php echo BASEURL . 'index.php?page=' . $i ?>"><?php echo $i ?></a>
            </li>
            <?php
               }
               }
               ?>
         </ul>
      </div>
      </div>
      <!-- /.container -->
      <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <div class="col-sm-12">
                  <h3 class="pull-left title-modal"></h3>
               </div>
            </div>
            <div class="modal-body">
               <div class="postlist">
                  <div class="panel">
                     <div class="panel-header">
                        Created Date: <span class="date_created-modal"></span> Modified Date: <span class="date_modified-modal"></span>
                     </div>
                     <div class="panel-body">
                        <p class="body-modal"></p>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js" ></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <script type="text/javascript">
         $('#detail').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget)
         var id = button.data('id')
         $.ajax({
           url : "index.php",
           type : "GET",
           data : {url:'post', id:id},
           success : function (result){
           	console.log(result);
               var data = JSON.parse(result);console.log(data);
               $('.title-modal').html(data.title);
               $('.date_created-modal').html(data.date_created);
               $('.date_modified-modal').html(data.date_modified);
               $('.body-modal').html(data.body);
           }
         });
         })
      </script>
   </body>
</html>