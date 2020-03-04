<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="./../css/style.css">
    <script defer src="./../js/script.js"></script>
</head>
<body>
    <div id="wrapper">
        <header>
            <ul id="menuButtons">
                <?php 
                    session_start();
                    if(isset($_SESSION['user'])){
                        echo "<li><a href='./logout.php'>Logout</a></li>";
                    } 
                    else{
                        echo "<li><a href='./index.php'>Login</a></li>";
                        echo "<li><a href='./register.php'>Register</a></li>";
                    }   
                ?>
            </ul>
        </header> 
        <?php include ('./../php/db.php') ?>
        <div id="content">
            <h1 id="pageTitle">ToDo</h1>