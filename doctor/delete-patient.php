<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        $pemail=$_GET["pemail"];
        //print_r($id);

        $result001= $database->query("select * from patient where pid=$id;");
        //$email=($result001->fetch_assoc())["pemail"];
        $result001= $database->query("delete t1,t2
        from patient as t1
        inner join webuser as t2 on t1.pemail = t2.email
        where pid=$id;");

        $result001= $database->query("select * from exam1 where pid=$id;");
        $result001= $database->query("delete
        from exam1
        where pid=$id;");


        //$result001= $database->query("delete from patient where pid=$id;");
        //  $sql= $database->query("delete from webuser where email='$email';");
        //  $sql= $database->query("delete from patient where pemail='$email';");
        //print_r($email);
        header("location: exam.php");
    }


?>