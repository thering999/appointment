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
         if(isset($_POST["exam"])){



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

            $week=$_POST['week'];         

            $no1=$_POST['no1'];
            $no2=$_POST['no2'];
            $no3=$_POST['no3'];
            $no4=$_POST['no4'];
            $no5=$_POST['no5'];
            $no6=$_POST['no6'];
            $no7=$_POST['no7'];
            $no8=$_POST['no8'];
            $no9=$_POST['no9'];
            $no10=$_POST['no10'];
            $no11=$_POST['no11'];
            $no12=$_POST['no12'];
            $no13=$_POST['no13'];
            $no14=$_POST['no14'];
            $no15=$_POST['no15'];
            $no16=$_POST['no16'];
            $no17=$_POST['no17'];
            $no18=$_POST['no18'];



                                    #exam_result


                                    #cal_exam_level1
                                    if ($no1==1)
                                    {
                                        $exam_level1='1';
                                   
                                   }else if ($no2==1)
                                   {
                                       $exam_level1='1';

                                   }else if ($no3==1)
                                   {
                                       $exam_level1='1';

                                   }else if ($no4==1)
                                   {
                                       $exam_level1='1';

                                   }else if ($no5==1)
                                   {
                                       $exam_level1='1';

                                   }else if ($no6==1)
                                   {
                                       $exam_level1='1';

                                   }else if ($no7==1)
                                   {
                                       $exam_level1='1';
                                   
                                   }else if ($no8==1)
                                   { 
                                       $exam_level1='1';
                                   }
                                   else
                                       $exam_level1='0';


                                   #cal_exam_level2
                                   if ($no9==1)
                                   {
                                       $exam_level2='1';
                                  
                                  }else if ($no10==1)
                                  {
                                       $exam_level2='1';

                                  }else if ($no11==1)
                                  {
                                       $exam_level2='1';

                                  }else if ($no12==1)
                                  {
                                       $exam_level2='1';

                                  }else if ($no13==1)
                                  {
                                       $exam_level2='1';

                                  }else if ($no14==1)
                                  {
                                       $exam_level2='1';

                                  }else if ($no15==1)
                                  {
                                       $exam_level2='1';
                                  
                                  }else if ($no16==1)
                                  { 
                                       $exam_level2='1';
                                  }
                                  else
                                       $exam_level2='0';


                                  #cal_exam_level3
                                  if ($no16==1)
                                  {
                                      $exam_level3='1';
                                 
                                 }else if ($no17==1)
                                 {
                                       $exam_level3='1';

                                 }else if ($no18==1)
                                 { 
                                       $exam_level3='1';
                                 }
                                 else
                                       $exam_level3='0';


                                  #cal_exam_result
                                  if ($exam_level3 > 0)
                                  {
                                      $exam_result="RED";
                                      $color="#FF0000";
                                 }else if ($exam_level2>0)
                                 {
                                       $exam_result="ORANGE";
                                       $color="#FF6600";

                                 }else if ($exam_level1>0)
                                 { 
                                       $exam_result="YELLOW";
                                       $color="#F3FF00";
                                 }
                                 else
                                       $exam_result="ERROR";


                                       

        if ($answer =="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ") {
            $answer = "abnormal_nhso";
        } else if ($answer =="แนะนำให้ไป รพ. ทันที") {
            $answer = "abnormal_hospital";
        } else
            $answer = "normal";


           
            $sql="insert into exam1(pid,hoscode,hosname,amp_code,amp_name,pemail,pname,pcid,age,ptel,no1,no2,no3,no4,no5,no6,no7,no8,no9,no10,no11,no12,no13,no14,no15,no16,no17,no18,exam_level1,exam_level2,exam_level3,exam_result,week) 
            values ('$pid','$hoscode','$hosname','$amp_code','$amp_name','$pemail','$pname','$pcid','$age','$ptel','$no1','$no2','$no3','$no4','$no5','$no6','$no7','$no8','$no9','$no10','$no11','$no12','$no13','$no14','$no15','$no16','$no17','$no18','$exam_level1','$exam_level2','$exam_level3','$exam_result','$week')

            ";
            //WHERE pid = '$pid'
            $result= $database->query($sql);
            //echo $result;

            //echo '<script>alert("เพิ่มข้อมูลในแบบประเมินสำเร็จแล้ว")</script>';
            //
            echo "<script language='javascript'> alert('เพิ่มข้อมูลในแบบประเมินสำเร็จแล้ว');window.location='index.php';</script>";
           
            //header("location: index.php");
            
        }
    }





 ?>