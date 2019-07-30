<?php
include_once("./includes/header.php");
if(func::checkLoginState($dbh))
    {
        echo 'Helló ' . $_SESSION['username'] . '!';
    } else {
        header('location:login.php');
    }
?>

<?php
include_once("./includes/footer.php");
?>