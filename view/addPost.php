
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://rawgit.com/lodev09/bootstrap-markdown/master/css/bootstrap-markdown.min.css" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

    <!-- Custom styles for this template -->
    <link href="assett/modern-business.css" rel="stylesheet">
    <link href="assett/main.css" rel="stylesheet">

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
      
        <div class="post-form">
 <form method="post" action="">
     <?php echo $error != '' ? "<p class='required'>$error</p>": ''  ?>
    <div class="form-group">
       <label >Title <span class='required'>*</span></label>
       <input type="text" class="form-control"  name ='title'>
    </div>
    <div class="form-group">
       <label >Body <span class='required'>*</span></label>
       <textarea rows="5" cols="50" name="body" class="form-control" id="comment-md"></textarea>
      
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a  href="<?php echo BASEURL ?>" >Back to posts</a>
 </form>
</div>

    </div>

  </div>
  <!-- /.container -->


  <!-- Bootstrap core JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://getbootstrap.com/assets/js/vendor/popper.min.js" ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://rawgit.com/lodev09/bootstrap-markdown/master/js/bootstrap-markdown.js
"></script>
  <script type="text/javascript" >
    // Code goes here

$(function() {
  var $previewContainer = $('#comment-md-preview-container');
  $previewContainer.hide();
  var $md = $("#comment-md").markdown({
    autofocus: false,
    height: 270,
    iconlibrary: 'fa',
    onShow: function(e) {
      //e.hideButtons('cmdPreview');
      e.change(e);
    },
    onChange: function(e) {
      var content = e.parseContent();
      if (content === '') $previewContainer.hide();
      else $previewContainer.show().find('#comment-md-preview').html(content).find('table').addClass('table table-bordered table-striped table-hover');
    },
    additionalButtons: [
      [{
        name: 'groupHelp',
        data: [{
          name: 'cmdHelp',
          title: 'Help',
          hotkey: 'F1',
          icon: 'fa fa-question',
          callback: function(e) {
            window.open('https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet');
          }
        }]
      }]
    ],
    
  });

})
  </script>
</body>

</html>
