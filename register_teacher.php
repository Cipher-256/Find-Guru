<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="styling.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>register teacher</title>
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
			<p style="float: left; padding: 10px">Here you can register the new <b>Teachers</b> in the college.</p>
	</div>
		<br><br>
		<br><br>
	<div class="row">
		<div class="col"></div>
		<fieldset class="col" style="padding: 35px; ">
			<form method="POST">
			<input type="text" name="tid" placeholder="id" required>
			<br><br><input type="text" name="uname" placeholder="username" required><br><br>
			<input type="text" name="password" placeholder="password"   required><br><br>
			<input type="submit" name="submit" value="submit">
			</form>
		</fieldset>
		<div class="col"></div>
	</div>

		<?php 
			$servername="localhost";
			$username="root";
			$pw="";
			$mydb="phpprojects";
			$con = new mysqli($servername,$username,$pw,$mydb);
			if($con->connect_error)
			{
				die("connection failed");
			}
			else
			{
				if(isset($_POST['submit']))
				{
					$id=$_POST['tid'];
					$uname=$_POST['uname'];
					$pw=$_POST['password'];
					$sql="INSERT into teacher_table values('$id','$uname','$pw')";
					if($con->query($sql))
					{
						echo "teacher registered";
					}
					else
					{
						echo "<center><p style='float:center'><img src='oops.png' style='height:15px; width:20px; margin-bottom:3px;padding-right:5px; align:top'>";
						echo "<b >Error in insertion  :( </b></p></center>";
					}

				}
			}
		?>
</div>

</body>
</html>