<?php 
session_start();
if(isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $password = $_SESSION['password'];
    $con = new mysqli( 'localhost', 'root','', 'passwordHashing');
    $sql = $con->query("SELECT id, password FROM users WHERE name='$name'");
    if($sql->num_rows > 0) {
        $data = $sql->fetch_array();
        if(!password_verify($password, $data['password'])) {
            //echo 'hello';
            header("location:login.php");
        }
    } else {
        $msg = '<h5 class="m-5 text-center alert alert-danger"> Adatbázis hiba! Fordulj a rendszergazdához! </h5>';
    }
} else {
    header("location:login.php");
    //echo 'pina';
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    