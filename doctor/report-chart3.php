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
	include("../connection.php");
	$userrow = $database->query("select * from patient where pemail='$useremail'");
	$userfetch = $userrow->fetch_assoc();
	// print_r($userfetch);
	$userid = $userfetch["pid"];
	$username = $userfetch["pname"];


	// echo $userid;
	// echo $username;



	date_default_timezone_set('Asia/Bangkok');

	$today = date('Y-m-d');

	// $week = $_POST['week'];


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
				<tr class="menu-row">
					<td class="menu-btn menu-icon-home ">
						<a href="index.php" class="non-style-link-menu ">
							<div>
								<p class="menu-text">Home</p>
						</a>
		</div></a>
		</td>
		</tr>
		<tr class="menu-row">
			<td class="menu-btn menu-icon-dashbord">
				<a href="index.php" class="non-style-link-menu">
					<div>
						<p class="menu-text">Dashboard</p>
				</a>
	</div></a>
	</td>
	</tr>
	<tr class="menu-row">
		<td class="menu-btn menu-icon-doctor menu-active menu-icon-doctor-active">
			<a href="doctors.php" class="non-style-link-menu non-style-link-menu-active">
				<div>
					<p class="menu-text">Doctors</p>
			</a></div>
		</td>
	</tr>
	<tr class="menu-row">
		<td class="menu-btn menu-icon-schedule">
			<a href="schedule.php" class="non-style-link-menu">
				<div>
					<p class="menu-text">Schedule</p>
				</div>
			</a>
		</td>
	</tr>
	<tr class="menu-row">
		<td class="menu-btn menu-icon-appoinment">
			<a href="appointment.php" class="non-style-link-menu">
				<div>
					<p class="menu-text">Appointment</p>
			</a></div>
		</td>
	</tr>
	<tr class="menu-row">
		<td class="menu-btn menu-icon-patient">
			<a href="patient.php" class="non-style-link-menu">
				<div>
					<p class="menu-text">Patients</p>
			</a></div>
		</td>
	</tr>
	<tr class="menu-row">
		<td class="menu-btn menu-icon-home">
			<a href="exam.php" class="non-style-link-menu">
				<div>
					<p class="menu-text">Exam</p>
			</a></div>
		</td>
	</tr>
	<tr class="menu-row">
		<td class="menu-btn menu-icon-doctor">
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
		<td class="menu-btn menu-icon-settings  menu-active menu-icon-settings-active">
			<a href="settings.php" class="non-style-link-menu non-style-link-menu-active">
				<div>
					<p class="menu-text">Settings</p>
			</a></div>
		</td>
	</tr>

	</table>
	</div>

	<div class="dash-body">
		<table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
			<tr>
				<td width="13%">
					<a href="report.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
							<font class="tn-in-text">Back</font>
						</button></a>
				</td>
				<td>
					<form action="monitor.php" method="post" class="header-search">

						<input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors">&nbsp;&nbsp;

						<?php
						echo '<datalist id="doctors">';
						$list11 = $database->query("select DISTINCT * from  doctor;");
						$list12 = $database->query("select DISTINCT * from  schedule GROUP BY title;");

						for ($y = 0; $y < $list11->num_rows; $y++) {
							$row00 = $list11->fetch_assoc();
							$d = $row00["docname"];

							echo "<option value='$d'><br/>";
						};


						for ($y = 0; $y < $list12->num_rows; $y++) {
							$row00 = $list12->fetch_assoc();
							$d = $row00["title"];

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

						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						
						<tbody>
							<?php

include("../connection.php");
$result = $database->query("select answer
,SUM(CASE WHEN no1_1=1 THEN 1 ELSE 0 END) as no1_1
,SUM(CASE WHEN no1_2=1 THEN 1 ELSE 0 END) as no1_2
,SUM(CASE WHEN no1_3=1 THEN 1 ELSE 0 END) as no1_3
,SUM(CASE WHEN no1_4=1 THEN 1 ELSE 0 END) as no1_4
,SUM(CASE WHEN no2_1=1 THEN 1 ELSE 0 END) as no2_1
,SUM(CASE WHEN no2_2=1 THEN 1 ELSE 0 END) as no2_2
,SUM(CASE WHEN no3=1 THEN 1 ELSE 0 END) as no3
,SUM(CASE WHEN no4=1 THEN 1 ELSE 0 END) as no4
,SUM(CASE WHEN no5=1 THEN 1 ELSE 0 END) as no5
,SUM(CASE WHEN no6=1 THEN 1 ELSE 0 END) as no6
,SUM(CASE WHEN no7=1 THEN 1 ELSE 0 END) as no7
,SUM(CASE WHEN no8=1 THEN 1 ELSE 0 END) as no8
,SUM(CASE WHEN no9=1 THEN 1 ELSE 0 END) as no9
,SUM(CASE WHEN no10=1 THEN 1 ELSE 0 END) as no10
from monitor1 
where answer = 'abnormal_hospital'
GROUP BY answer");
//$result = $result->fetch_assoc();


while($datas = mysqli_fetch_array($result)) {
	//$rows[] = $r;

	$ab_rows[] = $datas['abnormal_hospital'];
	$ab_rows[] = $datas['no1_1'];
	$ab_rows[] = $datas['no1_2'];
	$ab_rows[] = $datas['no1_3'];
	$ab_rows[] = $datas['no1_4'];
	$ab_rows[] = $datas['no2_1'];
	$ab_rows[] = $datas['no2_2'];
	$ab_rows[] = $datas['no3'];
	$ab_rows[] = $datas['no4'];
	$ab_rows[] = $datas['no5'];
	$ab_rows[] = $datas['no6'];
	$ab_rows[] = $datas['no7'];
	$ab_rows[] = $datas['no8'];
	$ab_rows[] = $datas['no9'];
	$ab_rows[] = $datas['no10'];

}
//echo json_encode($rows);

//print_r($ab_rows);


								$dataPoints = array(
									array("label" => "ข้อ 1.1 BMi < 18.5 เพิ่ม 0.5 kg ต่อสัปดาห์", "y" => "$ab_rows[1]"),
									array("label" => "ข้อ 1.2 BMi < 18.5 - 24.9 เพิ่ม 0.4 kg ต่อสัปดาห์", "y" => "$ab_rows[2]"),
									array("label" => "ข้อ 1.3 BMi 25.0 - 29.9 เพิ่ม 0.3 kg ต่อสัปดาห์", "y" => "$ab_rows[3]"),
									array("label" => "ข้อ 1.4 BMi >= 30 เพิ่ม 0.2 kg ต่อสัปดาห์", "y" => "$ab_rows[4]"),
									array("label" => "ข้อ 2.1 ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึกหดหู่ เศร้า ท้อแท้ สิ้นหวัง", "y" => "$ab_rows[5]"),
									array("label" => "ข้อ 2.2 ใน 2 สัปดาห์ที่ผ่านมารวมวันนี้ ท่านรู้สึกเบื่อ ทำอะไรก็ไม่เพลิดเพลิน", "y" => "$ab_rows[6]"),
									array("label" => "ข้อ 3 ท้องปั่นแข็ง หรือปวดบั้นเอว ร้าวไปที่ขา หรือท้องปั้นโดยไม่ปวดท้อง", "y" => "$ab_rows[7]"),
									array("label" => "ข้อ 4 มีไข้", "y" => "$ab_rows[8]"),
									array("label" => "ข้อ 5 ปัสสาวะอักเสบขัด", "y" => "$ab_rows[9]"),
									array("label" => "ข้อ 6 ตกขาว คันช่องคลอด", "y" => "$ab_rows[10]"),
									array("label" => "ข้อ 7 น้ำเดิน *มีน้ำใสๆออกทางช่องคลอด*", "y" => "$ab_rows[11]"),
									array("label" => "ข้อ 8 มีเลือดออกทางช่องคลอด", "y" => "$ab_rows[12]"),
									array("label" => "ข้อ 9 เจ็บครรภ์ หรือท้องปั้นทุก 15 นาที ลูกดื้นน้อยลง", "y" => "$ab_rows[13]"),
									array("label" => "ข้อ 10 ลูกดิ้นน้อยกว่า 3 ครั้งต่อชั่วโมง *นับหลังมื้ออาหาร*", "y" => "$ab_rows[14]"),
									// array("label" => "$rows_answer[0]", "y" => "$rows_sum_result[0]"),
									// array("label" => "$rows_answer[1]", "y" => "$rows_sum_result[1]"),
									// array("label" => "$rows_answer[2]", "y" => "$rows_sum_result[2]"),

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
						text: "รายงานความผิดปกติแยกตามด้านต่างๆ ใน รพ (Chart3)"
					},
					subtitles: [{
						text: "% ความผิดปกติในระบบ"
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

</html>