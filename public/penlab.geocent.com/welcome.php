<?php
if (!isset($_COOKIE['uid'])) {
    header('location: index.php');
    exit;
}


include 'config.inc';
include 'opendb.inc';

$query  = "SELECT * FROM accounts WHERE id=". base64_decode($_COOKIE['uid']);
$result = mysql_query($query) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);
if (mysql_num_rows($result) > 0) {
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
}

if (isset($_REQUEST['search'])){
    $sq = "SELECT name, url FROM bookmarks WHERE name like '%" . $_REQUEST['search'] . "%' ORDER BY name";
} else {
    $sq = "SELECT name, url FROM bookmarks ORDER BY name";
}
$search_result = mysql_query($sq) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $sq);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pentesting Lab</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <h1>Welcome, <?php echo $firstname; ?> <?php echo $lastname; ?></h1>
      <p><a href="logout.php">Logout</a></p>
      <hr/>

        <div class="row">
            <div class="col-md-6">
                <h4>Bookmarks</h4>
            </div>
            <div class="col-md-6">
                <form method="POST" action="" id="bookmark-search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" />
                        <div class="input-group-btn">
                            <button type="submit" class="form-control">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="30%">Name</th>
                    <th width="70%">URL</th>
                </tr>
            </thead>
            <tbody>
                <?php while($search_row = mysql_fetch_array($search_result)) {
                    echo "<tr>";
                    echo "<td>$search_row[0]</td>";
                    echo "<td>$search_row[1]</td>";
                    echo "</tr>";
                } ?>
            </tbody>
        </table>

        <hr/>

        <div class="row">
            <div class="col-md-6">
                <h4>Whois</h4>
            </div>
            <div class="col-md-6">
                <form method="GET" action="/whois.php" id="whois-form">
                    <div class="input-group">
                        <input type="text" class="form-control" name="hostname" />
                        <div class="input-group-btn">
                            <button type="submit" class="form-control">Get Info</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-6">
                <h4>Enter Your Name</h4>
            </div>
            <div class="col-md-6">
                <form method="GET" action="/hello.php" id="hello-form">
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" />
                        <div class="input-group-btn">
                            <button type="submit" class="form-control">Say Hello</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-6">
                <h4>Pictures</h4>
            </div>
            <div class="col-md-6">
                <form method="POST" action="/upload.php" id="image-upload" enctype="multipart/form-data">
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
                foreach(array_diff(scandir('uploads'), array('..', '.')) as $file) {
                    echo '<div class="col-xs-6 col-md-3">';
                    echo '<a href="/uploads/'.$file.'" class="thumbnail"><img src="/uploads/'.$file.'" /></a>';
                    echo '</div>';
                }
            ?>
        </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
