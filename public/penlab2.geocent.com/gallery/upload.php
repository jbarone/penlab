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
            if ($_FILES["image"]["error"] > 8) {
                echo "Return Code: " . $_FILES["image"]["error"]  . "<br/>";
            } else {
                echo "Upload: " . $_FILES["image"]["name"]  . "<br/>";
                echo "Type: " . $_FILES["image"]["type"]  . "<br/>";
                echo "Size: " . ($_FILES["image"]["size"] / 1024)  . "kB<br/>";
                if (file_exists("images/" . $_FILES["image"]["name"])) {
                    echo $_FILES["image"]["name"] . " already exists. ";
                } else {
                    move_uploaded_file($_FILES["image"]["tmp_name"],
                                       "images/" . $_FILES["image"]["name"]);
                }

                echo '<hr/>';
                echo '<a href="view.php?image=' . $_FILES["image"]["name"] . '">View Image</a><br/>';
                echo '<a href="index.php">Return Home</a>';
            }
            ?>
        </div>
    </div>
  </body>
</html>

