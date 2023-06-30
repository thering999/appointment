<?php

//learn from w3schools.com

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}


//import database
include("../connection.php");
$userrow = $database->query("select * from patient where pemail='$useremail'");
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];

// echo $pname;
//print_r($_POST);

if ($_POST) {

    if (isset($_POST["exam"])) {


        print_r($_POST);
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $pemail = $_POST['pemail'];
        $pname = $_POST['pname'];
        $pcid = $_POST['pcid'];
        $age = $_POST['age'];
        $ptel = $_POST['ptel'];
        $gravida = $_POST['gravida'];
        $week = $_POST['week'];       
        $lmp = $_POST['lmp'];
        $edc = $_POST['edc'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $bmi = $_POST['bmi'];

        $no1 = $_POST['no1'];
        $no2 = $_POST['no2'];
        $no3 = $_POST['no3'];
        $no4 = $_POST['no4'];
        $no5 = $_POST['no5'];
        $no6 = $_POST['no6'];
        $no7 = $_POST['no7'];
        $no8 = $_POST['no8'];
        $no9 = $_POST['no9'];
        $no10 = $_POST['no10'];
        $no11 = $_POST['no11'];
        $no12 = $_POST['no12'];
        $no13 = $_POST['no13'];
        $no14 = $_POST['no14'];
        $no15 = $_POST['no15'];
        $no16 = $_POST['no16'];
        $no18 = $_POST['no18'];
        $no18 = $_POST['no18'];
        $no10 = $_POST['no10'];
        $no10 = $_POST['no10'];
        $no10 = $_POST['no10'];
        $no10 = $_POST['no10'];
        $exam_level1 = $_POST['exam_level1'];
        $exam_level2 = $_POST['exam_level2'];
        $exam_level3 = $_POST['exam_level3'];
        $exam_result = $_POST['exam_result'];


        // if ($answer =="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ") {
        //     $answer = "abnormal_nhso";
        // } else if ($answer =="แนะนำให้ไป รพ. ทันที") {
        //     $answer = "abnormal_hospital";
        // } else
        //     $answer = "normal";


        $sql = "update exam1 set exam_level1='$exam_level1',exam_level2='$exam_level2',exam_level3='$exam_level3'
            ,exam_result='$exam_result' 
            where pid=$pid ;";
        $result = $database->query($sql);


        //WHERE pid = '$pid'
        //$result= $database->query($sql);
        //echo $result;



        echo "<script language='javascript'> alert('ยืนยันผลคัดกรองจำแนกสีตามความเสี่ยงลงในระบบเรียบร้อยแล้ว');window.location='index.php';</script>";

        //header("location: index.php");

    }
}
