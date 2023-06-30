<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Exam</title>
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
                // $sqlmain = "select patient.*,exam1.exam_result from patient 
                // INNER JOIN exam1 on patient.pcid = exam1.pcid";
                $sqlmain = "select patient.*,exam1.* from patient,exam1
                where patient.pid=$userid;";
                $selecttype = "All";
                $current = "All patients";
            } else {
                $sqlmain = "select * from appointment 
                inner join patient on patient.pid=appointment.pid 
                inner join schedule on schedule.scheduleid=appointment.scheduleid 
                INNER JOIN exam1 on exam1.pcid = patient.pcid 
                where schedule.docid=$userid;";
                $selecttype = "My";
                $current = "My patients Only";
            }
        }
    } else {
        #$sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
        $sqlmain = "select patient.*,exam1.* from patient,exam1
        where patient.pid=$userid;"; 
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
                        <a href="?action=add&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add New Examination</font></button>
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
                                        รหัสหน่วยบริการ (hoscode)
                                    </th>

                                    <th class="table-headin">
                                        ชื่อหน่วยบริการ (hosname)
                                    </th>


                                    <th class="table-headin">
                                        รหัสอำเภอ (amp_code)
                                    </th>


                                    <th class="table-headin">
                                        ชื่ออำเภอ (amp_code)
                                    </th>

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
                                    สัปดาห์ที่ประเมิน (Week Examination)
                                </th>

                                <th class="table-headin">
                                    ผลการตัดกรอง (Exam_result)
                                </th>
                                

                                <th class="table-headin">    
                                    Events
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
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

                                    $hoscode=$row["hoscode"];
                                    $hosname=$row["hosname"];
                                    $amp_code=$row["amp_code"];
                                    $amp_name=$row["amp_name"];

                                    $pid=$row["pid"];
                                    $pemail=$row["pemail"];
                                    $name=$row["pname"];
                                    $cid=$row["pcid"];
                                    $age=$row["age"];
                                    $gravida=$row["gravida"];
                                    $week=$row["week"];
                                    $exam_result=$row["exam_result"];




                                   #cal_exam_result
                                   if ($exam_result == "RED")
                                   {
                                       $color="#FF0000";
                                  }else if ($exam_result == "ORANGE")
                                  {
                                        $color="#FF6600";

                                  }else if ($exam_result == "YELLOW")
                                  { 
                                        $color="#F3FF00";
                                  }
                                  else
                                        $exam_result="ERROR";


                                    echo '<tr>
                                        <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
                                        substr($hoscode,0,35).'
                                        </td>

                                        <td>
                                        '.substr($hosname,0,12).'
                                        </td>

                                        <td>
                                        '.substr($amp_code,0,12).'
                                        </td>

                                        <td>
                                        '.substr($amp_name,0,12).'
                                        </td>

                                        <td>
                                        '.substr($name,0,12).'
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
                                        substr($week,0,12).'
                                        </td>

                                        <td bgcolor="'.$color.'"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
                                        substr($exam_result,0,12).'

                                        </td>                                        


                                        <td>
                                        <br>
                                        <div style="display:flex;justify-content: center;">
                            
                                        <a href="examination.php?id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-text"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Examination</font></button></a>
                                        &nbsp;&nbsp;&nbsp;


                                        <a href="?action=view&id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View Exam</font></button></a>
                                        &nbsp;&nbsp;&nbsp;



                                        <a href="exam_level.php?id='.$pid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Exam Level</font></button></a>
                                        &nbsp;&nbsp;&nbsp;

                                        <a href="?action=drop&id='.$pid.'&name='.$name.'&email='.$pemail.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Delete Exam</font></button></a>

                                        </div>
                                        </td>
                                    </tr>';
                                    
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

    <?php


/**
 * Convert number to 1 to'YES' or everything else to 'NO'.
 * @param $n the number to convert.
 * @return string YES|NO
 */
function numberToString($n)
{
    return $n == 1 ? 'ใช่' : 'ไม่ใช่';
}

if($_GET){
        
$id=$_GET["id"];
$action=$_GET["action"];
if($action=='drop'){
    $nameget=$_GET["name"];
    echo '
    <div id="popup1" class="overlay">
            <div class="popup">
            <center>
                <h2>คุณแน่ใจใช่หรือไม่?</h2>
                <a class="close" href="exam.php">&times;</a>
                <div class="content">
                คุณต้องการลบ record นี้<br>('.substr($nameget,0,40).').
                    
                </div>
                <div style="display: flex;justify-content: center;">
                <a href="delete-patient.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;ใช่&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                <a href="exam.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;ไม่ใช่&nbsp;&nbsp;</font></button></a>

                </div>
            </center>
    </div>
    </div>
    ';
}elseif($action=='view'){ 
            $sqlmain= "select * from exam1 where pid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();


            $id=$row["id"];
            $pid=$row["pid"];

            $hoscode=$row["hoscode"];
            $hosname=$row["hosname"];
            $amp_code=$row["amp_code"];
            $amp_name=$row["amp_name"];



            $name=$row["pname"];
            $email=$row["pemail"];
            $cid=$row["pcid"];
            $age=$row["age"];
            $tele=$row["ptel"];

            $week=$row["week"];

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
            $exam_result=$row["exam_result"];

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="exam.php">&times;</a>
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
                            <label for="hoscode" class="form-label">รหัสหน่วยบริการ (hoscode): </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            ' . $hoscode . '<br><br>
                        </td>
                    </tr>

                    <tr>
                    <td class="label-td" colspan="2">
                        <label for="hosname" class="form-label">ชื่อหน่วยบริการ (hosname): </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        ' . $hosname . '<br><br>
                    </td>
                </tr>



                <tr> 
                <td class="label-td" colspan="2">
                    <label for="amp_code" class="form-label">รหัสอำเภอ (amp_code): </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    ' . $amp_code . '<br><br>
                </td>
            </tr>


            <tr>
            <td class="label-td" colspan="2">
                <label for="amp_name" class="form-label">ชื่ออำเภอ (amp_code): </label>
            </td>
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                ' . $amp_name . '<br><br>
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
                                    <label for="Tele" class="form-label">สัปดาห์ที่ประเมิน (Week Examination): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$week.'<br><br>
                                </td>
                            </tr>


                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no1" class="form-label">ข้อที่1 อายุมากกว่า 35 ปีหรือไม่ ?:: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no1).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no2" class="form-label">ข้อที่2 อายุน้อยกว่า 17 ปี ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no2).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no3" class="form-label">ข้อที่3 BMI น้อยกว่า 18.5 Kg/m2 หรือมากกว่า 25 Kg/m2 ณ ประเมิน ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no3).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no4" class="form-label">ข้อที่4 รายได้น้อยกว่า 36000 ต่อปี ?: </label>
                                </td>
                            </tr>
                            <tr>
                                 <td class="label-td" colspan="2" p style="color:red;">
                                 '.numberToString($no4).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                "<td class="label-td" colspan="2">
                                    <label for="no5" class="form-label">ข้อที่5 มีประวัติไม่เคยฝากครรภ์ ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no5).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no6" class="form-label">ข้อที่6 ทานอาหารไม่ครบส่วน ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no6).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no7" class="form-label">ข้อที่7 มีความเครียด/นอนไม่หลับ ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no7).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no8" class="form-label">ข้อที่8 เคยผ่าตัดคลอด ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no8).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no9" class="form-label">ข้อที่9 มีประวัติคลอดก่อนกำหนด ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no9).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no10" class="form-label">ข้อที่10 เคยมีประวัติแท้ง ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no10).'<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no11" class="form-label">ข้อที่11 มีโรคประจำตัวทุกโรค ?: </label> 
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no11).'<br><br>
                            </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="no12" class="form-label">ข้อที่12 สูบบุหรี่/ดื่นสุรา/ใช้สารเสพติด ?: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no12).'<br><br>
                                </td> 
                            </tr>



                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="no13" class="form-label">ข้อที่13 ทำงานหนักมากกว่า 5 วัน/ต่อสัปดาห์ ?: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no13).'<br><br>
                            </td> 
                        </tr>


                        <tr>
                        <td class="label-td" colspan="2">
                            <label for="no14" class="form-label">ข้อที่14 ระยะห่างการตั้งครรภ์ น้อยกว่า 18 เดือน ?: </label>
                        </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no14).'<br><br>
                            </td> 
                            </tr>


                        <tr>
                        <td class="label-td" colspan="2">
                            <label for="no15" class="form-label">ข้อที่15 มีประวัติการตั้งครรภ์มากกว่า 3 ครั้งขึ้นไป ?: </label>
                         </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2" p style="color:red;">
                                '.numberToString($no15).'<br><br>
                                </td> 
                            </tr>

                        <tr>
                        <td class="label-td" colspan="2">
                                <label for="no16" class="form-label">ข้อที่16 เป็นครรภ์แฝด (ปัจจุบัน) ?: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2" p style="color:red;">
                            '.numberToString($no16).'<br><br>
                            </td> 
                        </tr>

                        <tr>
                        <td class="label-td" colspan="2">
                            <label for="no17" class="form-label">ข้อที่17 มีประวัติครรภ์เป็นพิษ ?: </label>
                        </td>
                        </tr>
                        <tr>
                        <td class="label-td" colspan="2" p style="color:red;">
                        '.numberToString($no17).'<br><br>
                        </td> 
                        </tr>


                        <tr>
                        <td class="label-td" colspan="2">
                        <label for="no18" class="form-label">ข้อที่18 คอมดลูกสั้น ?: </label>
                        </td>
                        </tr>
                        <tr>
                        <td class="label-td" colspan="2" p style="color:red;">
                        '.numberToString($no18).'<br><br>
                        </td> 
                        </tr>


                        <tr>
                        <td class="label-td" colspan="2">
                            <label for="Tele" class="form-label">ระดับสีความเสี่ยง (Exam_result): </label>
                        </td>
                        </tr>
                        <tr>
                        <td class="label-td" colspan="2">
                        '.$exam_result.'<br><br>
                        </td>
                        </tr>

                            <tr>
                                <td colspan="2">
                                    <a href="exam.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
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
        



</div>
        
        </body>
        </html>