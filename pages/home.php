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
            insertData('lists', ['username'=>$_SESSION['user']['username'], 'listName'=>str_replace(' ','/////zxyxyz/////',$_GET['listName'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listItem']) && isset($_GET['listID'])){
            insertData('listItems', ['username'=>$_SESSION['user']['username'],'listItem'=>str_replace(' ','/////zxyxyz/////',$_GET['listItem']),'listID'=>$_GET['listID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listItemID']) && !isset($_GET['status']) && !isset($_GET['editedListItem'])){
            deleteData('listItems', ['id'=>$_GET['listItemID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listToRemoveID'])){
            deleteData('listItems', ['listID'=>$_GET['listToRemoveID']]);
            deleteData('lists', ['id'=>$_GET['listToRemoveID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['status']) && isset($_GET['listItemID'])){
            updateData('listItems', ['status'=>$_GET['status']], ['id'=>$_GET['listItemID'], "username"=>$_SESSION["user"]["username"]]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['editedListName']) && isset($_GET['listID'])){
            updateData('lists', ['listName'=>str_replace(' ','/////zxyxyz/////',$_GET['editedListName'])],['id'=>$_GET['listID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['editedListItem']) && isset($_GET['listItemID'])){
            updateData('listItems', ['listItem'=>str_replace(' ','/////zxyxyz/////',$_GET['editedListItem'])],['id'=>$_GET['listItemID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
    ?>
<?php include "./layout/footer.php" ?>