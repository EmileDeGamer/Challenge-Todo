<?php include "./layout/header.php" ?>
    <?php
        session_start();
        if(isset($_SESSION['user'])){
            var_dump($_SESSION['user']);
        }
        else{
            header("Location: ./index.php");
            exit;
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
        $lists = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' name='lists' id='lists' value='".json_encode($lists)."'>";
        $listItems = getData('listItems', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' name='listItems' id='listItems' value='".json_encode($listItems)."'>";
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
        if(isset($_GET['listItem'])){
            
        }
    ?>

    

<?php include "./layout/footer.php" ?>