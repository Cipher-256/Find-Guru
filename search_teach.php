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
			<p style="float: left; padding: 10px">Search  <b>Teacher</b></p>
	</div>
		<br><br>
		<br><br>
	<div class="row">
		<div class="col"></div>
		<fieldset class="col" style="padding: 35px; ">

			<form method="POST" action="" >
				<!-- <input type="text" name="day" placeholder="enter the day"><br><br> -->
			<label>select day </label>
			<select name='day'>
			<option value='monday'>monday</option>
			<option value='tuesday'>tuesday</option>
			<option value='wednesday'>wednesday</option>
			<option value='thursday'>thursday</option>
			<option value='friday'>friday</option>
			<option value='saturday'>saturday</option>
			</select><br><br><br>
				<input type="text" name="tname" placeholder="enter teacher name" required><br><br>
				<label> select the period number</label>
				<select name="pnumber">
					<option value=1>9:30AM-10:30AM <b>(P1)</b></option>
					<option value=2>10:30AM-11:20AM <b>(P2)</b></option>
					<option value=3>11:20AM-12:10PM <b>(P3)</b></option>
					<option value=4>12:10PM-1:00PM <b>(P4)</b></option>
					<option value=5>1:00PM-1:50PM <b>(P5)</b></option>
					<option value=6>1:50PM-2:40PM <b>(P6)</b></option>
					<option value=7>2:40PM-3:30PM <b>(P7)</b></option>
					<option value=8>3:30PM-4:30PM <b>(P8)</b></option>
				</select>
				<!-- <input type="text" name="pnumber" placeholder="enter period number"><br><br> -->
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
			
			//echo "helllooooo";

			if(isset($_POST['search']))
			{
				
				$teachername=$_POST['tname'];
				//echo $teachername;
				$sql = "SELECT * from teacher_table where name like '%$teachername%'";
				//	echo "hellloooo";
				$resx=$con->query($sql);
				
				if($resx->num_rows==0)
				{
					echo "<p align='center'><strong >enter the correct values</strong></p>";
					die("");
				}

				while($rowx=$resx->fetch_assoc())
				{
					 $flag="not found in any class";
					// print_r($rowx);

					$tid=$rowx['tid'];
					$tname=$rowx['name'];
						

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
							$flag=$tname."  found in section "."<b>".$sec."</b><b> ".$rid." </b><br><br>";

					}			
				
			echo $tname." ".strtoupper($flag)."<br><br>";
				}
			}	
		?>
	</body>
</html>