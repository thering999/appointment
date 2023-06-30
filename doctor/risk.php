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
                    <a href="monitor.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td >
                            <form action="monitor.php" method="post" class="header-search">

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
                                    
                                    $sqlmain="select patient.pid,patient.pname,patient.pemail,patient.pcid,patient.age,patient.ptel,
                                    monitor1.lmp,monitor1.week,monitor1.start_date,monitor1.end_date,
                                    monitor1.no1_1,monitor1.no1_2,monitor1.no1_3,monitor1.no1_4,
                                    monitor1.no2_1,monitor1.no2_2,monitor1.no3,monitor1.no4,monitor1.no5,monitor1.no6,
                                    monitor1.no7,monitor1.no8,monitor1.no9,monitor1.no10
                                    from patient
                                    INNER JOIN monitor1 on patient.pid = monitor1.pid
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
                                    $lmp=$row["lmp"];
                                    $week=$row['week'];
                                    $start_date=$row['start_date'];
                                    $end_date=$row['end_date'];
                                    $no1_1=$row['no1_1'];
                                    $no1_2=$row['no1_2'];
                                    $no1_3=$row['no1_3'];
                                    $no1_4=$row['no1_4'];
                                    $no2_1=$row['no2_1'];
                                    $no2_2=$row['no2_2'];
                                    $no3=$row['no3'];
                                    $no4=$row['no4'];
                                    $no5=$row['no5'];
                                    $no6=$row['no6'];
                                    $no7=$row['no7'];
                                    $no8=$row['no8'];
                                    $no9=$row['no9'];
                                    $no10=$row['no10'];

                                    
                                    // if ($no1_1 = 1 || $no1_3 = 1 || $no1_4 = 1 || $no2_1 = 1 || $no2_2 = 1)
                                    // {
                                    //     $answer="แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ";
                                    
                                    // } else if ($no1_2 = '1')
                                    // {
                                    //     $answer="ผลประเมินปกติ";
                                    
                                    // } else if ($no3 = 1 || $no4 = 1 || $no5 = 1 || $no6 = 1 || $no7 = 1 || $no8 = 1 || $no9 = 1 || $no10 = 1)
                                    //  { 
                                    //     $answer="แนะนำให้ไป รพ. ทันที";
                                    //  }



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
                                        //echo "ผลประเมินปกติ";

                                    
                                        //echo("$answer");

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
                                                    ประจำเดือนครั้งสุดท้าย(LMP): '.$lmp.'<br>
                                                    สัปดาห์ที่ประเมิน(Week): '.$week.'<br>
                                                    วันที่เริ่มประเมิน(start_date): '.$start_date.'<br>
                                                    วันที่สิ้นสุดประเมิน(end_date): '.$end_date.'<br>
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
                                                <form action="risk-complete.php" method="POST" class="add-new-form">
                                                <input type="hidden" name="id" value="'.$id.'" >
                                                <input type="hidden" name="pid" value="'.$pid.'" >
                                                <input type="hidden" name="pemail" value="'.$pemail.'" >
                                                <input type="hidden" name="pname" value="'.$pname.'" >
                                                <input type="hidden" name="pcid" value="'.$pcid.'" >
                                                <input type="hidden" name="age" value="'.$age.'" >
                                                <input type="hidden" name="ptel" value="'.$ptel.'" >
                                                <input type="hidden" name="lmp" value="'.$lmp.'" >
                                                <input type="hidden" name="week" value="'.$week.'" >
                                                <input type="hidden" name="start_date" value="'.$start_date.'" >
                                                <input type="hidden" name="end_date" value="'.$end_date.'" >
                                                <input type="hidden" name="no1_1" value="'.$no1_1.'" >
                                                <input type="hidden" name="no1_2" value="'.$no1_2.'" >
                                                <input type="hidden" name="no1_3" value="'.$no1_3.'" >
                                                <input type="hidden" name="no1_4" value="'.$no1_4.'" >
                                                <input type="hidden" name="no2_1" value="'.$no2_1.'" >
                                                <input type="hidden" name="no2_2" value="'.$no2_2.'" >
                                                <input type="hidden" name="no3" value="'.$no3.'" >
                                                <input type="hidden" name="no4" value="'.$no4.'" >
                                                <input type="hidden" name="no5" value="'.$no5.'" >
                                                <input type="hidden" name="no6" value="'.$no6.'" >
                                                <input type="hidden" name="no7" value="'.$no7.'" >
                                                <input type="hidden" name="no8" value="'.$no8.'" >
                                                <input type="hidden" name="no9" value="'.$no9.'" >
                                                <input type="hidden" name="no10" value="'.$no10.'" >
                                                <input type="hidden" name="answer" value="'.$answer.'" >

                                                <tr>
                                                <td class="label-td" colspan="2" p style="color:red;">
                                                <h2>  '.$answer.'</h2> <br><br>
                                                </td>
                                            </tr>


                                            <tr>
                                            <td colspan="2">
                                                <input type="reset" value="ล้างค่าเริ่มต้น" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            
                                                <input type="submit" value="ยืนยันผลประเมิน" name="risk" class="login-btn btn-primary btn">
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