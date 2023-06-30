<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Monitoring Sessions</title>
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
                                    
                                    $sqlmain="select patient.*
                                    from patient
                                    where patient.pid=$id  order by patient.pid desc";
                                    
                                    //echo $sqlmain;

                                    $result= $database->query($sqlmain);
                                    $row=$result->fetch_assoc();
                                    $pid=$row["pid"];

                                    $hoscode=$row["hoscode"];
                                    $hosname=$row["hosname"];
                                    $amp_code=$row["amp_code"];
                                    $amp_name=$row["amp_name"];

                                    $pemail=$row["pemail"];
                                    $pname=$row["pname"];
                                    $pcid=$row["pcid"];
                                    $age=$row["age"];
                                    $ptel=$row["ptel"];
                                    $lmp=$row["lmp"];
                                    $week=$_POST['week'];



                                    $start_date = $lmp;  
                                    $new_start_date = strtotime($start_date);
                                    $day_week = $week*7; 
                                    $day_week_end = $day_week+7;
                                    $start_date = date('Y-m-d', strtotime("+$day_week day ",$new_start_date));
                                    $end_date = date('Y-m-d', strtotime("+$day_week_end day ",$new_start_date));
                                    // $start_date = date('Y-m-d', strtotime("$lmp+7 day * $week)", strtotime($start_date)));
                                    // $end_date = date('Y-m-d', strtotime('+7 day', strtotime($start_date)));


                                    // $sql2="select * from appointment where scheduleid=$id";
                                    // //echo $sql2;
                                    //  $result12= $database->query($sql2);
                                    //  $apponum=($result12->num_rows)+1;
                                    
                                    // echo '
                                    //     <form action="booking-complete.php" method="post">
                                    //         <input type="hidden" name="scheduleid" value="'.$scheduleid.'" >
                                    //         <input type="hidden" name="apponum" value="'.$apponum.'" >
                                    //         <input type="hidden" name="date" value="'.$today.'" >

                                        
                                    
                                    // ';
                                     

                                    echo '

                                    <td style="width: 50%;" rowspan="2">
                                    <div  class="dashboard-items search-items"  >
                                    
                                        <div style="width:100%">
                                                <div class="h1-search" style="font-size:25px;">
                                                    รายละเอียดผู้ป่วยที่จะทำแบบประเมิน
                                                </div><br><br>
                                                <div class="h3-search" style="font-size:18px;line-height:30px">
                                                    ลำดับ (Patient ID) :  &nbsp;&nbsp;<b>'.$pid.'</b><br>
                                                    รหัสหน่วยบริการ (hoscode):  &nbsp;&nbsp;<b>'.$hoscode.'</b><br> 
                                                    ชื่อหน่วยบริการ (hosname):  &nbsp;&nbsp;<b>'.$hosname.'</b><br> 
                                                    รหัสอำเภอ (amp_code):  &nbsp;&nbsp;<b>'.$amp_code.'</b><br> 
                                                    ชื่ออำเภอ (amp_code):  &nbsp;&nbsp;<b>'.$amp_name.'</b><br>  
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
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">แบบประเมิน.</p><br><br>
                                            </td>
                                        </tr>
                                            
                                            <tr>
                                                <form action="monitoring-complete.php" method="POST" class="add-new-form">
                                                <input type="hidden" name="pid" value="'.$pid.'" >
                                                <input type="hidden" name="hoscode" value="'.$hoscode.'" >
                                                <input type="hidden" name="hosname" value="'.$hosname.'" >
                                                <input type="hidden" name="amp_code" value="'.$amp_code.'" >
                                                <input type="hidden" name="amp_name" value="'.$amp_name.'" >
                                                <input type="hidden" name="pemail" value="'.$pemail.'" >
                                                <input type="hidden" name="pname" value="'.$pname.'" >
                                                <input type="hidden" name="pcid" value="'.$pcid.'" >
                                                <input type="hidden" name="age" value="'.$age.'" >
                                                <input type="hidden" name="ptel" value="'.$ptel.'" >
                                                <input type="hidden" name="lmp" value="'.$lmp.'" >
                                                <input type="hidden" name="week" value="'.$week.'" >
                                                <input type="hidden" name="start_date" value="'.$start_date.'" >
                                                <input type="hidden" name="end_date" value="'.$end_date.'" >

                                                <tr>
                                                <td width="75%" rowspan="2" align="center">
                                                <br>
                                                <strong>อาการที่ต้องไปโรงพยาบาลทันที</strong>
                                                </td>
                                                <td colspan="5" align="center"><strong>ผลที่ประเมิน (1=ใช่/0=ไม่ใช่)</strong></td>
                                              </tr>
                                              <tr>
                                                <td width="5%" align="center"><strong>1=ใช่</strong></td>
                                                <td width="5%" align="center"><strong>0=ไม่ใช่</strong></td>
                                              </tr>

                                              <tr>
                                                <td height="30">&nbsp; 1.น้ำหนัก (กิโลกรัม)</td>
                                              </tr>

                                              <tr>
                                              <td height="30">&nbsp; 1.1 BMi < 18.5 เพิ่ม 0.5 kg ต่อสัปดาห์</td>
                                               <td width="5% "height="30" align="center"><input type="radio" name="no1_1"  value="1" required /></td>
                                               <td width="5%" height="30" align="center"><input type="radio" name="no1_1"  value="0" /></td>
                                            </tr>
                                              <tr>
                                                <td height="30">&nbsp; 1.2 BMi < 18.5 - 24.9 เพิ่ม 0.4 kg ต่อสัปดาห์</td>
                                                <td width="5%" height="30" align="center"><input type="radio" name="no1_2"  value="1" required /></td>
                                                <td width="5%" height="30" align="center"><input type="radio" name="no1_2"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 1.3 BMi 25.0 - 29.9 เพิ่ม 0.3 kg ต่อสัปดาห์</td>
                                                <td width="5%" height="30" align="center"><input type="radio" name="no1_3"  value="1" required /></td>
                                                <td width="5%" height="30" align="center"><input type="radio" name="no1_3"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 1.4 BMi >= 30 เพิ่ม 0.2 kg ต่อสัปดาห์</td>
                                                <td width="5%" height="30" align="center"><input type="radio" name="no1_4"  value="1" required /></td>
                                                <td width="5%" height="30" align="center"><input type="radio" name="no1_4"  value="0"/></td>
                                              </tr>

                                              <tr>
                                                <td height="30">&nbsp; 2.การคัดกรองโรคซึมเศร้า(2Q)</td>
                                              </tr>

                                              <tr>
                                                <td height="30">&nbsp; 2.1 ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึกหดหู่ เศร้า ท้อแท้ สิ้นหวัง</td>
                                                 <td height="30" align="center"><input type="radio" name="no2_1"  value="1" required /></td>
                                                 <td height="30" align="center"><input type="radio" name="no2_1"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 2.2 ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึกเบื่อ ทำอะไรก็ไม่เพลิดเพลิน</td>
                                                <td height="30" align="center"><input type="radio" name="no2_2"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no2_2"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 3.ท้องปั่นแข็ง หรือปวดบั้นเอว ร้าวไปที่ขา หรือท้องปั้นโดยไม่ปวดท้อง</td>
                                                <td height="30" align="center"><input type="radio" name="no3"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no3"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 4.มีไข้</td>
                                                <td height="30" align="center"><input type="radio" name="no4"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no4"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 5.ปัสสาวะอักเสบขัด</td>
                                                <td height="30" align="center"><input type="radio" name="no5"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no5"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 6.ตกขาว คันช่องคลอด</td>
                                                <td height="30" align="center"><input type="radio" name="no6"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no6"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 7.น้ำเดิน *มีน้ำใสๆออกทางช่องคลอด*</td>
                                                <td height="30" align="center"><input type="radio" name="no7"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no7"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 8.มีเลือดออกทางช่องคลอด</td>
                                                <td height="30" align="center"><input type="radio" name="no8"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no8"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp; 9.เจ็บครรภ์ หรือท้องปั้นทุก 15 นาที ลูกดื้นน้อยลง</td>
                                                <td height="30" align="center"><input type="radio" name="no9"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no9"  value="0"/></td>
                                              </tr>
                                              <tr>
                                                <td height="30">&nbsp;10.ลูกดิ้นน้อยกว่า 3 ครั้งต่อชั่วโมง *นับหลังมื้ออาหาร*</td>
                                                <td height="30" align="center"><input type="radio" name="no10"  value="1" required /></td>
                                                <td height="30" align="center"><input type="radio" name="no10"  value="0"/></td>
                                              </tr>
                                
                                            <tr>
                                                <td colspan="2">
                                                    <input type="reset" value="ล้างค่าเริ่มต้น" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                    <input type="submit" value="ตกลง" name="monitor" class="login-btn btn-primary btn">
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