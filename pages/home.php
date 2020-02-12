<?php include "./layout/header.php" ?>
    <?php
        session_start();
        if($_SESSION['user'] !== null){
            var_dump($_SESSION['user']);
        }
    ?>
    <ul id="commands">
        
    </ul>

    <div id="exampleList">
        <h3 id="listTitle">List</h3>
        <ul id="listItems">
            
        </ul>
    </div>

    <?php 
        if(isset($_GET['listName'])){
            if(getData('lists', ['username'], ['username'], [$_SESSION['user']['username']]) == null){
                insertData('lists', ['username', 'data'], [$_SESSION['user']['username'], '[listName:'.$_GET['listName']."]"]);
                var_dump(getData('lists', null, ['username'], [$_SESSION['user']['username']]));
            }
            else{
                $userData = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
                var_dump($userData[0]['data']);
            }
            echo "<script>location.href = 'home.php'</script>";
            //."listItems:".$_GET['listItems'].
        }
    ?>

<?php include "./layout/footer.php" ?>