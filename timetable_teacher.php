<!DOCTYPE html>
<html> 
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="styling.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<title></title>
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
			<form action="" method="POST">
		<input type="text" name="tname" placeholder="enter  teacher name"><br><br>
		<input type="text" name="day" placeholder="enter the day"><br><br>
		<input type="submit" name="search" value ="search"><br><br>	
			</form>
		</fieldset>
		<div class="col"></div>
	</div>
	<?php

		function daytb($servername,$username,$pw,$day,$tname)
		{

				$arr=array();
		 		// echo "<tr>";
		 		echo "<div class='menu'><table border=1>";
		 		echo "<th>".$day."</th>";
				$mydb="phpprojects";

				$con=new mysqli($servername,$username,$pw,$mydb);
				$conn=new mysqli($servername,$username,$pw,$day);

				$sql="SELECT tid from teacher_table where name='$tname' ";
				$res=$con->query($sql);
				$row=$res->fetch_assoc();
				
				$tid=$row['tid'];
				// echo $tid."<br><br>";
				$sql="SELECT sid,sname,rid from sub_teach_sec_room where tid='$tid'";
				$res=$con->query($sql);
				// echo "<table border=2><tr>";
				
				while($row=$res->fetch_assoc())
				{

					$sid=$row['sid'];
					// echo $sid."<br><br>";
					$secname=$row['sname'];
					$rid=$row['rid'];
					//echo $secname;
					// echo $secname."<br><br>";
					$sql1="SELECT sname from sub_table where sid='$sid'";
					$res1=$con->query($sql1);
					$row1=$res1->fetch_assoc();
					$subname=$row1['sname'];
					//echo $subname."<br><br>";
					
					$sql2="SELECT * from sec_period where sname='$secname'";
					$result=$conn->query($sql2);
					$row2=$result->fetch_assoc();
					//echo $row2['sname'];
					//$x=3;
					//echo $row2['p'.$x];
					for($i=1;$i<=8;$i++)
					{
						
						if(strtoupper($row2['p'.$i])==strtoupper($subname))
						{
							//echo $row2['p'.$i]."<br><br>";
						//	echo "<td>".$day;
							$arr['p'.$i]=array(strtoupper($subname),$secname);
							//echo "<td>". "p".$i."     ".$secname."   ".$subname."	".$rid."</td>";
						}
					}
					
				}
				if(!empty($arr))
				{	ksort($arr);
					foreach($arr as $k=>$v)
					{				echo "<tr><td>".$k."	";
						foreach($v as $v1)
						echo $v1."	";
					echo "</td>";
					} 
				}
				
				echo "</tr></table></div>";
		}
		$servername="localhost";
		$username="root";
		$pw="";
		$mydb="phpprojects";
		// $con=new mysqli($servername,$username,$pw,$mydb);
		// if($con->connect_error)
		// {
		// 	die("connection failed");
		// }
		// else
		// {	
			if(isset($_POST['search']))
			{
				// echo "";
				$tname=$_POST['tname'];
				
				$day=$_POST['day'];
				
				if($day!=NULL)
					daytb($servername,$username,$pw,$day,$tname);
				else
				{ 
					daytb($servername,$username,$pw,"monday",$tname);
					daytb($servername,$username,$pw,"tuesday",$tname);
					daytb($servername,$username,$pw,"wednesday",$tname);
					daytb($servername,$username,$pw,"thursday",$tname);
					daytb($servername,$username,$pw,"friday",$tname);
					daytb($servername,$username,$pw,"saturday",$tname);
				}
			// echo "</table>";		
			}
	?>
</div>
	</body>
</html>