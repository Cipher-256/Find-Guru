<?php session_start() ?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<title>Find Guru</title>
	<style type="text/css">
		
		div.menu
		{
			display: inline-block;
			 width: auto;
			min-height: 200px;
		}
	</style>
	</head>
	
	<body>
	<form method="POST">		         
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
		<input type="submit" name="search" value="search"><br><br> 
		<a href="logout.php">logout</a>
	</form>

	<?php 

		function daytb($servername,$username,$pw,$day)
		{
				echo "<div class='menu'><table border=1>";
				$tid=$_SESSION['tid'];
				$arr=array();
		 	
		 		echo "<th>".$day."</th>";
				$mydb="phpprojects";
				$con=new mysqli($servername,$username,$pw,$mydb);
				$conn=new mysqli($servername,$username,$pw,$day);
				$sql="SELECT sid,sname,rid from sub_teach_sec_room where tid='$tid'";
				$res=$con->query($sql);
				while($row=$res->fetch_assoc())
				{

					$sid=$row['sid'];
					$rid=$row['rid'];
					$secname=$row['sname'];
					$sql1="SELECT sname from sub_table where sid='$sid'";
					$res1=$con->query($sql1);
					$row1=$res1->fetch_assoc();
					$subname=$row1['sname'];
					//echo $subname."<br><br>";
					
					$sql2="SELECT * from sec_period where sname='$secname'";
					$result=$conn->query($sql2);
					$row2=$result->fetch_assoc();
					for($i=1;$i<=8;$i++)
					{				
						if(strtoupper($row2['p'.$i])==strtoupper($subname))
						{
							$arr['p'.$i]=array(strtoupper($subname),$secname);
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
		if(isset($_SESSION['tid']))
		{
			if(isset($_POST['search']))
			{	
					$day=$_POST['day'];
					// echo "<table border=1>";
					if($day!="all")
						daytb($servername,$username,$pw,$day);
					else
					{ 
						
						daytb($servername,$username,$pw,"monday");
						daytb($servername,$username,$pw,"tuesday");
						daytb($servername,$username,$pw,"wednesday");
						daytb($servername,$username,$pw,"thursday");
						daytb($servername,$username,$pw,"friday");
						daytb($servername,$username,$pw,"saturday");

					}
					// echo "</table>";		
			}
		}
		else
		{
			echo "session has expired";

		}

	?>
	</body>
</html>
