<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Risk Reports</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
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
    // print_r($userfetch);
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    echo $userid;
    echo $username;
    


    date_default_timezone_set('Asia/Bangkok');

    $today = date('Y-m-d');

    $week=$_POST['week'];

    
    //print_r($_POST);



    //echo $week;

 //echo $userid;
 ?>
 <div class="container">
     <div class="menu">
     <table class="menu-container" border="0">
             <tr>
                 <td style="padding:10px" colspan="2">
                     <table border="0" class="profile-container">
                         <tr>
                             <td width="30%" style="padding-left:20px" >
                                 <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                             </td>
                             <td style="padding:0px;margin:0px;">
                                 <p class="profile-title"><?php echo $username ?></p>
                                 <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2">
                                 <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                             </td>
                         </tr>
                 </table>
                 </td>
             </tr>
             <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor menu-active menu-icon-doctor-active">
                        <a href="doctors.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Doctors</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home">
                        <a href="exam.php" class="non-style-link-menu"><div><p class="menu-text">Exam</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-doctor">
                        <a href="monitor.php" class="non-style-link-menu"><div><p class="menu-text">Monitor</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                        <a href="report.php" class="non-style-link-menu"><div><p class="menu-text">Report</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
                        <a href="settings.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="exam.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td >
                            <form action="exam.php" method="post" class="header-search">

                                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors" >&nbsp;&nbsp;
                                        
                                        <?php
                                            echo '<datalist id="doctors">';
                                            $list11 = $database->query("select DISTINCT * from  doctor;");
                                            $list12 = $database->query("select DISTINCT * from  schedule GROUP BY title;");
                                            

                                            


                                            for ($y=0;$y<$list11->num_rows;$y++){
                                                $row00=$list11->fetch_assoc();
                                                $d=$row00["docname"];
                                               
                                                echo "<option value='$d'><br/>";
                                               
                                            };


                                            for ($y=0;$y<$list12->num_rows;$y++){
                                                $row00=$list12->fetch_assoc();
                                                $d=$row00["title"];
                                               
                                                echo "<option value='$d'><br/>";
                                                                                         };

                                        echo ' </datalist>';
            ?>
                                        
                                
                                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                                
                                echo $today;

                                

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                        <!-- <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49);font-weight:400;">Scheduled Sessions / Booking / <b>Review Booking</b></p> -->
                        
                    </td>
                    
                </tr>
                
                
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                            
                        <tbody>
                        
                            <?php
                                          


                            if(($_GET)){
                                
                                
                                if(isset($_GET["id"])){
                                $id=$_GET["id"];


                                    // $sqlmain= "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduleid=$id  order by schedule.scheduledate desc";
                                    
                                    $sqlmain="select patient.pid,patient.pname,patient.pemail,patient.pcid,exam1.age,exam1.ptel,
                                    patient.gravida,exam1.week,patient.lmp,patient.edc,
									patient.weight,patient.height,patient.bmi,
									exam1.no1,exam1.no2,exam1.no3,exam1.no4,
                                    exam1.no5,exam1.no6,exam1.no7,exam1.no8,
								    exam1.no9,exam1.no10,exam1.no11,exam1.no12,
								    exam1.no13,exam1.no14,exam1.no15,exam1.no16,
									exam1.no17,exam1.no18
                                    from patient
                                    INNER JOIN exam1 on patient.pid = exam1.pid
                                    where patient.pid=$id order by patient.pid desc limit 1";
                                    
                                    //echo $sqlmain;

                                    $result= $database->query($sqlmain);
                                    $row=$result->fetch_assoc();
                                    $pid=$row["pid"];
                                    $pname=$row["pname"];
                                    $pemail=$row["pemail"];
                                    $pcid=$row["pcid"];
                                    $age=$row["age"];
                                    $ptel=$row["ptel"];
                                    $gravida=$row['gravida'];
                                    $week=$row['week'];
                                    $lmp=$row["lmp"];
                                    $edc=$row['edc'];
                                    $weight=$row['weight'];
                                    $height=$row["height"];
                                    $bmi=$row['bmi'];  
                                    #exam_level1
                                    $no1=$row['no1'];
                                    $no2=$row['no2'];
                                    $no3=$row['no3'];
                                    $no4=$row['no4'];
                                    $no5=$row['no5'];
                                    $no6=$row['no6'];
                                    $no7=$row['no7'];
                                    $no8=$row['no8'];
                                    #exam_level2
                                    $no9=$row['no9'];
                                    $no10=$row['no10'];
                                    $no11=$row['no11'];
                                    $no12=$row['no12'];
                                    $no13=$row['no13'];
                                    $no14=$row['no14'];
                                    $no15=$row['no15'];
                                    #exam_level3
                                    $no16=$row['no16'];
                                    $no17=$row['no17'];  
                                    $no18=$row['no18'];   
        

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

                                        
                                        // function chkToColor($exam_result)
                                        // {
                                        //     if($exam_result="RED")
                                        //     {
                                        //         echo "<font color='#FF0000'>ความเสี่ยงสูง</font>";
                                        //     }
                                        //     elseif ($exam_result="ORANGE") {
                                        //         echo "<font color='#FFAA00'>ความเสี่ยงมาก</font>";
                                        //     }
                                        //     elseif ($exam_result="YELLOW") {
                                        //         echo "<font color='#F3FF00'>ความเสี่ยงปานกลาง</font>";
                                        //     }
                                        //     elseif ($exam_result="NORMAL") {
                                        //         echo "<font color='#23FF00'>ไม่มีความเสี่ยง</font>";
                                        //     }
                                        //     else{
                                        //         echo "<font color='#FFFFF'>ผิดพลาด</font>";
                                        //     }
                                    
                                        //     return $exam_result;
                                        //     return $n == 1 ? 'ใช่' : 'ไม่ใช่';
                                        // }   

                                //$exam_result=$_REQUEST["exam_result"]; //ค่าตัวแปรที่รับมา
                                // if($exam_result == "RED") $color="#FF0000"; // สีแดง
                                // if($exam_result == "ORANGE") $color="#FF6600"; // สีส้ม        
                                // if($exam_result == "YELLOW") $color="#F3FF00"; // สีเหลือง                                    

                                    echo '

                                    <td style="width: 50%;" rowspan="2">
                                    <div  class="dashboard-items search-items"  >
                                    
                                        <div style="width:100%">
                                                <div class="h1-search" style="font-size:25px;">
                                                    รายละเอียดผู้ป่วย
                                                </div><br><br>
                                                <div class="h3-search" style="font-size:18px;line-height:30px">
                                                    ลำดับ (Patient ID) :  &nbsp;&nbsp;<b>'.$pid.'</b><br>
                                                    อีเมล์ (Patient Email):  &nbsp;&nbsp;<b>'.$pemail.'</b><br> 
                                                    ชื่อ นามสกุล (Patient Name):  &nbsp;&nbsp;<b>'.$pname.'</b> 
                                                </div>
                                                <div class="h3-search" style="font-size:18px;">
                                                  
                                                </div><br>
                                                <div class="h3-search" style="font-size:18px;">
                                                    เลขบัตรประชาชน (Patient CID): '.$pcid.'<br>
                                                    อายุ (Patient Age): '.$age.'<br>
                                                    เบอร์โทรศัพท์ (Patient Telephone): '.$ptel.'<br>
                                                    ครรภ์ที่(GRAVIDA): '.$gravida.'<br>
                                                    ประจำเดือนครั้งสุดท้าย(LMP): '.$lmp.'<br>
                                                    กำหนดคลอด(EDC): '.$edc.'<br>
                                                    น้ำหนักก่อนคลอด(WEIGHT): '.$weight.'<br>
                                                    ส่วนสูง(HEIGHT): '.$height.'<br>
                                                    ค่าดัชนีมวลกาย(BMI): '.$bmi.'<br>
                                                    สัปดาห์ที่ประเมิน (Week Examination): '.$week.'<br>
                                                    </b>

                                                </div>
                                                <br>
                                                
                                        </div>
                                                
                                    </div>
                                </td>

                    

                                    <center>
                                    <div style="display: flex;justify-content: center;">
                                    <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                    
                                        <tr>
                                            <td>
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">ผลประเมิน.</p><br><br>
                                            </td>
                                        </tr>
                                            
                                            <tr>
                                                <form action="exam_level-complete.php" method="POST" class="add-new-form">
                                                <input type="hidden" name="id" value="'.$id.'" >
                                                <input type="hidden" name="pid" value="'.$pid.'" >
                                                <input type="hidden" name="pemail" value="'.$pemail.'" >
                                                <input type="hidden" name="pname" value="'.$pname.'" >
                                                <input type="hidden" name="pcid" value="'.$pcid.'" >
                                                <input type="hidden" name="age" value="'.$age.'" >
                                                <input type="hidden" name="ptel" value="'.$ptel.'" >
                                                <input type="hidden" name="gravida" value="'.$gravida.'" >
                                                <input type="hidden" name="week" value="'.$week.'" >                                 
                                                <input type="hidden" name="lmp" value="'.$lmp.'" >
                                                <input type="hidden" name="edc" value="'.$edc.'" >
                                                <input type="hidden" name="weight" value="'.$weight.'" >
                                                <input type="hidden" name="height" value="'.$height.'" >
                                                <input type="hidden" name="bmi" value="'.$bmi.'" >

                                                <input type="hidden" name="no1" value="'.$no1.'" >
                                                <input type="hidden" name="no2" value="'.$no2.'" >
                                                <input type="hidden" name="no3" value="'.$no3.'" >
                                                <input type="hidden" name="no4" value="'.$no4.'" >
                                                <input type="hidden" name="no5" value="'.$no5.'" >
                                                <input type="hidden" name="no6" value="'.$no6.'" >
                                                <input type="hidden" name="no7" value="'.$no7.'" >
                                                <input type="hidden" name="no8" value="'.$no8.'" >
                                                <input type="hidden" name="no9" value="'.$no9.'" >
                                                <input type="hidden" name="no10" value="'.$no10.'" >
                                                <input type="hidden" name="no11" value="'.$no11.'" >
                                                <input type="hidden" name="no12" value="'.$no12.'" >
                                                <input type="hidden" name="no13" value="'.$no13.'" >
                                                <input type="hidden" name="no14" value="'.$no14.'" >
                                                <input type="hidden" name="no15" value="'.$no15.'" >
                                                <input type="hidden" name="no16" value="'.$no16.'" >
                                                <input type="hidden" name="no17" value="'.$no17.'" >
                                                <input type="hidden" name="no18" value="'.$no18.'" >

                                                <input type="hidden" name="exam_level1" value="'.$exam_level1.'" >
                                                <input type="hidden" name="exam_level2" value="'.$exam_level2.'" >
                                                <input type="hidden" name="exam_level3" value="'.$exam_level3.'" >                                               
                                                <input type="hidden" name="exam_result" value="'.$exam_result.'" >
                                                


                                                <tr bgcolor="'.$color.'">
                                                <td class="label-td" colspan="2">
                                                <h2>'.$exam_result.'</h2> <br><br>                  
                                                </td>
                                                </tr>


                                            <tr>
                                            <td colspan="2">
                                                <input type="reset" value="ล้างค่าเริ่มต้น" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            
                                                <input type="submit" value="ยืนยันผลคัดกรองจำแนกสีตามความเสี่ยง" name="exam" class="login-btn btn-primary btn">
                                            </td>
                            
                                            </tr>

                                                </form>
                                            </tr>
                                        </table>
                                        </div>
                                        </div>
                                    </center>
                                    <br><br>
                                        '; 
                                        
                                        #<td class="label-td" colspan="2" p style="color:red;">
                                        #<h2>  '.chkToColor($exam_result).'</h2> <br><br>
                                        #<h2>  '.$exam_result.'</h2> <br><br>
                                        
                                }

                                
                            }
                            
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    
    
   
    </div>

</body>
</html>