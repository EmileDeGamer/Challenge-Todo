<?php include "./layout/header.php" ?>
    <?php
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

<?php include "./layout/footer.php" ?>