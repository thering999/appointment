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

    if (isset($_POST["risk"])) {


        print_r($_POST);
        $id = $_POST['id'];
        $pid = $_POST['pid'];
        $pemail = $_POST['pemail'];
        $pname = $_POST['pname'];
        $pcid = $_POST['pcid'];
        $age = $_POST['age'];
        $ptel = $_POST['ptel'];
        $lmp = $_POST['lmp'];
        $week = $_POST['week'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $no1_1 = $_POST['no1_1'];
        $no1_2 = $_POST['no1_2'];
        $no1_3 = $_POST['no1_3'];
        $no1_4 = $_POST['no1_4'];
        $no2_1 = $_POST['no2_1'];
        $no2_2 = $_POST['no2_2'];
        $no3 = $_POST['no3'];
        $no4 = $_POST['no4'];
        $no5 = $_POST['no5'];
        $no6 = $_POST['no6'];
        $no7 = $_POST['no7'];
        $no8 = $_POST['no8'];
        $no9 = $_POST['no9'];
        $no10 = $_POST['no10'];
        $answer = $_POST['answer'];



        if ($answer =="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ") {
            $answer = "abnormal_nhso";
        } else if ($answer =="แนะนำให้ไป รพ. ทันที") {
            $answer = "abnormal_hospital";
        } else
            $answer = "normal";


        $sql = "update monitor1 set pid='$pid',pemail='$pemail',pname='$pname',pcid='$pcid'
            ,age='$age',ptel='$ptel',week='$week',start_date='$start_date',end_date='$end_date'
            ,no1_1='$no1_1',no1_2='$no1_2',no1_3='$no1_3',no1_4='$no1_4',no2_1='$no2_1'
            ,no2_2='$no2_2',no3='$no3',no4='$no4',no5='$no5',no6='$no6'
            ,no7='$no7',no8='$no8',no9='$no9',no10='$no10',answer='$answer' 
            where pid=$pid ;";
        $result = $database->query($sql);


        //WHERE pid = '$pid'
        //$result= $database->query($sql);
        //echo $result;



        echo "<script language='javascript'> alert('ยืนยันผลการประเมินลงในระบบเรียบร้อยแล้ว');window.location='index.php';</script>";

        //header("location: index.php");

    }
}
