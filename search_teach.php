<!DOCTYPE html>
<html>
	<head> 
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="styling.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<title>search teacher</title>
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

			<form method="POST" action="" >
				<input type="text" name="day" placeholder="enter the day"><br><br>
				<input type="text" name="tname" placeholder="enter teacher name"><br><br>
				<input type="text" name="pnumber" placeholder="enter period number"><br><br>
				<input type="submit" name="search" value="search">
			</form>
		</fieldset>
		<div class="col"></div>
	</div>
		<?php

			$servername="localhost";
			$username="root";
			$pw="";
			$mydb="phpprojects";
			$con=new mysqli($servername,$username,$pw,$mydb);
			$flag="not found in any class";
			//echo "helllooooo";

			if(isset($_POST['search']))
			{
				
				$teachername=$_POST['tname'];
				//echo $teachername;
				$sql = "SELECT tid from teacher_table where name='$teachername'";
				//	echo "hellloooo";
				$res=$con->query($sql);
				
				if($res->num_rows==0)
					echo "enter the correct details "."<br><br>";
				else
				{
					$row=$res->fetch_assoc();
					$tid=$row['tid'];
					// echo $tid;
						//foreach($row as $key=> $value)
							//echo $tid."<br>";
							// $tid=$value;
							//echo $tid
				}

				$pn=$_POST['pnumber'];
				$sql="SELECT sid,sname,rid from sub_teach_sec_room where tid='$tid'";
				$res=$con->query($sql);

				while($row=$res->fetch_assoc())
				{
					$subid=$row['sid'];
					$rid=$row['rid'];
					// echo "<br><br>".$subid;
					$sec=$row['sname'];
					// echo "<br><br>".$sec;
					$mydb=$_POST['day'];
					// echo "<br><br>".$mydb;
					$con1=  new mysqli($servername,$username,$pw,$mydb);
					$sql = "SELECT * from sec_period where sname='$sec'";
					$res1=$con1->query($sql);
					$row1=$res1->fetch_assoc();
					$var='p'."$pn";
					// echo "<br><br>".$var;
					$sub=$row1[$var];
					// echo "<br><br>".$sub;
					$mydb="phpprojects";
					$con=  new mysqli($servername,$username,$pw,$mydb);
					$sql="SELECT sid from sub_table where sname='$sub'";
					$result=$con->query($sql);
					$r=$result->fetch_assoc();
					$subid1=$r['sid'];
					// echo "<br><br>".$subid;
					if($subid==$subid1)
						$flag="found in section ".$sec.$rid;

			}
			echo $flag;
			}	
		?>
	</body>
</html>