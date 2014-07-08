<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pentesting Lab</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
        <h1>Photo Gallery</h1>

        <div class="row">
            <div class="col-md-6">
                <h4>We Know You Loves Da Cats!!</h4>
            </div>
            <div class="col-md-6">
                <form method="POST" action="upload.php" id="image-upload" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="file" class="form-control" name="image" />
                        <div class="input-group-btn">
                            <button type="submit" class="form-control">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <?php
                foreach(array_diff(scandir('images'), array('..', '.')) as $file) {
                    echo '<div class="col-xs-6 col-md-3">';
                    echo '<a href="view.php?image='.$file.'" class="thumbnail"><img src="images/'.$file.'" /></a>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
  </body>
</html>
