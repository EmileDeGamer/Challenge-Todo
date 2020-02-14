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

    <div id="listsDisplay">
        
    </div>

    <?php 
        $userLists = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' id='lists' name='lists' value=".json_encode($userLists).">";
        $userListItems = getData('listItems', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' id='listItems' name='listItems' value=".json_encode($userListItems).">";
        /*$lists = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' name='lists' id='lists' value='".json_encode($lists)."'>";
        $listItems = getData('listItems', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' name='listItems' id='listItems' value='".json_encode($listItems)."'>";
        var_dump(getData('lists', null, ['username'], [$_SESSION['user']['username']]));
        var_dump(getData('listItems', null, ['username'], [$_SESSION['user']['username']]));*/
        if(isset($_GET['listName']) && !isset($_GET['listItem'])){
            
            //if(getData('lists', ['username'], ['username'], [$_SESSION['user']['username']]) == null){
                insertData('lists', ['username', 'listName'], [$_SESSION['user']['username'], $_GET['listName']]);
            /*}
            else{
                $userData = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
                for ($i=0; $i < count($userData); $i++) { 
                    echo $userData[$i]['listName'];
                }
                //$userData[0]['listNames'] = $userData[0]['listNames'] .= "listName:" . $_GET['listName'];
                //$userData[0]['listsData'] = $userData[0]['listsData'] .= 'listData:""';
                //updateData('lists', ['listNames', 'listsData'], [$userData[0]['listNames'], $userData[0]['listsData']], ['username'], [$userData[0]['username']]);
                //$userListItems = explode("listData:", $userData[0]['listsData']);
                die(var_dump($userData));
            }*/
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listItem']) && isset($_GET['listID'])){
            //$userData = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
            //$userListItems = explode("listData:", $userData[0]['listsData']);
            //die($userListItems);
            //$userData[0]['listsData'] = $userData[0]['listsData'] .= "listData:" . $_GET['listItem'];
            //updateData('lists', ['data'], [$userData[0]['data']], ['username'], [$userData[0]['username']]);
            insertData('listItems', ['username', 'listItem', 'listID'], [$_SESSION['user']['username'], $_GET['listItem'], $_GET['listID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
    ?>

    

<?php include "./layout/footer.php" ?>