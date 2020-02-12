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
            <ul id="menuButtons"></ul>
        </header> 
        <?php include ('./../php/db.php') ?>
        <h1 id="pageTitle">ToDo</h1>
            <?php //print_r(getData('users', null, ['name'], ['Henk'])); ?>
    
