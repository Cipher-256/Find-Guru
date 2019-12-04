<!DOCTYPE html>
<html>
	<head> 
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="styling.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<title>class timetable</title>

		<style type="text/css">
			table
			{
				table-layout: fixed;
				width: 100%;
			}
				
			td{
			  padding: 5px;
			  text-align: center;
			/*  text-align: left;*/
			  width:9%;
			}
			th
			{
				width: 9.5%;
			}
		</style>
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
			<p style="float: left; padding: 10px">Select a  <b>Class </b>to view its timetable.</p>
	</div>
		<br><br>
		<br><br>
	<div class="row">
		<div class="col"></div>
		<fieldset class="col" style="padding: 35px; ">
			<form method="POST">
			<input type="text" name="class" placeholder="enter class name" required><br><br>
			<!-- <input type="text" name="day" placeholder="enter day"><br><br> -->
			<label>select day </label>
			<select name='day'>
			<option value='monday'>monday</option>
			<option value='tuesday'>tuesday</option>
			<option value='wednesday'>wednesday</option>
			<option value='thursday'>thursday</option>
			<option value='friday'>friday</option>
			 <option value='saturday'>saturday</option>
			 <option value='all'>all</option>
			</select><br><br><br>
			<input type="submit" name="submit" value="submit">
			</form>
		</fieldset>
		<div class="col"></div>
	<?php 
	function nafun()
	{
		echo "<table><td>NA</td><td>NA</td><tr><td>NA</td><td>NA</td><td>NA</td><td>NA</td><td>NA</td><td>NA</td></tr></table>";
	}
	function display($mydb,$sname)
		{
			$servername="localhost";
			$username="root";
			$pw="";

			$con=new mysqli($servername,$username,$pw,$mydb);
			$sql= "SELECT * from sec_period where sname='$sname'";
			$res=$con->query($sql);
			if($res->num_rows==0)
			{
				echo "<script>alert('enter a valid section name')</script>";
				nafun();
				die("");
			}
			$row=$res->fetch_assoc();
			echo "<table border=1>";
			echo "<tr>";
			echo "<td>".$mydb."</td>";
			for($i=1;$i<=8;$i++)
			{
				
				if($i==5)
					echo "<td> "."lunch"."</td>";
				else
				{
					$subject=$row['p'.$i];
					$mydb="phpprojects";
					$conn=new mysqli($servername,$username,$pw,$mydb);
					$sql="SELECT sid  from sub_table where sname='$subject'";
					$result=$conn->query($sql);
					$row1=$result->fetch_assoc();
					$sid=$row1['sid'];
					$sql="SELECT tid,rid from sub_teach_sec_room where sid='$sid' and sname='$sname'";
					$result=$conn->query($sql);
					$row1=$result->fetch_assoc();
					$tid=$row1['tid'];
					$rid=$row1['rid'];
					$sql="SELECT name from teacher_table where tid='$tid' ";
					$result=$conn->query($sql);
					$row1=$result->fetch_assoc();
					$tname=$row1['name'];
					echo "<td>[<b>" .strtoupper($subject) ."</b>]<br>".strtoupper($tname)."<br><b>".strtoupper($rid)."<b></td>";
				}

				
			}
			echo "</tr><br>";
			echo "</table>";


		}
		if(isset($_POST['submit']))
		{
			$mydb=$day=$_POST['day'];
			$sname=$_POST['class'];
			echo "<table border=1>";
			echo "<th>day</th><th>9:30-10:30</th><th>10:30-11:20</th><th>11:20-12:10</th><th>12:10-1:00</th><th>1:00-1:50</th><th>1:50-2:40</th><th>2:40-3:30</th><th>3:30-4:30</th>";
				if($day!="all")
					display($mydb,$sname);
				else
				{ 
					
					display("monday",$sname);
					display("tuesday",$sname);
					display("wednesday",$sname);
					display("thursday",$sname);
					display("friday",$sname);
					display("saturday",$sname);


				}
				echo "</table>";
		}
	?>
	</body>
</html>
