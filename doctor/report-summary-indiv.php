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


	<!--  -->



	<!--  -->

	<div class="dash-body">
		<table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
			<tr>
				<td width="13%">
					<a href="report-summary.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
							<font class="tn-in-text">Back</font>
						</button></a>
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


			</tr>


		</table>
		</center>
		</td>
		</tr>


		<!--  -->
		<?php
		include("../connection.php");
		$userrow = $database->query("select * from monitor1 where pemail='$useremail'");
		$userfetch = $userrow->fetch_assoc();
		// print_r($userfetch);
		$userid = $userfetch["pid"];
		$username = $userfetch["pname"];

		$id = $_GET["id"];
		$week = $_GET["week"];

		// print_r($id);
		// print_r($week);

		$sqlmain = "SELECT * FROM monitor1 where pid='$id'
	and week='$week'";
		$result = $database->query($sqlmain);
		$row = $result->fetch_assoc();

		// print_r($row);

		echo "<Table border=0>";

		echo "<tr><td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td></tr>";

		echo "<br><Table border='0'cellpadding='2' cellspacing='2'><Tr bgcolor='#skyblue'>
<Td width='55'align='center'>ลำดับที่ (์NO)</Td>
<Td width='55'align='center'>ลำดับที่คนไข้ (Patient ID)</Td>
<Td width='150'align='center'>รหัสหน่วยบริการ (hoscode)</Td>
<Td width='150'align='center'>ชื่อหน่วยบริการ (hosname)</Td>
<Td width='100'align='center'>รหัสอำเภอ (amp_code)</Td>
<Td width='100'align='center'>ชื่ออำเภอ (amp_name)</Td>
<Td width=100'align='center'>ชื่อ นามสกุล (Patient Name)</Td>
<Td width='100'align='center'>สัปดาห์ที่ประเมิน(Week)</Td>
<Td width='150'align='center'>ผลประเมินข้อ1.1</Td>
<Td width='150'align='center'>ผลประเมินข้อ1.2</Td>
<Td width='150'align='center'>ผลประเมินข้อ1.3</Td>
<Td width='150'align='center'>ผลประเมินข้อ1.4</Td>
<Td width='150'align='center'>ผลประเมินข้อ2.1</Td>
<Td width='150'align='center'>ผลประเมินข้อ2.2</Td>
<Td width='150'align='center'>ผลประเมินข้อ3</Td>
<Td width='150'align='center'>ผลประเมินข้อ4</Td>
<Td width='150'align='center'>ผลประเมินข้อ5</Td>
<Td width='150'align='center'>ผลประเมินข้อ6</Td>
<Td width='150'align='center'>ผลประเมินข้อ7</Td>
<Td width='150'align='center'>ผลประเมินข้อ8</Td>
<Td width='150'align='center'>ผลประเมินข้อ9</Td>
<Td width='150'align='center'>ผลประเมินข้อ310</Td>
<Td width='100'align='center'>สรุปผลประเมิน</Td>
<Td width='50' align='center'bgcolor ='#FF3300'>เเก้ไข</Td>
<Td width='50' align='center' bgcolor='#FF3300'>ลบ</Td></Td>";





		// $i=1;
		// while($i<=$num_rows)
		// while ($i <= mysqli_fetch_assoc($result))


			$pid = $row["pid"];
			$hoscode = $row["hoscode"];
			$hosname = $row["hosname"];
			$amp_code = $row["amp_code"];
			$amp_name = $row["amp_name"];
			$name = $row["pname"];
			$email = $row["pemail"];
			$week = $row["week"];
			$no1_1 = $row['no1_1'];
			$no1_2 = $row['no1_2'];
			$no1_3 = $row['no1_3'];
			$no1_4 = $row['no1_4'];
			$no2_1 = $row['no2_1'];
			$no2_2 = $row['no2_2'];
			$no3 = $row['no3'];
			$no4 = $row['no4'];
			$no5 = $row['no5'];
			$no6 = $row['no6'];
			$no7 = $row['no7'];
			$no8 = $row['no8'];
			$no9 = $row['no9'];
			$no10 = $row['no10'];
			$answer = $row["answer"];




			echo "<TR>
<td align='center' bgcolor='#CCFFFF'>$i</td>
<TD bgcolor='#CCFFFF'>$pid</TD>
<TD bgcolor='#CCFFFF'>$hoscode</TD>
<TD bgcolor='#CCFFFF'>$hosname</TD>
<TD bgcolor='#CCFFFF'>$amp_code</TD>
<TD bgcolor='#CCFFFF'>$amp_name</TD>
<TD bgcolor='#CCFFFF'>$name</TD>
<TD bgcolor='#CCFFFF'>$week</TD>
<TD bgcolor='#CCFFFF'>$no1_1</TD>
<TD bgcolor='#CCFFFF'>$no1_2</TD>
<TD bgcolor='#CCFFFF'>$no1_3</TD>
<TD bgcolor='#CCFFFF'>$no1_4</TD>
<TD bgcolor='#CCFFFF'>$no2_1</TD>
<TD bgcolor='#CCFFFF'>$no2_2</TD>
<TD bgcolor='#CCFFFF'>$no3</TD>
<TD bgcolor='#CCFFFF'>$no4</TD>
<TD bgcolor='#CCFFFF'>$no5</TD>
<TD bgcolor='#CCFFFF'>$no6</TD>
<TD bgcolor='#CCFFFF'>$no7</TD>
<TD bgcolor='#CCFFFF'>$no8</TD>
<TD bgcolor='#CCFFFF'>$no9</TD>
<TD bgcolor='#CCFFFF'>$no10</TD>
<TD bgcolor='#CCFFFF'>$answer</TD>

<TD align='center' bgcolor='#CCFFFF'>
<A id=\"edit\" Href=\"patient.php?action=edit&id=$pid\">แก้ไข</A></TD>
<TD align='center' bgcolor='#CCFFFF'>
<A id=\"delete\" Href=\"patient.php?action=drop&id=$pid&name=$name&email=$email\">ลบ</A></TD></TR>";

			// $i++;

		echo "</Table>";
		// mysqli_close();
		?>
		<label></label>
		</p>
		<hr>
		<p align="center">

	</div>
	</form>

	<script>
  function printPage() {
    window.print();
  }
</script>
	<!--  -->


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