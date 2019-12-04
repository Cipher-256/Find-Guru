<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>excel page</title>
	<link rel="stylesheet" type="text/css" href="styling.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body style="background-color: lightgray;">
<div class="container" style="height: 653px;background-color: white;padding: 0px;">	
	<header class="headpart">
		Find Guru
		<!-- <b id="head">WELCOME TO CLASSROOM MANAGEMENT SYSTEM LOGIN PAGE!</b> -->
	</header>
	<div>
	<div class="sideBar" >
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
			<p style="float: left; padding: 10px">Here you can upload the timetable excel sheet of a perticular class.</p>
		</div>
		<br><br>
		<br><br>
		<div class="row">
			<div class="col"></div>
			<fieldset class="col" style="padding: 35px; ">
				<form action="" method="POST" enctype="multipart/form-data" style="text-align: center;">
					<input class="form-control" type="text" name="sec" placeholder="enter section name" align="center">
					<br>
					<div class="custom-file mb-3">
  				    <input type="file" class="custom-file-input" id="customFile" name="file" onchange="updatevalue()">
 				    <label class="custom-file-label" id="elem"for="customFile"
 				    style="text-align: left;">Choose file</label>
   					 </div>
					<!-- <input class="form-control"type="file" name="file" align="left" style="border:1px solid black;width: 220px;"> -->
					<br>
					<input class="btn btn-secondary"type="submit" name="submit" value="submit" align="left">
				</form>	
			</fieldset>
			<div class="col"></div>
		<div>
	</div>
</div>
	<?php 
		require 'Classes/PHPExcel/IOFactory.php';

		$servername="localhost";
		$username="root";
		$password="";
		$mydb="phpprojects";
		// $inputfilename="";

		$conn= new mysqli($servername,$username,$password,$mydb);

		if($conn->connect_error)
			die("connection failed");
		
		if(isset($_POST['submit']))
		{
			$section=$_POST['sec'];
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
			for($row=1;$row<=$highestRow;$row++)
			{
				$rowData=$sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
				if($rowData[0][0]!="day")
				{
					$db= $rowData[0][0];
					$conn=new mysqli($servername,$username,$password,$db);
					if($conn->connect_error)
					{
						die("error connecting");
					}
					else
					{
						$data1=$section;
						$data2=$rowData[0][1];
						$data3=$rowData[0][2];
						$data2=$rowData[0][1];
						$data4=$rowData[0][3];
						$data5=$rowData[0][4];
						$data6=$rowData[0][5];
						$data7=$rowData[0][6];
						$data8=$rowData[0][7];
						$data9=$rowData[0][8];

						$sql="INSERT INTO sec_period VALUES('$data1','$data2','$data3','$data4','$data5','$data6','$data7','$data8','$data9')";
						if($conn->query($sql))
						{
							//$exceldata[]=$rowData[0];
						}
						else
						{
							echo "error".$sql."<br>".mysqli_error($conn);
						}
					}
				}
			}
		}		
	?>
<script>	
// Add the following code if you want the name of the file appear on select
var element= document.getElementById("elem");
var filenamE = document.getElementById("customFile");
function updatevalue(){
	var filename=filenamE.value.split("\\").pop();
	element.innerHTML=filename;
}
</script>

	
</body>
</html>
