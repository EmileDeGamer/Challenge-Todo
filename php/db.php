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

    insertData('users', ['name', 'username'], ['pizza', 'pizza']);

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
                $whereValuesString = '';
                $whatToGetString = '';
                for ($i=0; $i < count($whereArray); $i++) { 
                    if($i !== count($whereArray)-1){
                        $whereString .= $whereArray[$i] .= ", ";
                        $whereValuesString .= "'" . $whereValuesArray[$i] . "', ";
                    }
                    else{
                        $whereString .= $whereArray[$i];
                        $whereValuesString .= "'" . $whereValuesArray[$i] . "'";
                    }
                }
                if($whatToGetArray == null){
                    $sql = "SELECT * FROM $table WHERE ";
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
                    $sql = "SELECT $whatToGetString FROM $table WHERE ";
                }
                $GLOBALS['conn']->exec($sql);
                echo "Done! :D";
            }
            catch(PDOException $e){
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }
?>