<?php
if (!isset($_COOKIE['uid'])) {
    header('location: index.php');
    exit;
}

include 'config.inc';
include 'opendb.inc';

$query  = "SELECT * FROM bank_accounts WHERE id=". base64_decode($_COOKIE['uid']);
$result = mysql_query($query) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);
if (mysql_num_rows($result) > 0) {
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $balance = $row['balance'];
}

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
        <h1>Welcome <?php echo $firstname . ' ' . $lastname; ?></h1>
        <p><a href="logout.php">Logout</a></p>
        <hr/>

        <div class="row">
            <h4>Your current balance is $<?php echo $balance; ?></h4>
        </div>

        <hr/>

        <div class="row">
            <form action="transfer.php" method="GET">
                <div class="form-group">
                    <label for="user">Who To Tansfer To</label>
                    <select id="user" name="user">
                    <?php
                        $query  = "SELECT id, firstname, lastname FROM bank_accounts";
                        $result = mysql_query($query) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $id = $row['id'];
                            print "<option value=$id>$firstname $lastname</option>";
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount to transfer</label>
                    <input type="text" id="amount" name="amount">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
            </form>
        </div>

    </div>
  </body>
</html>
