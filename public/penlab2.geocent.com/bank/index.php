<?php
if (isset($_COOKIE['uid'])) {
    header('location: bank.php');
    exit;
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    include 'config.inc';
    include 'opendb.inc';

    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    if ($username <> "" and $password <> "") {
        $query  = "SELECT * FROM bank_users WHERE username='". $username ."' AND password='".stripslashes($password)."'";
        $result = mysql_query($query) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);
        if (mysql_num_rows($result) > 0) {
            // flag the cookie as secure only if it is accessed via SSL
            $ssl = FALSE;
            if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                // SSL connection
                $ssl = TRUE;
            }
            // set a random md5 as the session value
            $rndm = rand();
            $value = md5($rndm);
            setcookie("sessionid", $value, 0, "/bank/", "penlab2.geocent.com", $ssl, TRUE);
            // set uid to appropriate user
            $row = mysql_fetch_array($result, MYSQL_ASSOC);
            setcookie("uid", base64_encode($row['id']), 0, "/bank/", "penlab2.geocent.com", $ssl, FALSE);
            $failedloginflag=0;
            echo '<meta http-equiv="refresh" content="0;url=bank.php">';
        } else {
            $failedloginflag=1;
        }
    }
    ?>
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

      <form class="form-signin" role="form" method="POST" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
