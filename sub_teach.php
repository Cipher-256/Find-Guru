<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="styling.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>subject teacher</title>
</head>
<body style="background-color: lightgray;">
<div class="container" style="height: 653px;background-color: white;padding: 0px;">	
	<header class="headpart">
		Find Guru
		<!-- <b id="head">WELCOME TO CLASSROOM MANAGEMENT SYSTEM LOGIN PAGE!</b> -->
	</header>

	<div class="sideBar " >
		<div class="btn-group-vertical menu">
			<a class="btn btn-primary" href="timetable.php" ><b>Update Class Timetable</b></a><br><br><br>
			<a class="btn btn-primary" href="register_teacher.php"><b> Register Teacher</b></a><br><br><br>
			<a class="btn btn-primary" href="sub_teach.php"><b>Update Subject and Teacher</b></a><br><br><br>
			<a class="btn btn-primary" href="sub_teach_sec.php"><b>Update Subject,Teacher,Section </b></a>
			<!-- <br><br><br> -->
			<a class="btn btn-primary" href="class_timetable.php"><b>Display Class Time Table</b></a><br><br><br>
			<a class="btn btn-primary" href="search_teach.php"><b>Search teacher</b></a><br><br><br>
			<a class="btn btn-primary" href="timetable_teacher.php"><b>Display teacher timetable </b></a><br><br><br>
		</div>
	
	</div>
	<div style="text-align: center;padding-top: 20px;">
			<b style="font-size: 20px;">Enter The Require Details to Proceed....!</b>
			<br>
			<b style="float: left;padding: 10px;padding-left: 50px;">Note:</b>
			<p style="float: left; padding: 10px">Here you can assign  single or multiple<b> subjects</b> to Teachers.</p>
	</div>
		<br><br>
		<br><br>

	<div class="row">
		<div class="col"></div>
		<fieldset class="col" style="padding: 35px; ">
			<form method="POST" class="col">
			<input type="text" name="subject" placeholder="enter subject name" required>
			<br><br>
			<input type="text" name="teacher" placeholder="enter teacher name" required><br><br>
			<input type="submit" name="submit" value="submit">
			</form>
		</fieldset>
		<div class="col"></div>
	</div>
	<?php 
		$servername="localhost";
		$username="root";
		$password="";
		$mydb="phpprojects";
		$conn= new mysqli($servername,$username,$password,$mydb);
		if(isset($_POST['submit']))
		{
			$sname=$_POST['subject'];
			$tname=$_POST['teacher'];
			$sql ="SELECT sid from sub_table where sname='$sname'";
			$res=$conn->query($sql);
			$row=$res->fetch_assoc();
			$sid=$row['sid'];
			//echo $sid;
			$sql ="SELECT tid from teacher_table where name='$tname'";
			$res=$conn->query($sql);
			$row=$res->fetch_assoc();
			$tid=$row['tid'];
			//echo $tid;
			$sql="INSERT into sub_teacher values('$sid','$tid')";
			if($conn->query($sql))
			{
				echo "values inserted";
			}
			else
			{
				echo "<p align='center'><strong >enter the correct values</strong></p>";
			}
		}
	?>
</div>
</body>
</html>