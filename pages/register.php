<?php include "./layout/header.php" ?>

<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
        <input type="text" name="name" id="name" placeholder="Name">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="text" name="email" id="email" placeholder="Email">
        <span><input type="password" name="password" id="password" placeholder="Password"><input type="checkbox" name="showPassword" id="showPassword"></span>
        <span><input type="password" name="repeatPassword" id="repeatPassword" placeholder="Repeat Password"><input type="checkbox" name="showRepeatPassword" id="showRepeatPassword"></span>
        <button type="submit">Register</button>
    </form>

    <?php
        $user = array();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user['name'] = test_input($_POST["name"]);
            $user['username'] = test_input($_POST["username"]);
            $user['email'] = test_input($_POST["email"]);
            $user['password'] = test_input($_POST["password"]);
            $user['repeatPassword'] = test_input($_POST["repeatPassword"]);

            $errorCounter = [];

            if (!preg_match("/^[a-zA-Z\s\-]{3,255}$/", $user['name'])) {
                $errorCounter['name'] = 'Wrong usage of name (no numbers allowed)';
            }   
            if (!preg_match("/^[a-zA-Z0-9_\-]{3,15}$/", $user['username'])) {
                $errorCounter['username'] = 'Wrong usage of username (no spaces allowed and min length 3 characters, max length 15 characters)';
            } 
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                $errorCounter['email'] = 'Wrong usage of email (no spaces allowed)';
            } 
            if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $user['password'])) {
                $errorCounter['password'] = 'Wrong usage of password (1 uppercase, 1 lowercase, 1 number and min length 8)';
            } 
            if($user['password'] !== $user['repeatPassword']){
                $errorCounter['repeatPassword'] = 'Passwords are not the same';
            }

            if(count($errorCounter) == 0){
                if(getData('users', ['username'], ['username'], [$user['username']]) == null){
                    $user['hash'] = password_hash($user['password'], PASSWORD_DEFAULT);
                    insertData('users', ['name', 'username', 'email', 'password'], [$user['name'], $user['username'], $user['email'], $user['hash']]);
                }
                else{
                    echo 'username already in use';
                }
            }
            else{
                //return errors or something
                var_dump($errorCounter);
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