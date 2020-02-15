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
        $userLists = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' id='lists' name='lists' value=".json_encode($userLists).">";
        $userListItems = getData('listItems', null, ['username'], [$_SESSION['user']['username']]);
        echo "<input type='hidden' id='listItems' name='listItems' value=".json_encode($userListItems).">";
        if(isset($_GET['listName']) && !isset($_GET['listItem'])){
            insertData('lists', ['username', 'listName'], [$_SESSION['user']['username'], str_replace(' ', '/////zxyxyz/////', $_GET['listName'])]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listItem']) && isset($_GET['listID'])){
            insertData('listItems', ['username', 'listItem', 'listID'], [$_SESSION['user']['username'], str_replace(' ', '/////zxyxyz/////', $_GET['listItem']), $_GET['listID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listItemID']) && !isset($_GET['status'])){
            deleteData('listItems', ['id'], [$_GET['listItemID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['listToRemoveID'])){
            $listItemsOfList = getData('lists', null, ['username'], [$_SESSION['user']['username']]);
            for ($i=0; $i < count($listItemsOfList); $i++) { 
                deleteData('listItems', ['listID'], [$_GET['listToRemoveID']]);
            }
            deleteData('lists', ['id'], [$_GET['listToRemoveID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
        if(isset($_GET['status']) && isset($_GET['listItemID'])){
            updateData('listItems', ['status'], [$_GET['status']], ['username', 'id'], [$_SESSION['user']['username'], $_GET['listItemID']]);
            echo "<script>location.href = 'home.php'</script>";
        }
    ?>
<?php include "./layout/footer.php" ?>