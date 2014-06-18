<?php
if (!isset($_COOKIE['uid'])) {
    header('location: index.php');
    exit;
}

if ($_FILES["image"]["error"] > 8) {
    echo "Return Code: " . $_FILES["image"]["error"]  . "<br/>";
} else {
    echo "Upload: " . $_FILES["image"]["name"]  . "<br/>";
    echo "Type: " . $_FILES["image"]["type"]  . "<br/>";
    echo "Size: " . ($_FILES["image"]["size"] / 1024)  . "kB<br/>";
    if (file_exists("uploads/" . $_FILES["image"]["name"])) {
        echo $_FILES["image"]["name"] . " already exists. ";
    } else {
        move_uploaded_file($_FILES["image"]["tmp_name"],
                           "uploads/" . $_FILES["image"]["name"]);
    }
}
?>

<a href="/welcome.php">Go Home</a>
