<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Examination Sessions</title>
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
                                                <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">แบบประเมิน. (ใช่=1/ไม่ใช่=0)</p><br><br>
                                            </td>
                                        </tr>
                                            
                                            <tr>
                                                <form action="examination-complete.php" method="POST" class="add-new-form">
                                                <input type="hidden" name="pid" value="'.$pid.'" >
                                                <input type="hidden" name="hoscode" value="'.$hoscode.'" >
                                                <input type="hidden" name="hosname" value="'.$hosname.'" >
                                                <input type="hidden" name="amp_code" value="'.$amp_code.'" >
                                                <input type="hidden" name="amp_name" value="'.$amp_name.'" >
                                                <input type="hidden" name="age" value="'.$age.'" >
                                                <input type="hidden" name="pemail" value="'.$pemail.'" >
                                                <input type="hidden" name="pname" value="'.$pname.'" >
                                                <input type="hidden" name="pcid" value="'.$pcid.'" >
                                                <input type="hidden" name="age" value="'.$age.'" >
                                                <input type="hidden" name="ptel" value="'.$ptel.'" >



                                                <td class="label-td" colspan="2">
                                                <label for="week" class="form-label"> สัปดาห์ที่ประเมิน (Week Examination): </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="text" name="week" class="input-text" placeholder="Week Examination"><br>
                                            </td>
                                            
                                        </tr>                                               

                                                <td class="label-td" colspan="2">
                                                    <label for="text" class="form-label">ข้อที่1 อายุมากกว่า 35 ปีหรือไม่ ?: </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" colspan="2">
                                                    <input type="radio" name="no1" required value="1">ใช่<br>
                                                     <br>
                                                    <input type="radio" name="no1" required value="0">ไม่ใช่<br>
                                                    <br>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="label-td" colspan="2">
                                                    <label for="text" class="form-label">ข้อที่2 อายุน้อยกว่า 17 ปี ?: </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label-td" colspan="2">
                                                <input type="radio" name="no2" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no2" required value="0">ไม่ใช่<br>
                                                <br>
                                           </td>
                                                </td>
                                            </tr>
                                
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่3 BMI น้อยกว่า 18.5 Kg/m2 หรือมากกว่า 25 Kg/m2 ณ ประเมิน ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no3" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no3" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่4 รายได้น้อยกว่า 36000 ต่อปี ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no4" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no4" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>
 
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่5 มีประวัติไม่เคยฝากครรภ์ ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no5" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no5" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>                                            

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่6 ทานอาหารไม่ครบส่วน ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no6" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no6" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>    

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่7 มีความเครียด/นอนไม่หลับ ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no7" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no7" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>   

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่8 เคยผ่าตัดคลอด ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no8" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no8" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>   

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่9 มีประวัติคลอดก่อนกำหนด ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no9" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no9" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>  

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่10 เคยมีประวัติแท้ง ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no10" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no10" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>  


                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่11 มีโรคประจำตัวทุกโรค ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no11" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no11" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>  

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่12 สูบบุหรี่/ดื่นสุรา/ใช้สารเสพติด ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no12" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no12" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>  

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่13 ทำงานหนักมากกว่า 5 วัน/ต่อสัปดาห์ ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no13" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no13" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>  

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่14 ระยะห่างการตั้งครรภ์ น้อยกว่า 18 เดือน ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no14" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no14" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr>  

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่15 มีประวัติการตั้งครรภ์มากกว่า 3 ครั้งขึ้นไป ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no15" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no15" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr> 

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่16 เป็นครรภ์แฝด (ปัจจุบัน) ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no16" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no16" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr> 

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่17 มีประวัติครรภ์เป็นพิษ ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no17" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no17" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr> 

                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="text" class="form-label">ข้อที่18 คอมดลูกสั้น ?: </label>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <input type="radio" name="no18" required value="1">ใช่<br>
                                                <br>
                                                <input type="radio" name="no18" required value="0">ไม่ใช่<br>
                                                <br>
                                            </td>
                                            </tr> 
                                
                                            <tr>
                                                <td colspan="2">
                                                    <input type="reset" value="ล้างค่าเริ่มต้น" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                
                                                    <input type="submit" value="ตกลง" name="exam" class="login-btn btn-primary btn">
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