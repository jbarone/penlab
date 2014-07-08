<?php
unset($_COOKIE['uid']);
setcookie("uid", null, -1, "/bank/", "penlab2.geocent.com");
header('location: index.php');
exit;
?>
