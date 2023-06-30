<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Patient</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $cid=$_POST['cid'];

        $age=$_POST["age"];
        $gravida=$_POST["gravida"];
        $lmp=$_POST["lmp"];
        $edc=$_POST["edc"];
        $weight=$_POST["weight"];
        $height=$_POST["height"];
        $bmi=$_POST["bmi"];
        $ancno=$_POST["ancno"];
        $ancplace=$_POST["ancplace"];
        $salary=$_POST["salary"];
        $osm=$_POST["osm"];

        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $dob=$_POST["dob"];
        $address=$_POST["addr"];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select * from webuser where email='$email';");
            if($result->num_rows==1){
                $error='1';
            }else{

                $sql1="insert into patient(pemail,pname,ppassword,pcid,age,gravida,lmp,edc,weight,height,bmi,ancno,ancplace,salary,osm,ptel,pdob,paddress) 
                values('$email','$name','$password','$cid','$age','$gravida','$lmp','$edc','$weight','$height','$bmi','$ancno','$ancplace','$salary','$osm','$tele','$dob','$address');";
                $sql2="insert into webuser values('$email','d')";
                $database->query($sql1);
                $database->query($sql2);

                //echo $sql1;
                //echo $sql2;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: patient.php?action=add&error=".$error);
    ?>
    
   

</body>
</html>