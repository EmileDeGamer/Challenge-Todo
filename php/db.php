<?php 
    $db = "todo";
    $dbhost = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $dbport = "3306";

    try{
        $conn = new PDO("mysql:host=$dbhost;dbname=$db;port=$dbport", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    //insertData("users", ["name", "username"], ["pizza", "pizza"]);
    //$result = getData('users', null, ['name', 'username'], ['pizza', 'pizza']);
    //deleteData('users', ['name', 'username'], ['pizza', 'pizza']);
    //updateData('users', ['name'], ['Henk'], ['username'], ['pizza']);

    function insertData($table, $valuesObject){
        try{
            $fields = '';
            $insertString = '';
            $insertValues = [];
            foreach ($valuesObject as $k => $v) {
                $fields .= $k . ', ';
                $insertString .= ':' . $k . ', ';
                $insertValues[$k] = $v;
            }
            $fields = rtrim($fields, ', ');
            $insertString = rtrim($insertString, ', ');
            $stmt = $GLOBALS['conn']->prepare("INSERT INTO $table ($fields) VALUES ($insertString)");
            $stmt->execute($insertValues);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function getData($table, $whereObject){
        try{
            $whereString = '';
            $whereValues = [];
            foreach ($whereObject as $k => $v) {
                $whereString .= $k . ' = :' . $k . ' AND ';
                $whereValues[$k] = $v;
            }
            $whereString = rtrim($whereString, ' AND ');
            $stmt = $GLOBALS['conn']->prepare("SELECT * FROM $table WHERE $whereString");
            $stmt->execute($whereValues);

            $result = $stmt->fetchAll();

            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function deleteData($table, $whereObject){
        try{
            $whereString = '';
            $whereValues = [];
            foreach ($whereObject as $k => $v) {
                $whereString .= $k . ' = :' . $k . ', ';
                $whereValues[$k] = $v;
            }
            $whereString = rtrim($whereString, ', ');
            $stmt = $GLOBALS['conn']->prepare("DELETE FROM $table WHERE $whereString");
            $stmt->execute($whereValues);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function updateData($table, $whatToUpdateObject, $whereObject){
        try{
            $updateString = '';
            $whereString = '';
            $updateValues = [];
            $whereValues = [];
            foreach ($whatToUpdateObject as $k => $v) {
                $updateString .= $k . ' = :' . $k . ', ';
                $updateValues[$k] = $v;
            }
            foreach ($whereObject as $k => $v) {
                $whereString .= $k . ' = :' . $k . ' AND ';
                $whereValues[$k] = $v;
            }
            $updateString = rtrim($updateString, ', ');
            $whereString = rtrim($whereString, ' AND ');
            $stmt = $GLOBALS['conn']->prepare("UPDATE $table SET $updateString WHERE $whereString");
            $values = array_merge($updateValues, $whereValues);
            $stmt->execute($values);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>