<?php
if (!isset($_COOKIE['uid'])) {
    header('location: index.php');
    exit;
}

include 'config.inc';
include 'opendb.inc';

$user = $_REQUEST['user'];
$amount = $_REQUEST['amount'];

$query = "UPDATE bank_accounts SET balance = balance - $amount WHERE id=". base64_decode($_COOKIE['uid']);
$result = mysql_query($query) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);

$query = "UPDATE bank_accounts SET balance = balance + $amount WHERE id=$user";
$result = mysql_query($query) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);

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
        <h1>Transfer Complete</h1>

        <hr/>

        <div class="row">
            <a href="bank.php">Back to Account</a>
        </div>
    </div>
  </body>
</html>
