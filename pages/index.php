<?php include "./layout/header.php" ?>

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
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //get hash from db

        if (password_verify($password, $hash)) {
            // Success!
        }
        else {
            // Invalid credentials
        }

        var_dump($user);
    ?>

<?php include "./layout/footer.php" ?>