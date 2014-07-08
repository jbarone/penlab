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
            <?php
                if(isset($_GET['image'])) {
                    $image = $_GET['image'];

                    $exif = exif_read_data('images/' . $image);
                    print '<h4>' . $exif['ImageDescription'] . '</h4>';
                    print '</div>';

                    print '<div class="row text-center">';
                    print '<img src="images/' . $image . '" style="max-width: 500px; max-height: 500px;" />';
                } else {
                    print '<h4>No Image Selected</h4>';
                }
            ?>
        </div>

        <hr/>
        <a href="index.php">Return Home</a>
    </div>
  </body>
</html>
