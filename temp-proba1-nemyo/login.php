<?php include_once("./includes/header.php"); ?>
<?php 
echo func::checkLoginState($dbh);
    if(!func::checkLoginState($dbh))
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $query = "SELECT * FROM users WHERE user_username = :username AND user_password = :password";

            $username = $_POST['username'];
            $password = $_POST['password'];

            $stmt = $dbh->prepare($query);
            $stmt->execute(array(':username' => $username, ':password' => $password));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['user_id'] > 0)
            {
                //func::createRecord($row['user_id'], $row['user_username']);
                //header("location:index.php");
                echo 'pina';
                echo func::createString(32);
            }

        } else {
            echo '
        <div class="container d-flex justify-content-center">
            <div class="w-50 mt-5">
                <form action="login.php" method="POST" class="form-signin">
                    <div class="form-group">
                        <input type="text" id="username" class="form-control" placeholder="Név" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control" placeholder="Jelszó" required>
                    </div>
                  <button class="btn btn-lg btn-success btn-block" type="submit">Bejelentkezés</button>
                </form>
            </div>
        </div>';
        }
    } else {
        //header('location:index.php');
    }
?>




<?php
include_once("./includes/footer.php");
?>