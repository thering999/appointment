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
$result = $database->query("select answer,COUNT(*) sum_result from monitor1 GROUP BY answer;");
//$result = $result->fetch_assoc();


while($r = mysqli_fetch_assoc($result)) {
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
								array("label" => "$rows_answer[2]", "y" => "$rows_sum_result[2]"),

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
						text: "รายงานภาพรวมความปกติ/ผิดปกติในระบบ (Chart1)"
					},
					subtitles: [{
						text: "*คำนิยาม abnormal_nhso=แนะนำให้ไป รพสต.ไกล้บ้านเพื่อรับการประเมินซ้ำ / abnormal_hospital=แนะนำให้ไป รพ. ทันที/normal=ผลปกติ"
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