<?php

    $database= new mysqli("localhost","root","123456","appointment");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>