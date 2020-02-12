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
        $regexes = [];
        $matches = [];
        foreach ($user as $k => $v) {
            preg_match($regexes[$regexCounter], $user[$i], $matches[$regexCounter], PREG_UNMATCHED_AS_NULL);
            $regexCounter++;
        }

        for ($i=0; $i < count($matches); $i++) { 
            for ($x=0; $x < counter($matches[$i]); $x++) { 
                if($matches[$i][$x] !== null){
                    if($user['password'] == $user['repeatPassword']){
                        $user['hash'] = md5($user['password'], PASSWORD_DEFAULT);
                    }
                }
                else{
                    //return error or something
                }
            }
        }        

        var_dump($user);
    ?>

<?php include "./layout/footer.php" ?>