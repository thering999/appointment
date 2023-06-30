<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Monitoring</title>
    <style>
        .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>

<body>
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
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];


    //echo $userid;
    //echo $username;
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu ">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment">
                <a href="appointment.php" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">My Appointments</p>
                </a>
    </div>
    </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-session">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Sessions</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient menu-active menu-icon-patient-active">
            <a href="patient.php" class="non-style-link-menu  non-style-link-menu-active">
                <div>
                    <p class="menu-text">My Patients</p>
            </a></div>
        </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-home   ">
            <a href="exam.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Exam</p>
            </a></div>
        </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-doctor   ">
            <a href="monitor.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Monitor</p>
            </a></div>
        </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-dashbord">
            <a href="report.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Report</p>
            </a></div>
        </td>
    </tr>

    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings   ">
            <a href="settings.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <?php

    $selecttype = "My";
    $current = "My patients Only";
    if ($_POST) {

        if (isset($_POST["search"])) {
            $keyword = $_POST["search12"];

            $sqlmain = "select * from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' ";
            $selecttype = "my";
        }

        if (isset($_POST["filter"])) {
            if ($_POST["showonly"] == 'all') {
                $sqlmain = "select * from patient";
                $selecttype = "All";
                $current = "All patients";
            } else {
                $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
                $selecttype = "My";
                $current = "My patients Only";
            }
        }
    } else {
        $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
        $selecttype = "My";
    }



    ?>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">

                    <a href="index.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>

                </td>
                <td>

                    <form action="" method="post" class="header-search">

                        <input type="search" name="search12" class="input-text header-searchbar" placeholder="Search Patient name or Email" list="patient">&nbsp;&nbsp;

                        <?php
                        echo '<datalist id="patient">';
                        $list11 = $database->query($sqlmain);
                        //$list12= $database->query("select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=1;");

                        for ($y = 0; $y < $list11->num_rows; $y++) {
                            $row00 = $list11->fetch_assoc();
                            $d = $row00["pname"];
                            $c = $row00["pemail"];
                            echo "<option value='$d'><br/>";
                            echo "<option value='$c'><br/>";
                        };

                        echo ' </datalist>';
                        ?>


                        <input type="Submit" value="Search" name="search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">

                    </form>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php
                        date_default_timezone_set('Asia/Bangkok');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>

            <tr ></tr>
                    <td colspan="2" style="padding-top:30px;">
                       <p  class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)"></p>
                    </td>
                    <td colspan="2">
                        <a href="?action=add&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add New Patients</font></button>
                            </a></td>
                </tr>

            <tr>
                <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $selecttype . " Patients (" . $list11->num_rows . ")"; ?></p>
                </td>

            </tr>
            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0">

                            <form action="" method="post">

                                <td style="text-align: right;">
                                    Show Details About : &nbsp;
                                </td>
                                <td width="30%">
                                    <select name="showonly" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;">
                                        <option value="" disabled selected hidden><?php echo $current   ?></option><br />
                                        <option value="my">My Patients Only</option><br />
                                        <option value="all">All Patients</option><br />


                                    </select>
                                </td>
                                <td width="12%">
                                    <input type="submit" name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter" style="padding: 15px; margin :0;width:100%">
                            </form>
                </td>

            </tr>
        </table>
        </center>
        </td>
        </tr>



        <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    Name
                                </th>

                                <th class="table-headin">
                                    CID
                                </th>


                                <th class="table-headin">
                                    AGE
                                </th>


                                <th class="table-headin">
                                    ครรภ์ที่(GRAVIDA)
                                </th>

                                <th class="table-headin">
                                    ประจำเดือนครั้งสุดท้าย(LMP)
                                </th>

                                <th class="table-headin">
                                    กำหนด ANC 12 สัปดาห์(ระบบประเมิน)
                                </th>

                                <th class="table-headin">    
                                    Events
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php


// $nextweek=date("Y-m-d",strtotime("+1 week"));


                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="patient.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Patients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){

                                    $row=$result->fetch_assoc();
                                    $pid=$row["pid"];
                                    $name=$row["pname"];
                                    $cid=$row["pcid"];
                                    $age=$row["age"];
                                    $gravida=$row["gravida"];
                                    $lmp=$row["lmp"];

                                    // anc12week
                                    $start_date = $lmp;  
                                    $anc12week = date('Y-m-d', strtotime('+12 week', strtotime($start_date)));
                                    // start_date end_date
                                    $start_date = $anc12week ; 
                                    $end_date = date('Y-m-d', strtotime('+7 day', strtotime($start_date)));

                                    // test echo
                                    // echo('<br>');
                                    // echo ($start_date);
                                    // echo('&nbsp;');
                                    // echo ($end_date);
                                    

                                    echo '<tr>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
                                        substr($name,0,35).'
                                        </td>

                                        <td>
                                        '.substr($cid,0,12).'
                                        </td>

                                        <td>
                                        '.substr($age,0,12).'
                                        </td>
                                        
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
                                        substr($gravida,0,12).'
                                        </td>
                                      
                                        
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
                                        substr($lmp,0,12).'
                                        </td>

                                        
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        '.$anc12week.'
                                        </td>

                                        <td>
                                        <br>
                                        <div style="display:flex;justify-content: center;">

                                         <a data-url="monitoring.php?id='.$pid.'" class="non-style-link button_monitor"><button  class="btn-primary-soft btn button-icon btn-text"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Monitoring</font></button></a>
                                         &nbsp;&nbsp;&nbsp;

                                         
                                         <a href="?action=view&id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View Monitoring</font></button></a>
                                          &nbsp;&nbsp;&nbsp;

                                         <a href="risk.php?id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View Risk</font></button></a>
                                         &nbsp;&nbsp;&nbsp;
                                        </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
 
                            // <a href="?action=view_risk&id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View Risk</font></button></a>
                            // &nbsp;&nbsp;&nbsp;
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

    <?php

/**
 * Convert number to 1 to'YES' or everything else to 'NO'.
 * @param $n the number to convert.
 * @return string YES|NO
 */
function numberToString($n)
{
    return $n === 1 ? 'ใช่' : 'ไม่ใช่';
}


    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='view'){
            $sqlmain= "select * from monitor1 where pid='$id' order by monitor1.pid desc";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $id=$row["id"];
            $pid=$row["pid"];
            $name=$row["pname"];
            $email=$row["pemail"];
            $cid=$row["pcid"];
            $age=$row["age"];
            $tele=$row["ptel"];
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

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="monitor.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">ข้อมูลการประเมินความเสี่ยง.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                <label for="name" class="form-label">ID แบบประเมิน: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$id.'<br><br>
                                </td>
                            </tr>
                            


                            <td class="label-td" colspan="2">
                            <label for="name" class="form-label">Patient ID: </label>
                            </td>
                        </tr>
                                <tr>
                                <td class="label-td" colspan="2">
                                '.$pid.'<br><br>
                                </td>
                        </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">ชื่อ นามสกุลคนไข้: </label>
                                </td>
                            </tr>  
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="cid" class="form-label">CID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$cid.'<br><br>
                                </td>
                            </tr>


                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="age" class="form-label">AGE: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$age.'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>

                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="lmp" class="form-label">ประจำเดือนครั้งสุดท้าย(LMP): </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            '.$lmp.'<br><br>
                            </td>
                            </tr>



                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="week" class="form-label">สัปดาห์ที่ประเมิน(Week): </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            '.$week.'<br><br>
                            </td>
                            </tr>

                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="start_date" class="form-label">วันที่เริ่มประเมิน(start_date): </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            '.$start_date.'<br><br>
                            </td>
                            </tr>


                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="end_date" class="form-label">วันที่สิ้นสุดประเมิน(end_date): </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            '.$end_date.'<br><br>
                            </td>
                            </tr>

                            <tr>
                            <td height="30">&nbsp; 1.น้ำหนัก (กิโลกรัม)</td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no1_1" class="form-label">1.1 BMi < 18.5 เพิ่ม 0.5 kg ต่อสัปดาห์:: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no1_1).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no1๘2" class="form-label">1.2 BMi < 18.5 - 24.9 เพิ่ม 0.4 kg ต่อสัปดาห์: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no1_2).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no1_3" class="form-label">1.3 BMi 25.0 - 29.9 เพิ่ม 0.3 kg ต่อสัปดาห์: </label>
                                </td>
                            </tr>
                            <tr>
                               <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no1_3).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no1_4" class="form-label">1.4 BMi >= 30 เพิ่ม 0.2 kg ต่อสัปดาห์: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no1_4).'<br><br>
                                </td>
                            </tr>

                            <tr>
                            <td height="30">&nbsp; 2.การคัดกรองโรคซึมเศร้า(2Q)</td>
                            </tr>

                            <tr>
                                "<td class="label-td" colspan="2">
                                    <label for="no2_1" class="form-label">2.1 ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึกหดหู่ เศร้า ท้อแท้ สิ้นหวัง: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no2_1).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no2_2" class="form-label">2.2 ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึกเบื่อ ทำอะไรก็ไม่เพลิดเพลิน: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no2_2).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no3" class="form-label">3.ท้องปั่นแข็ง หรือปวดบั้นเอว ร้าวไปที่ขา หรือท้องปั้นโดยไม่ปวดท้อง: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no3).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no4" class="form-label">4.มีไข้: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no4).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no5" class="form-label">5.ปัสสาวะอักเสบขัด: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no5).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no6" class="form-label">6.ตกขาว คันช่องคลอด: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no6).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no7" class="form-label">7.น้ำเดิน *มีน้ำใสๆออกทางช่องคลอด*: </label> 
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no7).'<br><br>
                            </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no12" class="form-label">8.มีเลือดออกทางช่องคลอด: </label>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no8).'<br><br>
                                </td> 
                            </tr>



                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="no9" class="form-label">9.เจ็บครรภ์ หรือท้องปั้นทุก 15 นาที ลูกดื้นน้อยลง: </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no9).'<br><br>
                                </td> 
                            </tr>


                        <tr>
                        <td class="label-td" colspan="2">
                            <label for="no10" class="form-label">10.ลูกดิ้นน้อยกว่า 3 ครั้งต่อชั่วโมง *นับหลังมื้ออาหาร*: </label>
                        </td>
                    </tr>
                    <tr>
                    <td class="label-td" colspan="2" p style="color:red;">
                    '.numberToString($no10).'<br><br>
                        </td> 
                    </tr>


                  
                    <tr>
                        <td colspan="2">
                        <a href="monitor.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                    </td>
                    </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }
        elseif($action=='view_risk')
        {
            $sqlmain= "select * from exam1 where pid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $id=$row["id"];
            $pid=$row["pid"];
            $name=$row["pname"];
            $email=$row["pemail"];
            $cid=$row["pcid"];
            $age=$row["age"];
            $tele=$row["ptel"];

            $no1=$row["no1"];
            $no2=$row["no2"];
            $no3=$row["no3"];
            $no4=$row["no4"];
            $no5=$row["no5"];
            $no6=$row["no6"];
            $no7=$row["no7"];
            $no8=$row["no8"];
            $no9=$row["no9"];
            $no10=$row["no10"];
            $no11=$row["no11"];
            $no12=$row["no12"];
            $no13=$row["no13"];
            $no14=$row["no14"];
            $no15=$row["no15"];
            $no16=$row["no16"];
            $no17=$row["no17"];
            $no18=$row["no18"];

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="monitor.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">ข้อมูลการประเมินความเสี่ยง.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                

      
                            <tr>
                                <td colspan="2">
                                    <a href="monitor.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
    }
};
        
        ?>
        </div>
        

        <div id="popup_select_week" class="overlay" style="display: none;">
                    <div class="popup">
                    <center>
                    
                        <a class="close" href="monitor.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">


            <form id="form_modal" action="monitoring.php?id=<?=$pid?>" method="post" class="header">


                    <!-- <td class="label-td" colspan="2">
                            <label for="name" class="form-label">Patient ID: </label>
                            </td>
                        </tr>
                                <tr>
                                <td class="label-td" colspan="2">
                                <?=$pid?><br><br>
                                </td>
                    </tr> -->


                    <td class="label-td" colspan="2">
                    <label for="week_name" class="form-label">กรุณาเลือกสัปดาห์ที่ประเมินอายุที่ตั้งครรภ์: </label>
                    </td> 
                    <br>
                    <br>
                    <br>


                            <select name="week" class="btn btn-success">
                                <option value="12">Week 12</option>
                                <option value="24">Week 24</option>
                                <option value="25">Week 25</option>
                                <option value="26">Week 26</option>
                                <option value="27">Week 27</option>
                                <option value="28">Week 28</option>
                                <option value="29">Week 29</option>
                                <option value="30">Week 30</option>
                                <option value="31">Week 31</option>
                                <option value="32">Week 32</option>
                                <option value="33">Week 33</option>
                                <option value="34">Week 34</option>
                                <option value="35">Week 35</option>
                                <option value="36">Week 36</option>
                                <option value="37">Week 37</option>
                                <option value="38">Week 38</option>
                            </select>


                <tr>

                <td colspan="2">
                <br><br><br>

                <input type="submit" value="ตกลง" name="monitor" class="login-btn btn-primary btn">
                </td>
                </tr>

                        </div>
                        </div>
                    </center>
                    <br><br>
            </form>
            </div>
            </div>        


</div>
<script src="../js/jquery/jquery-1.8.3.js"></script>     
<script src="../js/jquery/jquery-ui-1.9.2.custom.min.js"></script> 
        <script>
            $('.button_monitor').on('click',function(e){
                console.log($(this).attr('data-url'));
                let url = $(this).attr('data-url');
                let md = $('#popup_select_week');
                let form = $('#form_modal');
                form.prop('action',url);
                console.log(form.attr('action'));
                $('#popup_select_week').fadeIn();
            })
        </script>
        </body>
        </html>