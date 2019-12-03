<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="styling.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>class's teachers</title>
</head>
<body>
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
			<a class="btn btn-primary" href="class_timetable.php"><b>Display Class Time Table</b></a><br><br><br>
			<a class="btn btn-primary" href="search_teach.php"><b>Search teacher</b></a><br><br><br>
			<a class="btn btn-primary" href="timetable_teacher.php"><b>Display teacher timetable </b></a><br><br><br>
		</div>
	</div>
	<div style="text-align: center;padding-top: 20px;">
			<b style="font-size: 20px;">Enter The Require Details to Proceed....!</b>
			<br>
			<b style="float: left;padding: 10px;padding-left: 50px;">Note:</b>
			<p style="float: left; padding: 10px">Here you can assign a teacher for a class for a perticular subject.</p>
	</div>
		<br><br>
		<br><br>
	<div class="row">
		<div class="col"></div>
		<fieldset class="col" style="padding: 35px; ">
			<form method="POST" enctype="multipart/form-data">
				<input type="file" name="file" style="border:1px solid black;width: 220px;"><br><br>
				<input type="submit" name ="submit" value="submit">
			</form>
		</fieldset>
		<div class="col"></div>
	</div>

	<?php 
		set_time_limit(0);
		$severname="localhost";
		$username="root";
		$pw="";
		$mydb="phpprojects";
		$con = new  mysqli($severname,$username,$pw,$mydb);
		if($con->connect_error)
			die("connection failed"); 
		require 'Classes/PHPExcel/IOFactory.php';
		if(isset($_POST['submit']))
		{
			//$section=$_POST['sec'];
			$inputfilename=$_FILES['file']['tmp_name'];
			// $exceldata=array();


			try
			{
				$inputfiletype=PHPExcel_IOFactory::identify($inputfilename);
				// echo $inputfiletype;
				$objReader=PHPExcel_IOFactory::createReader($inputfiletype);
				// echo $objReader;
				$objPHPExcel=$objReader->load($inputfilename);
			}


			catch(Exception $e)
			{
				die('error loading file "'.pathinfo($inputfilename,PATHINFO_BASENAME).'":'.$e->getMessage());

			}


			$sheet =$objPHPExcel->getSheet(0);
			//echo $sheet;
			$highestRow=$sheet->getHighestRow();
			//echo $highestRow."<br>";
			$highestColumn=$sheet->getHighestColumn();
			//echo ord($highestColumn)-65;
			//echo $highestColumn."  ".$highestRow;
			for($row=2;$row<=$highestRow;$row++)
			{
				$rowData=$sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
				
					$sname=$rowData[0][0];//subject name
					$tname=$rowData[0][1];//teacher name
					$section=$rowData[0][2];//section
					$rid=$rowData[0][3];//room number
					// echo $sname.$tname.$section.$rid."<br>";
					$sql="SELECT sid from sub_table where sname='$sname'";
					$res=$con->query($sql);
					$row1=$res->fetch_assoc();
					$sid=$row1['sid'];
				
					$sql="SELECT tid from teacher_table where name='$tname'";
					$res=$con->query($sql);
					$row1=$res->fetch_assoc();
					$tid=$row1['tid'];
				
					$sql="INSERT into sub_teach_sec_room values('$sid','$tid','$section','$rid')";
					// $con->query($sql);
					if($con->query($sql))
					{
						echo "values inserted";
					}
					else
					{
						echo "error insertion";
					}
			}			
		}		
		$con->close()

	?>
</div>
</body>
</html>
