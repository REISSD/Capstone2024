<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
    
    <?php
    //db
        define('DB_SERVER', 'localhost');	
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'capstone');
        
    ?>
</head>
    <body>
        <?php
            if(array_key_exists("dropDB", $_POST)){
                dropDB();
            }
            function dropDB(){
                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
                if($conn->connect_error){
                    echo nl2br("Connection Not Found\n");
                }else{
                    echo nl2br("Connection Found\n");
                }

                $sql = 'SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME="'.DB_NAME.'"';
                $amount = $conn->query($sql);
                $result = $amount->fetch_object();
                $exist = (bool) $result->exists;
                
                if($exist >= 0) {
                    $sql = "DROP DATABASE " .DB_NAME;
                    if($conn->query($sql) == true){
                        echo nl2br("Dropped Database '". DB_NAME ."'\n");
                    }else{
                        echo nl2br("No Database dropped,\n");
                    }
                }
                //*
                createDB($conn);
                //  */
            }

            function createDB($connect){
                $conn = $connect;
                //*
                $sql = "CREATE DATABASE IF NOT EXISTS " .DB_NAME;
                if($conn->query($sql) == true){
                    echo nl2br("Database '". DB_NAME ."' Created\n");
                }else{
                    echo nl2br("No Database Created\n");
                }
                $conn->close();
                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                //  */
                
                //Now We just need to import and run the SQL Code
                $file = file("CreateCapstone.sql", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                //*
                $sql = "SET GLOBAL sql_mode = 'NO_ENGINE_SUBSTITUTION'";
                $conn->query($sql);
                $sql = "SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION'";
                $conn->query($sql);

                //  */
                $sql = " ";
                foreach($file as $line){
                    $first = substr(trim($line),0,2);
                    $last = substr(trim($line),-1,1);

                    if($first == "--" || $first == "/*" || $first == "//"){
                        continue;
                    }
                    $sql = $sql.$line;
                    if($last == ";"){

                        $conn->query($sql);
                        $sql = " ";
                    }
                    
                }
                //  */

                $conn->close();
            }
            
        ?> 

        <form method="post"> 
            <input type="submit" name="dropDB" class="button" value="Click to update"/>
        </from>
        
    </body>
</html>

