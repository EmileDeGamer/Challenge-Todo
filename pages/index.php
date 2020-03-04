<?php include "./layout/header.php" ?>
    <?php 
        if(isset($_SESSION['user'])){
            header("Location: ./home.php");
            exit;
        }
    ?>

    <ul id="errorsDisplay">

    </ul>

    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
        <input type="text" name="username" id="username" placeholder="Username">
        <span><input type="password" name="password" id="password" placeholder="Password"><input type="checkbox" name="showPassword" id="showPassword"></span>
        <button type="submit">Login</button>
    </form>

    <?php
        $user = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user['username'] = test_input($_POST["username"]);
            $user['password'] = test_input($_POST["password"]);

            $userData = getData('users', ['username'=>$user['username']]);
            if($userData == null){
                echo "<script>let errorsDisplay = document.getElementById('errorsDisplay')</script>";
                echo "<script>error = document.createElement('li'); error.innerHTML = 'Username doesn\'t exist'; errorsDisplay.appendChild(error);</script>";
            }
            else{
                if(password_verify($user['password'], $userData[0]['password'])){
                    $tUser = [];
                    $tUser['name'] = $userData[0]['name'];
                    $tUser['username'] = $userData[0]['username'];
                    $tUser['email'] = $userData[0]['email'];
                    $_SESSION['user'] = $tUser;
                    header("Location: ./home.php");
                    exit;
                }
                else{
                    echo "<script>let errorsDisplay = document.getElementById('errorsDisplay')</script>";
                    echo "<script>error = document.createElement('li'); error.innerHTML = 'Wrong password'; errorsDisplay.appendChild(error);</script>";
                }
            }
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

<?php include "./layout/footer.php" ?>