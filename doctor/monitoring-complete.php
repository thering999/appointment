<?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];

    // echo $pname;

    if($_POST){
         if(isset($_POST["monitor"])){



            $pid=$_POST['pid'];


            $hoscode=$_POST["hoscode"];
            $hosname=$_POST["hosname"];
            $amp_code=$_POST["amp_code"];
            $amp_name=$_POST["amp_name"];


            $pemail=$_POST['pemail'];
            $pname=$_POST['pname'];
            $pcid=$_POST['pcid'];
            $age=$_POST['age'];
            $ptel=$_POST['ptel'];
            $lmp=$_POST['lmp'];
            $week=$_POST['week'];
            $start_date=$_POST['start_date'];
            $end_date=$_POST['end_date'];
            $no1_1=$_POST['no1_1'];
            $no1_2=$_POST['no1_2'];
            $no1_3=$_POST['no1_3'];
            $no1_4=$_POST['no1_4'];
            $no2_1=$_POST['no2_1'];
            $no2_2=$_POST['no2_2'];
            $no3=$_POST['no3'];
            $no4=$_POST['no4'];
            $no5=$_POST['no5'];
            $no6=$_POST['no6'];
            $no7=$_POST['no7'];
            $no8=$_POST['no8'];
            $no9=$_POST['no9'];
            $no10=$_POST['no10'];
            $answer=$_POST['answer'];



            if ($no1_1==1)
            {
                $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";
           
           }else if ($no1_2==1)
           {
               $answer="ผลประเมินปกติ";

           }else if ($no1_3==1)
           {
               $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";

           }else if ($no1_4==1)
           {
               $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";

           }else if ($no2_1==1)
           {
               $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";

           }else if ($no1_4==1)
           {
               $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";

           }else if ($no2_1==1)
           {
               $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";
           
           }else if ($no2_2==1)
           { 
               $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";

           }else if ($no3==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           }else if ($no4==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           }else if ($no5==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           }else if ($no6==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           }                        
           else if ($no7==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           }else if ($no8==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           }else if ($no9==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           }  
           else if ($no10==1)
           {
               $answer="แนะนำให้ไป รพ. ทันที";

           } 

           else
               $answer="ผลประเมินปกติ";

               if ($answer =="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ") {
                $answer = "abnormal_nhso";
            } else if ($answer =="แนะนำให้ไป รพ. ทันที") {
                $answer = "abnormal_hospital";
            } else
                $answer = "normal";
    

           
            $sql="insert into monitor1(pid,hoscode,hosname,amp_code,amp_name,pemail,pname,pcid,age,ptel,lmp,week,start_date,end_date,no1_1,no1_2,no1_3,no1_4,no2_1,no2_2,no3,no4,no5,no6,no7,no8,no9,no10,answer) 
            values ('$pid','$hoscode','$hosname','$amp_code','$amp_name','$pemail','$pname','$pcid','$age','$ptel','$lmp','$week','$start_date','$end_date','$no1_1','$no1_2','$no1_3','$no1_4','$no2_1','$no2_2','$no3','$no4','$no5','$no6','$no7','$no8','$no9','$no10','$answer')
            
            ";
            //WHERE pid = '$pid'
            $result= $database->query($sql);
            //echo $result;

            //echo '<script>alert("เพิ่มข้อมูลในแบบประเมินสำเร็จแล้ว")</script>';
            //
           
            echo "<script language='javascript'> alert('เพิ่มข้อมูลในบบประเมินผู้ป่วยสำเร็จแล้ว');window.location='index.php';</script>";
           
            //header("location: index.php");
            
        }
    }





 ?>