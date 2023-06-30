<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Patients</title>
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

                    <a href="patient.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
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

            <tr></tr>
            <td colspan="2" style="padding-top:30px;">
                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)"></p>
            </td>
            <td colspan="2">
                <a href="?action=add&id=none&error=0" class="non-style-link"><button class="login-btn btn-primary btn button-icon" style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Add New Patients</font></button>
                </a>
            </td>
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
                        <table width="93%" class="sub-table scrolldown" style="border-spacing:0;">
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
                                        ประจำเดือนครั้งสุดท้าย(LMP)
                                    </th>


                                    <th class="table-headin">
                                        กำหนดคลอด(EDC)
                                    </th>


                                    <th class="table-headin">
                                        น้ำหนักก่อนคลอด(WEIGHT)
                                    </th>


                                    <th class="table-headin">
                                        ส่วนสูง(HEIGHT)
                                    </th>


                                    <th class="table-headin">
                                        ค่าดัชนีมวลกาย(BMI)
                                    </th>


                                    <th class="table-headin">
                                        อายุครรภ์ที่ฝากครรภ์ครั้งแรก(ANCNO)
                                    </th>


                                    <th class="table-headin">
                                        สถานที่ฝากครรภ์(ANCPLACE)
                                    </th>


                                    <th class="table-headin">
                                        รายได้ต่อเดือน(SALARY)
                                    </th>


                                    <th class="table-headin">
                                        อสม.ผู้ติดตาม(OSM)
                                    </th>


                                    <th class="table-headin">
                                        Telephone
                                    </th>


                                    <th class="table-headin">
                                        Email
                                    </th>


                                    <th class="table-headin">
                                        Date of Birth
                                    </th>


                                    <th class="table-headin">
                                        Address
                                    </th>


                                    <th class="table-headin">
                                        Events
                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                $result = $database->query($sqlmain);

                                if ($result->num_rows == 0) {
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
                                } else {
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        $row = $result->fetch_assoc();
                                        $hoscode = $row["hoscode"];
                                        $hosname = $row["hosname"];
                                        $amp_code = $row["amp_code"];
                                        $amp_name = $row["amp_name"];




                                        $pid = $row["pid"];
                                        $name = $row["pname"];
                                        $email = $row["pemail"];
                                        $cid = $row["pcid"];

                                        $age = $row["age"];
                                        $gravida = $row["gravida"];
                                        $lmp = $row["lmp"];
                                        $edc = $row["edc"];
                                        $weight = $row["weight"];
                                        $height = $row["height"];
                                        $bmi = $row["bmi"];
                                        $ancno = $row["ancno"];
                                        $ancplace = $row["ancplace"];
                                        $salary = $row["salary"];
                                        $osm = $row["osm"];

                                        $address = $row["paddress"];
                                        $dob = $row["pdob"];
                                        $tel = $row["ptel"];
                                        $address = $row["paddress"];
                                        echo '<tr>
                                        <td> &nbsp;' .
                                            substr($hoscode, 0, 35)
                                            . '</td>
                                        <td>
                                        ' . substr($hosname, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($amp_code, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($amp_name, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($name, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($cid, 0, 12) . '
                                        </td>

                                        <td>
                                        ' . substr($age, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($gravida, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($lmp, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($edc, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($weight, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($height, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($bmi, 0, 4) . '
                                        </td>
                                        <td>
                                        ' . substr($ancno, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($ancplace, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . substr($salary, 0, 12) . '
                                        </td>
                                        <td>
                                        ' . $osm . '
                                        </td>

                                        <td>
                                        ' . substr($tel, 0, 10) . '
                                        </td>
                                        <td>
                                        ' . substr($email, 0, 20) . '
                                         </td>
                                        <td>
                                        ' . substr($dob, 0, 10) . '
                                        </td>
                                        <td>
                                        ' . $address . '
                                        </td>

                                        <td>
                                        &nbsp;
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=edit&id=' . $pid . '&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id=' . $pid . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                         &nbsp;&nbsp;&nbsp;
                                        <a href="?action=drop&id=' . $pid . '&name=' . $name . '&email=' . $email . '" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="examination.php?id=' . $pid . '" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Add New Examination Now</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a data-url="monitoring.php?id='.$pid.'" class="non-style-link button_monitor"><button  class="btn-primary-soft btn button-icon btn-text"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Add New Monitoring Now</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
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
    if ($_GET) {

        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'drop') {
            $nameget = $_GET["name"];
            echo '
        <div id="popup1" class="overlay">
                <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="patient.php">&times;</a>
                    <div class="content">
                        You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                        
                    </div>
                    <div style="display: flex;justify-content: center;">
                    <a href="delete-patient.php?id=' . $id . '" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                    <a href="patient.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                    </div>
                </center>
        </div>
        </div>
        ';
        } elseif ($action == 'view') {
            $sqlmain = "select * from patient where pid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();

            $hoscode = $row["hoscode"];
            $hosname = $row["hosname"];
            $amp_code = $row["amp_code"];
            $amp_name = $row["amp_name"];

            $name = $row["pname"];
            $email = $row["pemail"];
            $cid = $row["pcid"];

            $age = $row["age"];
            $gravida = $row["gravida"];
            $lmp = $row["lmp"];
            $edc = $row["edc"];
            $weight = $row["weight"];
            $height = $row["height"];
            $bmi = $row["bmi"];
            $ancno = $row["ancno"];
            $ancplace = $row["ancplace"];
            $salary = $row["salary"];
            $osm = $row["osm"];


            $dob = $row["pdob"];
            $tele = $row["ptel"];
            $address = $row["paddress"];



            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
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
                                    <label for="name" class="form-label">Patient ID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $id . '<br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>  
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $email . '<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="cid" class="form-label">CID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $cid . '<br><br>
                                </td>
                            </tr>


                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="age" class="form-label">AGE: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $age . '<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="gravida" class="form-label">ครรภ์ที่(GRAVIDA): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $gravida . '<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="lmp" class="form-label">ประจำเดือนครั้งสุดท้าย(LMP): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $lmp . '<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="edc" class="form-label">กำหนดคลอด(EDC): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $edc . '<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="weight" class="form-label">น้ำหนักก่อนคลอด(WEIGHT): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $weight . '<br><br>
                                </td>
                            </tr>

                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="height" class="form-label">ส่วนสูง(HEIGHT): </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            ' . $height . '<br><br>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="bmi" class="form-label">BMI: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            ' . $bmi . '<br><br>
                            </td>
                        </tr>

                        <tr>
                            <td class="label-td" colspan="2">
                                <label for="ancno" class="form-label">อายุครรภ์ที่ฝากครรภ์ครั้งแรก(ANCNO): </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                            ' . $ancno . '<br><br>
                            </td>
                        </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="ancplace" class="form-label">สถานที่ฝากครรภ์(ANCPLACE): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $ancplace . '<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="salary" class="form-label">รายได้ต่อเดือน(SALARY): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $salary . '<br><br>
                                </td>
                            </tr>





                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">อสม.ผู้ติดตาม(OSM): </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $osm . '<br><br>
                            </td>
                            </tr>
                            <tr>


                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                ' . $tele . '<br><br>
                                </td>
                            </tr>

                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="address" class="form-label">Address: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            ' . $address . '<br><br>
                            </td>
                            </tr>

                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Date of Birth: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $dob . '<br><br>
                                </td>
                                
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <a href="patient.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        } elseif ($action == 'add') {
            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );
            if ($error_1 != '4') {
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                        <a class="close" href="patient.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New patient.</p><br><br>
                                </td>
                            </tr>

                                                    
                            <tr>
                                <form action="add-newpatient.php" method="POST" class="add-new-form">



                                <tr>
                                <td class="label-td" colspan="2">
                                    <label for="hoscode" class="form-label">รหัสหน่วยบริการ (hoscode): </label>
                                    
                                </td>
                                </tr>
    
                                <tr>
                                <td class="label-td" colspan="2">
                                    <select name="hoscode" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by hoscode asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $hoscode = $row00["hoscode"];
                    $hosname = $row00["hosname"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $hoscode . ">$hosname</option><br/>";
                };
                echo     '       </select><br>
                                                </td>
                                            </tr>
    
    
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="hosname" class="form-label">ชื่อหน่วยบริการ (hosname): </label>
                                                
                                            </td>
                                            </tr>
                
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <select name="hosname" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by hoscode asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $hoscode = $row00["hoscode"];
                    $hosname = $row00["hosname"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $hosname . ">$hosname</option><br/>";
                };
                echo     '       </select><br>
                                                            </td>
                                                        </tr>
                                
    
                                                        <tr>
                                                        <td class="label-td" colspan="2">
                                                            <label for="amp_code" class="form-label">รหัสอำเภอ (amp_code): </label>
                                                            
                                                        </td>
                                                        </tr>
                            
                                                        <tr>
                                                        <td class="label-td" colspan="2">
                                                            <select name="amp_code" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by amp_code asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $amp_code = $row00["amp_code"];
                    $amp_name = $row00["amp_name"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $amp_code . ">$amp_name</option><br/>";
                };
                echo     '       </select><br>
                                                                        </td>
                                                                    </tr>
                            
                            
                                                                    <tr>
                                                                    <td class="label-td" colspan="2">
                                                                        <label for="amp_name" class="form-label">ชื่ออำเภอ (amp_name): </label>
                                                                        
                                                                    </td>
                                                                    </tr>
                                        
                                                                    <tr>
                                                                    <td class="label-td" colspan="2">
                                                                        <select name="amp_name" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by amp_code asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $amp_code = $row00["amp_code"];
                    $amp_name = $row00["amp_name"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $amp_name . ">$amp_name</option><br/>";
                };
                echo     '       </select><br>
                                                                                    </td>
                                                                                </tr>   


                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Patient Name"><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address"><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="cid" class="form-label">Patient CID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="cid" class="input-text" placeholder="Patient CID Number"><br>
                                </td>
                            </tr>




                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="age" class="form-label"> AGE: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="age" class="input-text" placeholder="AGE"><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="gravida" class="form-label">ครรภ์ที่(GRAVIDA) </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="gravida" class="input-text" placeholder="GRAVIDA"><br>
                            </td>
                            </tr>                           
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="lmp" class="form-label">ประจำเดือนครั้งสุดท้าย(LMP): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="lmp" class="input-text" placeholder="LMP"><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="edc" class="form-label">กำหนดคลอด(EDC): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="date" name="edc" class="input-text" placeholder="EDC"><br>
                            </td>
                            </tr>                           
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="weight" class="form-label">น้ำหนักก่อนคลอด(WEIGHT): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="weight" class="input-text" placeholder="weight"><br>
                            </td>
                            </tr>                           
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="height" class="form-label">ส่วนสูง(HEIGHT): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="height" class="input-text" placeholder="height" ><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="bmi" class="form-label">Patient BMI: (ถ้าไม่กรอกระบบสามารถคำนวนหาค่าให้ได้)</label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="bmi" class="input-text" placeholder="BMI"><br>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="ancno" class="form-label">อายุครรภ์ที่ฝากครรภ์ครั้งแรก(ANCNO): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="ancno" class="input-text" placeholder="ANCNO" ><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="ancplace" class="form-label">สถานที่ฝากครรภ์(ANCPLACE): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="ancplace" class="input-text" placeholder="ANCPLACE" ><br>
                            </td>
                            </tr>                                                                                  
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="salary" class="form-label">รายได้ต่อเดือน(SALARY): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="salary" class="input-text" placeholder="SALARY" ><br>
                            </td>
                            </tr>  



                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="osm" class="form-label">จนท.ผู้ติดตาม(OSM): </label>
                                
                            </td>
                            </tr>

                            <tr>
                            <td class="label-td" colspan="2">
                                <select name="osm" id="" class="box" >';


                $list11 = $database->query("select  * from  doctor order by docname asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $docname = $row00["docname"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $docname . ">$docname</option><br/>";
                };
                echo     '       </select><br>
                            </td>
                        </tr>


                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" ><br>
                                </td>
                            </tr>



                            <td class="label-td" colspan="2">
                            <label for="addr" class="form-label">Patient Address: </label>
                        </td>
                            </tr>
                        <tr>
                        <td class="label-td" colspan="2">
                            <input type="text" name="addr" class="input-text" placeholder="Patient Address" ><br>
                        </td>
    

                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="dob" class="form-label">Date of Birth: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <input type="date" name="dob" class="input-text" placeholder="Date of Birth" ><br>
                            </td>
                        </tr>



                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Conform Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                </td>
                            </tr>
                            
                
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Add" class="login-btn btn-primary btn">
                                </td>
                
                            </tr>
                           
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
            };
        } elseif ($action == 'edit') {
            $sqlmain = "select * from patient where pid='$id'";
            $result = $database->query($sqlmain);
            $row = $result->fetch_assoc();


            $hoscode = $row["hoscode"];
            $hosname = $row["hosname"];
            $amp_code = $row["amp_code"];
            $amp_name = $row["amp_name"];


            $name = $row["pname"];
            $email = $row["pemail"];
            $cid = $row["pcid"];

            $age = $row["age"];
            $gravida = $row["gravida"];
            $lmp = $row["lmp"];
            $edc = $row["edc"];
            $weight = $row["weight"];
            $height = $row["height"];
            $bmi = $row["bmi"];
            $ancno = $row["ancno"];
            $ancplace = $row["ancplace"];
            $salary = $row["salary"];
            $osm = $row["osm"];

            $dob = $row["pdob"];
            $tele = $row["ptel"];
            $address = $row["paddress"];


            $error_1 = $_GET["error"];
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',

            );

            if ($error_1 != '4') {
                echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        
                            <a class="close" href="patient.php">&times;</a> 
                            <div style="display: flex;justify-content: center;">
                            <div class="abc">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                    <td class="label-td" colspan="2">' .
                    $errorlist[$error_1]
                    . '</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Patient Details.</p>
                                    Doctor ID : ' . $id . ' (Auto Generated)<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <form action="edit-patient.php" method="POST" class="add-new-form">
                                        <label for="Email" class="form-label">Email: </label>
                                        <input type="hidden" value="' . $id . '" name="id00">
                                        <input type="hidden" name="oldemail" value="' . $email . '" >
                                    </td>
                                </tr>




                                <tr>
                                <td class="label-td" colspan="2">
                                    <label for="hoscode" class="form-label">รหัสหน่วยบริการ (hoscode): </label>
                                    
                                </td>
                                </tr>
    
                                <tr>
                                <td class="label-td" colspan="2">
                                    <select name="hoscode" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by hoscode asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $hoscode = $row00["hoscode"];
                    $hosname = $row00["hosname"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $hoscode . ">$hosname</option><br/>";
                };
                echo     '       </select><br>
                                                </td>
                                            </tr>
    
    
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <label for="hosname" class="form-label">ชื่อหน่วยบริการ (hosname): </label>
                                                
                                            </td>
                                            </tr>
                
                                            <tr>
                                            <td class="label-td" colspan="2">
                                                <select name="hosname" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by hoscode asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $hoscode = $row00["hoscode"];
                    $hosname = $row00["hosname"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $hosname . ">$hosname</option><br/>";
                };
                echo     '       </select><br>
                                                            </td>
                                                        </tr>
                                
    
                                                        <tr>
                                                        <td class="label-td" colspan="2">
                                                            <label for="amp_code" class="form-label">รหัสอำเภอ (amp_code): </label>
                                                            
                                                        </td>
                                                        </tr>
                            
                                                        <tr>
                                                        <td class="label-td" colspan="2">
                                                            <select name="amp_code" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by amp_code asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $amp_code = $row00["amp_code"];
                    $amp_name = $row00["amp_name"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $amp_code . ">$amp_name</option><br/>";
                };
                echo     '       </select><br>
                                                                        </td>
                                                                    </tr>
                            
                            
                                                                    <tr>
                                                                    <td class="label-td" colspan="2">
                                                                        <label for="amp_name" class="form-label">ชื่ออำเภอ (amp_name): </label>
                                                                        
                                                                    </td>
                                                                    </tr>
                                        
                                                                    <tr>
                                                                    <td class="label-td" colspan="2">
                                                                        <select name="amp_name" id="" class="box" >';


                $list11 = $database->query("select  * from  chospital order by amp_code asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $amp_code = $row00["amp_code"];
                    $amp_name = $row00["amp_name"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $amp_name . ">$amp_name</option><br/>";
                };
                echo     '       </select><br>
                                                                                    </td>
                                                                                </tr>   




                                <tr>
                                    <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" value="' . $email . '" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td class="label-td" colspan="2">
                                        <label for="name" class="form-label">Name: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="name" class="input-text" placeholder="patient Name" value="' . $name . '" required><br>
                                    </td>
                                    
                                </tr>
                                
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="cid" class="form-label">CID: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="cid" class="input-text" placeholder="patient CID Number" value="' . $cid . '" required><br>
                                    </td>
                                </tr>




                                <tr>
                                <td class="label-td" colspan="2">
                                    <label for="age" class="form-label"> AGE: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="age" class="input-text" placeholder="AGE" value="' . $age . '" required><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="gravida" class="form-label">ครรภ์ที่(GRAVIDA) </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="gravida" class="input-text" placeholder="GRAVIDA" value="' . $gravida . '" required><br>
                            </td>
                            </tr>                           
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="lmp" class="form-label">ประจำเดือนครั้งสุดท้าย(LMP): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="lmp" class="input-text" placeholder="LMP" value="' . $lmp . '" required><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="edc" class="form-label">กำหนดคลอด(EDC): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="date" name="edc" class="input-text" placeholder="EDC" value="' . $edc . '" required><br>
                            </td>
                            </tr>                           
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="weight" class="form-label">น้ำหนักก่อนคลอด(WEIGHT): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="weight" class="input-text" placeholder="weight" value="' . $weight . '" required><br>
                            </td>
                            </tr>                           
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="height" class="form-label">ส่วนสูง(HEIGHT): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="height" class="input-text" placeholder="height" value="' . $height . '" required><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="bmi" class="form-label">Patient BMI (ถ้าไม่ใส่ระบบสามารถคำนวนให้ ): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="bmi" class="input-text" placeholder="BMI" rvalue="' . $bmi . '" ><br>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="ancno" class="form-label">อายุครรภ์ที่ฝากครรภ์ครั้งแรก(ANCNO): </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="ancno" class="input-text" placeholder="ANCNO" value="' . $ancno . '" required><br>
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="ancplace" class="form-label">สถานที่ฝากครรภ์(ANCPLACE): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="ancplace" class="input-text" placeholder="ANCPLACE" value="' . $ancplace . '" required><br>
                            </td>
                            </tr>                                                                                  
                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="salary" class="form-label">รายได้ต่อเดือน(SALARY): </label>
                            </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                                <input type="text" name="salary" class="input-text" placeholder="SALARY" value="' . $salary . '" required><br>
                            </td>
                            </tr>  

                            <tr>
                            <td class="label-td" colspan="2">
                                <label for="osm" class="form-label">จนท.ผู้ติดตาม(OSM): </label>
                                
                            </td>
                            </tr>

                            <tr>
                            <td class="label-td" colspan="2">
                                <select name="osm" id="" class="box" >';


                $list11 = $database->query("select  * from  doctor order by docname asc;");
                for ($y = 0; $y < $list11->num_rows; $y++) {
                    $row00 = $list11->fetch_assoc();
                    $docname = $row00["docname"];
                    //$id00=$row00["docid"];
                    echo "<option value=" . $docname . ">$docname</option><br/>";
                };




                echo     '       </select><br>
                            </td>
                        </tr>




                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="Tele" class="form-label">Telephone: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="' . $tele . '" required><br>
                                    </td>
                                </tr>


                                <tr>
                            <td class="label-td" colspan="2">
                                <label for="dob" class="form-label">Date of Birth: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td" colspan="2">
                                <input type="date" name="dob" class="input-text" placeholder="Date of Birth" value="' . $dob . '" required><br>
                            </td>
                        </tr>


                        <td class="label-td" colspan="2">
                        <label for="address" class="form-label">Patient Address: </label>
                    </td>
                        </tr>
                    <tr>
                    <td class="label-td" colspan="2">
                        <input type="text" name="address" class="input-text" placeholder="Patient Address" value="' . $address . '" required><br>
                        </td>
                    </td>


                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="password" class="form-label">Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="password" class="input-text" placeholder="Defind a Password" value="' . $password . '" required><br>
                                    </td>
                                </tr><tr>
                                    <td class="label-td" colspan="2">
                                        <label for="cpassword" class="form-label">Conform Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" value="' . $cpassword . '" required><br>
                                    </td>
                                </tr>
                                
                    
                                <tr>
                                    <td colspan="2">
                                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    
                                        <input type="submit" value="Save" class="login-btn btn-primary btn">
                                    </td>
                    
                                </tr>
                            
                                </form>
                                </tr>
                            </table>
                            </div>
                            </div>
                        </center>
                        <br><br>
                </div>
                </div>
                ';
            } else {
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br><br><br>
                        <h2>Edit Successfully!</h2>
                        <a class="close" href="patient.php">&times;</a>
                        <div class="content">
                            
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="patient.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                        </div>
                        <br><br>
                    </center>
            </div>
            </div>
            ';
            };
        };
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


