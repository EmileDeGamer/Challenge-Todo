<?php include "./layout/header.php" ?>
    <?php
        if(isset($_SESSION['user'])){
            
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
        $userLists = getData('lists', ['username'=>$_SESSION['user']['username']]);
        echo "<input type='hidden' id='lists' name='lists' value=".json_encode($userLists).">";
        $userListItems = getData('listItems', ['username'=>$_SESSION['user']['username']]);
        echo "<input type='hidden' id='listItems' name='listItems' value=".json_encode($userListItems).">";
        if(isset($_GET['listName']) && !isset($_GET['listItem'])){
            insertData('lists', ['username'=>$_SESSION['user']['username'], 'listName'=>str_replace(' ','/////zxyxyz/////',test_input($_GET['listName']))]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listItem']) && isset($_GET['listID'])){
            insertData('listItems', ['username'=>$_SESSION['user']['username'],'listItem'=>str_replace(' ','/////zxyxyz/////',test_input($_GET['listItem'])),'listID'=>test_input($_GET['listID'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listItemID']) && !isset($_GET['status']) && !isset($_GET['editedListItem'])){
            deleteData('listItems', ['id'=>test_input($_GET['listItemID'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listToRemoveID'])){
            deleteData('listItems', ['listID'=>test_input($_GET['listToRemoveID'])]);
            deleteData('lists', ['id'=>test_input($_GET['listToRemoveID'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['status']) && isset($_GET['listItemID'])){
            updateData('listItems', ['status'=>test_input($_GET['status'])], ['id'=>test_input($_GET['listItemID']), "username"=>$_SESSION["user"]["username"]]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['editedListName']) && isset($_GET['listID'])){
            updateData('lists', ['listName'=>str_replace(' ','/////zxyxyz/////',test_input($_GET['editedListName']))],['id'=>test_input($_GET['listID'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['editedListItem']) && isset($_GET['listItemID'])){
            updateData('listItems', ['listItem'=>str_replace(' ','/////zxyxyz/////',test_input($_GET['editedListItem']))],['id'=>test_input($_GET['listItemID'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        /*if(isset($_GET['listDateItemID']) && isset($_GET['timeFrom']) && isset($_GET['timeTill']) && isset($_GET['dateFrom']) && isset($_GET['dateTill'])){
            updateData('listItems', ['dateFrom'=>$_GET['dateFrom'],'timeFrom'=>$_GET['timeFrom'],'dateTill'=>$_GET['dateTill'],'timeTill'=>$_GET['timeTill']], ['id'=>$_GET['listDateItemID']]);
            echo "<script>location.href = 'home.php'</script>";
        }*/
        if(isset($_GET['duration']) && isset($_GET['listDurationItemID'])){
            updateData('listItems', ['duration'=>test_input($_GET['duration'])], ['id'=>test_input($_GET['listDurationItemID'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['filterOn'])){
            $userListItems = getData('listItems', ['username'=>$_SESSION['user']['username'], 'status'=>test_input($_GET['filterOn'])]);
            echo "<script>document.getElementById('listItems').remove()</script>";
            echo "<input type='hidden' id='listItems' name='listItems' value=".json_encode($userListItems).">";
        }
        if(isset($_GET['duration'])){
            $stmt = $GLOBALS['conn']->prepare("SELECT * FROM listItems WHERE `username` = :username AND `duration` <= :duration");
            $stmt->execute(['username'=>$_SESSION['user']['username'],'duration'=>test_input($_GET['duration'])]);

            $result = $stmt->fetchAll();

            echo "<script>document.getElementById('listItems').remove()</script>";
            echo "<input type='hidden' id='listItems' name='listItems' value=".json_encode($result).">";
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
    ?>
<?php include "./layout/footer.php" ?>