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
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $regexCounter = 0;
        $regexes = ['^[a-zA-Z\s\-]{3,255}$', '^[a-zA-Z0-9_\-]{3,15}$', "^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$", '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$'];
        $matches = [];
        foreach ($user as $k => $v) {
            if($regexCounter !== count($regexCounter)){
                preg_match($regexes[$regexCounter], $user[$regexCounter], $matches[$regexCounter], PREG_UNMATCHED_AS_NULL);
                $regexCounter++;
            }
        }

        $errorCounter = 0;
        for ($i=0; $i < count($matches); $i++) { 
            for ($x=0; $x < counter($matches[$i]); $x++) { 
                if($matches[$i][$x] !== null){
                    $errorCounter++;   
                }
            }
        }        

        if($errorCounter == 0){
            if($user['password'] == $user['repeatPassword']){
                $user['hash'] = md5($user['password'], PASSWORD_DEFAULT);
                insertData('users', ['name', 'username', 'email', 'password'], [$user['name'], $user['username'], $user['email'], $user['hash']]);
            }
        }
        else{
            //return errors or something
        }

        var_dump($user);
    ?>

<?php include "./layout/footer.php" ?>