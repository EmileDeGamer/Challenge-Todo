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

    function insertData($table, $namesArray, $valuesArray){
        if(count($namesArray) !== count($valuesArray)){
            echo 'name and values lengths are not the same';
        }
        else{
            try{
                $namesString = '';
                $valuesString = '';
                for ($i=0; $i < count($namesArray); $i++) { 
                    if($i !== count($namesArray)-1){
                        $namesString .= $namesArray[$i] .= ", ";
                        $valuesString .= "'" . $valuesArray[$i] . "', ";
                    }
                    else{
                        $namesString .= $namesArray[$i];
                        $valuesString .= "'" . $valuesArray[$i] . "'";
                    }
                }
                $sql = "INSERT INTO $table ($namesString) VALUES ($valuesString)";
                $GLOBALS['conn']->exec($sql);
            }
            catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }

    function getData($table, $whatToGetArray = null, $whereArray, $whereValuesArray){
        if(count($whereArray) !== count($whereValuesArray)){
            echo 'where and where values lengths are not the same';
        }
        else{
            try{
                $whereString = '';
                $whatToGetString = '';
                for ($i=0; $i < count($whereArray); $i++) { 
                    if($i !== count($whereArray)-1){
                        $whereString .= $whereArray[$i] . "='" . $whereValuesArray[$i] . "' AND ";
                    }
                    else{
                        $whereString .= $whereArray[$i] . "='" . $whereValuesArray[$i] . "'";
                    }
                }
                if($whatToGetArray == null){
                    $sql = "SELECT * FROM $table WHERE $whereString";
                }
                else{
                    for ($i=0; $i < count($whatToGetArray); $i++) { 
                        if($i !== count($whatToGetArray)-1){
                            $whatToGetString .= $whatToGetArray[$i] .= ", ";
                        }
                        else{
                            $whatToGetString .= $whatToGetArray[$i];
                        }
                    }
                    $sql = "SELECT $whatToGetString FROM $table WHERE $whereString";
                }
                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->execute();

                $result = $stmt->fetchAll();
                
                return $result;
            }
            catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }

    function deleteData($table, $whereArray, $whereValuesArray){
        if(count($whereArray) !== count($whereValuesArray)){
            echo 'where and where values lengths are not the same';
        }
        else{
            try{
                $whereString = '';
                for ($i=0; $i < count($whereArray); $i++) { 
                    if($i !== count($whereArray)-1){
                        $whereString .= $whereArray[$i] . "='" . $whereValuesArray[$i] . "' AND ";
                    }
                    else{
                        $whereString .= $whereArray[$i] . "='" . $whereValuesArray[$i] . "'";
                    }
                }
                $sql = "DELETE FROM $table WHERE $whereString";
                $GLOBALS['conn']->exec($sql);
            }
            catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }

    function updateData($table, $whatToUpdateArray, $whatToUpdateValuesArray, $whereArray, $whereValuesArray){
        if(count($whereArray) !== count($whereValuesArray)){
            echo 'where and where values lengths are not the same';
        }
        else if (count($whatToUpdateArray) !== count($whatToUpdateValuesArray)){
            echo 'whatToUpdate and whatToUpdate values lengths are not the same';
        }
        else{
            try{
                $whereString = '';
                $whatToUpdateString = '';
                for ($i=0; $i < count($whereArray); $i++) { 
                    if($i !== count($whereArray)-1){
                        $whereString .= $whereArray[$i] . "='" . $whereValuesArray[$i] . "' AND ";
                    }
                    else{
                        $whereString .= $whereArray[$i] . "='" . $whereValuesArray[$i] . "'";
                    }
                }
                for ($i=0; $i < count($whatToUpdateArray); $i++) { 
                    if($i !== count($whatToUpdateArray)-1){
                        $whatToUpdateString .= $whatToUpdateArray[$i] . "='" . $whatToUpdateValuesArray[$i] . "' AND ";
                    }
                    else{
                        $whatToUpdateString .= $whatToUpdateArray[$i] . "='" . $whatToUpdateValuesArray[$i] . "'";
                    }
                }
                $sql = "UPDATE $table SET $whatToUpdateString WHERE $whereString";
                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->execute();
            }
            catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }
?>