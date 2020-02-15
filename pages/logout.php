<?php include "./layout/header.php" ?>
    <?php
        session_destroy();
        header("Location: ./index.php");
        exit;
    ?>
<?php include "./layout/footer.php" ?>