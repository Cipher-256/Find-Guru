<!DOCTYPE html>
<html>
<head>
	<title>excel page</title>
</head>
<body>
	<div >
			<br><br><br>
			<a href="timetable.php" ><b>update class timetable</b></a><br><br><br>
			<a href="register_teacher.php"><b> register teacher</b></a><br><br><br>
			<a href="sub_teach.php"><b>update subject and teacher</b></a><br><br><br>
			<a href="sub_teach_sec.php"><b>update subject ,teacher and section </b></a><br><br><br>
			
			<a href="class_timetable.php"><b>display class time table</b></a><br><br><br>
			<a href="search_teach.php"><b>Search teacher</b></a><br><br><br>
			<a href="timetable_teacher.php"><b>display teacher timetable </b></a><br><br><br>
		</div>
<form action="" method="POST" enctype="multipart/form-data">
	<input type="text" name="sec" placeholder="enter section name" align="center" required>
	<br><br>
	<input type="file" name="file" align="center" accept=".xlsx,.xls">
	<input type="submit" name="submit" value="submit" align="center">
	</form>	
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
	// echo "<script> alert('file is not selected')</script>";
	// die("");
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
	
</body>
<!-- exception handling edited ,input required field--> 
</html>
