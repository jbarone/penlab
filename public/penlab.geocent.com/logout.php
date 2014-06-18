<?php
unset($_COOKIE['uid']);
setcookie("uid", null, -1, "/", "penlab.geocent.com");
header('location: index.php');
exit;
?>
