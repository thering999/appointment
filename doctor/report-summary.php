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

	use Psy\Readline\Hoa\Console;

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
	// include("../connection.php");
	// $userrow = $database->query("select * from patient where pemail='$useremail'");
	// $userfetch = $userrow->fetch_assoc();
	// // print_r($userfetch);
	// $userid = $userfetch["pid"];
	// $username = $userfetch["pname"];


    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];


	date_default_timezone_set('Asia/Bangkok');

	$today = date('Y-m-d');

	// $week = $_POST['week'];
	// print_r($_POST);
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
								<td width="30%" style="padding-left:20px">
									<img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
								</td>
								<td style="padding:0px;margin:0px;">
									<p class="profile-title"><?php echo $username ?></p>
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
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">My Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">My Patients</p></a></div>
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


	<tr class="menu-row">
		<td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
			<a href="settings.php" class="non-style-link-menu non-style-link-menu-active">
				<div>
					<p class="menu-text">Settings</p>
			</a></div>
		</td>
	</tr>

	</table>
	</div>


	<!--  -->

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

			// select patient.*,exam1.week,exam1.exam_result from patient
			// left JOIN exam1 on patient.pcid = exam1.pcid
			// 				GROUP BY patient.pcid 
			// $sqlmain = "select patient.*,monitor1.week from patient
			// left JOIN monitor1 on patient.pcid = monitor1.pcid";
			$sqlmain = "select patient.*,monitor1.* from patient,monitor1
			where patient.pid=$userid;";
			$selecttype = "All";
			$current = "All patients";
		} else {
			// $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
			
			$sqlmain = "select *
			from appointment 
			inner join patient on patient.pid=appointment.pid 
			left JOIN monitor1 on patient.pcid = monitor1.pcid
			inner join schedule on schedule.scheduleid=appointment.scheduleid 
			where schedule.docid=$userid;";
			
			$selecttype = "My";
			$current = "My patients Only";
		}
	}
} else {
	//$sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
	// $sqlmain = "select *
	// from appointment 
	// inner join patient on patient.pid=appointment.pid 
	// left JOIN monitor1 on patient.pcid = monitor1.pcid
	// inner join schedule on schedule.scheduleid=appointment.scheduleid 
	// where schedule.docid=$userid;";
	$sqlmain = "select patient.*,monitor1.* from patient,monitor1
	where patient.pid=$userid;";
	$selecttype = "My";
}



	?>

	<!--  -->

	<div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">

                    <a href="report.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
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
<button type="submit" id="print" onclick="printPage()" class="btn btn-primary">พิมพ์ข้อมูล</button>
</td>


<!-- </tr>	


            <tr></tr>
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
</tr> -->


<!--  -->
<?php
	include("../connection.php");
	$userrow = $database->query("select * from monitor1 where pemail='$useremail'");
	$userfetch = $userrow->fetch_assoc();
	// print_r($userfetch);
	$userid = $userfetch["pid"];
	$username = $userfetch["pname"];




echo"</br></br><h3>รายงานสรุปภาพรวมรายสัปดาห์</h3><Hr>";
echo"<Table border=0>";
?>


	<!-- <form action="report-summary-indiv.php" method="post" name="form1">
		<b>กรุณาเลือกสัปดาห์ที่ประเมินอายุที่ตั้งครรภ์ :</b>
		<?
			$sqlmain2="SELECT * FROM monitor1";
			$result= $database->query($sqlmain2);
			$row=$result->fetch_assoc();
		?>	
			
		<select name="week" class="btn btn-success">
			<option value="">-- เลือกสัปดาหฺ์ที่ต้องการดู --</option>
    		<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
			<option value="<?=$row["week"];?>">Week <?=$row["week"];?></option>
		
			<input name="btnSubmit" type="submit" value="ยืนยัน"lass="login-btn btn-primary btn"> -->

	
<?




// <Td width='150'align='center'>รหัสหน่วยบริการ (hoscode)</Td>
// <Td width='150'align='center'>ชื่อหน่วยบริการ (hosname)</Td>
// <Td width='100'align='center'>รหัสอำเภอ (amp_code)</Td>
// <Td width='100'align='center'>ชื่ออำเภอ (amp_name)</Td>

echo "<tr><td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td></tr>";

echo"<br><Table border='0'cellpadding='2' cellspacing='2'><Tr bgcolor='#skyblue'>
<Td width='55'align='center'>ลำดับที่ (์NO)</Td>
<Td width='55'align='center'>ลำดับที่คนไข้ (Patient ID)</Td>

<Td width=100'align='center'>ชื่อ นามสกุล (Patient Name)</Td>
<Td width='100'align='center'>Week 12</Td>
<Td width='150'align='center'>Week 24</Td>
<Td width='150'align='center'>Week 25</Td>
<Td width='150'align='center'>Week 26</Td>
<Td width='150'align='center'>Week 27</Td>
<Td width='150'align='center'>Week 28</Td>
<Td width='150'align='center'>Week 29</Td>
<Td width='150'align='center'>Week 30</Td>
<Td width='150'align='center'>Week 31</Td>
<Td width='150'align='center'>Week 32</Td>
<Td width='150'align='center'>Week 33</Td>
<Td width='150'align='center'>Week 34</Td>
<Td width='150'align='center'>Week 35</Td>
<Td width='150'align='center'>Week 36</Td>
<Td width='150'align='center'>Week 37</Td>
<Td width='150'align='center'>Week 38</Td>
<Td width='100'align='center'>Week ประเมินล่าสุด</Td>
<Td width='100'align='center'>สรุปผลประเมิน</Td>
<Td width='50' align='center'bgcolor ='#FF3300'>เเก้ไข</Td>
<Td width='50' align='center' bgcolor='#FF3300'>ลบ</Td></Td>";

// $num_rows = mysqli_num_rows($sqlmain);
// $num_fields = mysqli_num_fields($sqlmain);


    //import database
    include("../connection.php");
    $userrow = $database->query("select * from doctor where docemail='$useremail'");
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["docid"];
    $username = $userfetch["docname"];

	$sqlmain = "
	select monitor1.* 
	, SUM(IF(monitor1.week in(12),1,0)) week12
	, SUM(IF(monitor1.week in(24),1,0)) week24
	, SUM(IF(monitor1.week in(25),1,0)) week25
	, SUM(IF(monitor1.week in(26),1,0)) week26
	, SUM(IF(monitor1.week in(27),1,0)) week27
	, SUM(IF(monitor1.week in(28),1,0)) week28
	, SUM(IF(monitor1.week in(29),1,0)) week29
	, SUM(IF(monitor1.week in(30),1,0)) week30
	, SUM(IF(monitor1.week in(31),1,0)) week31
	, SUM(IF(monitor1.week in(32),1,0)) week32
	, SUM(IF(monitor1.week in(33),1,0)) week33
	, SUM(IF(monitor1.week in(34),1,0)) week34
	, SUM(IF(monitor1.week in(35),1,0)) week35
	, SUM(IF(monitor1.week in(36),1,0)) week36
	, SUM(IF(monitor1.week in(37),1,0)) week37
	, SUM(IF(monitor1.week in(38),1,0)) week38
		
		from monitor1
	where monitor1.pid is not null
		GROUP BY monitor1.pid
;";

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
for ( $x=0; $x<$result->num_rows;$x++)
{
	$row=$result->fetch_assoc();

	$pid=$row["pid"];
	// $hoscode=$row["hoscode"];
	// $hosname=$row["hosname"];
	// $amp_code=$row["amp_code"];
	// $amp_name=$row["amp_name"];
	$name=$row["pname"];
	// $email=$row["pemail"];

	$week12=$row['week12'];
	$week24=$row['week24'];
	$week25=$row['week25'];
	$week26=$row['week26'];
	$week27=$row['week27'];
	$week28=$row['week28'];
	$week29=$row['week29'];
	$week30=$row['week30'];
	$week31=$row['week31'];
	$week32=$row['week32'];
	$week33=$row['week33'];
	$week34=$row['week34'];
	$week35=$row['week35'];
	$week36=$row['week36'];
	$week37=$row['week37'];
	$week38=$row['week38'];

	$week=$row["week"];
	$answer=$row["answer"];


// <TD bgcolor='#CCFFFF'>$hoscode</TD>
// <TD bgcolor='#CCFFFF'>$hosname</TD>
// <TD bgcolor='#CCFFFF'>$amp_code</TD>
// <TD bgcolor='#CCFFFF'>$amp_name</TD>

echo "<tr>
<td align='center' bgcolor='#CCFFFF'>$x</td>
<TD bgcolor='#CCFFFF'>$pid</TD>

<TD bgcolor='#CCFFFF'>$name</TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week12</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week24</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week25</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week26</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week27</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week28</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week29</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week30</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week31</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week32</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week33</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week34</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week35</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week36</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week37</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A Href=\"report-summary-indiv.php?id=$pid&week=$week\">$week38</A></TD>


<TD align='center' bgcolor='#CCFFFF'>
<A id=\"edit\" Href=\"monitor.php?action=view&id=$pid\">$week</A></TD>


<TD align='center' bgcolor='#CCFFFF'>
<A id=\"edit\" Href=\"risk.php?id=$pid\">$answer</A></TD>

<TD align='center' bgcolor='#CCFFFF'>
<A id=\"edit\" Href=\"patient.php?action=edit&id=$pid\">แก้ไข</A></TD>
<TD align='center' bgcolor='#CCFFFF'>
<A id=\"delete\" Href=\"patient.php?action=drop&id=$pid&name=$name&email=$email\">ลบ</A></TD></tr>";


}
echo"</Table>";
}
// <TD bgcolor='#CCFFFF'>$week12</TD>
// <TD bgcolor='#CCFFFF'>$week</TD>
// <TD bgcolor='#CCFFFF'>$answer</TD>

// mysqli_close();
?>
      <label></label>
    </p><hr>
    <p align="center">

  </div>
</form>

<script>
  function printPage() {
    window.print();
  }
</script>
<!--  -->

</body>
</html>





















		
						<!-- <tbody>
							<?php

							include("../connection.php");
							$result = $database->query("select answer,COUNT(*) as sum_result from monitor1 
where answer != 'normal'
GROUP BY answer;");
							//$result = $result->fetch_assoc();


							while ($r = mysqli_fetch_assoc($result)) {
								//$rows[] = $r;

								$rows_answer[] = $r['answer'];
								$rows_sum_result[] = $r['sum_result'];
							}
							//echo json_encode($rows);

							// print_r($rows_answer);
							// print_r('<br>');
							// print_r($rows_sum_result);


							$dataPoints = array(
								array("label" => "$rows_answer[0]", "y" => "$rows_sum_result[0]"),
								array("label" => "$rows_answer[1]", "y" => "$rows_sum_result[1]"),

								// array("label" => "($rows[answer])", "y" => "($rows[sum_result])"),
								// array("label" => "($rows[answer])", "y" => "($rows[sum_result])"),

								// array("label" => "{$answer}", "y" => "{$sum_result}"),
								// array("label" => "{$answer}", "y" => "{$sum_result}"),
							);

							?>

						</tbody>

		</table>


		<script>
			window.onload = function() {

				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					exportEnabled: true,
					title: {
						text: "รายงานภาพแยกรายหน่วยบริการ (Chart4)"
					},
					subtitles: [{
						text: "*คำนิยาม abnormal_nhso=แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ / abnormal_hospital=แนะนำให้ไป รพ. ทันที"
					}],
					data: [{
						type: "pie",
						showInLegend: "true",
						legendText: "{label}",
						indexLabelFontSize: 16,
						indexLabel: "{label} - #percent%",
						yValueFormatString: "จำนวน(คน) #,##0",
						dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
					}]
				});
				chart.render();

			}
		</script>




		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
		<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</div>

</html> -->