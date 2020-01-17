<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>login form</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<style type="text/css">
			#WELCOME{
				float: center;
				text-align: center;
				margin: 1%;

			}
		</style>
	</head>

	<body style="background-color: lightgray;">
		<div class="container" style="height: 653px;background-color: white;padding: 0px;">
		
			<header style=" width:100;height:50px;background-color:#000033;">
				<div class="mx-auto" style="text-align: center;">
					<b style=" font-size: 35px;padding-top: 5px;color:#000033; ">
					<!-- Find Guru -->.
					</b>
				</div>
				<center><img class="snist" src="index.jpg"   ></center>
			</header>

			<div class="pag_">
				<form style="text-align: center; " method="post" >
					<div class="row">
					<div class="col"></div>
					<fieldset class="col"style="width:40%;">
						<legend style=""><b>Login Details</b></legend>
						<b>Username:</b><input class="inputo" type="text" name="userid"  placeholder="Enter the User_Id"  required><br><br>	
						<b>Password :</b><input class="inputo" type="password" name="password" placeholder="Enter the Password" required><br><br>
						<!-- <input type="submit" name="login" value="login"> -->
						<input type="radio" name="loginas" value="teacher"><b>Teacher</b>
						<input type="radio" name="loginas" value="admin"><b>Admin</b>
						<br><br>
						<input class="btn btn-secondary" type="submit" name="login" value="Login" style="height: 25px;width: 80px; padding-top: 0px;">
					</fieldset>
					<div class="col"></div>
					</div>
				</form>
			</div>

			<?php 
				$servername="localhost";
				$username="root";
				$password="";
				$mydb="phpprojects";

				$con= new mysqli($servername,$username,$password,$mydb);
				
				if($con->connect_error)
				{
					die("connection unsuccessful");
					echo "<script>alert('Connection Unsuccessful....!<br>Refresh The Page');</script>";
				}

				//else	echo "connection established"."<br>"."<br>";

				if(isset($_POST['login']) )
				{
					if(!empty($_POST['loginas']))
					{
						$uvar=$_POST['userid'];
						$pvar=$_POST['password'];
						
						if($_POST['loginas']=='teacher')
						{
							$_SESSION['tid']=$uvar;

							$sql="SELECT * FROM teacher_table WHERE tid= '$uvar' and password='$pvar'";
							
							$res=$con->query($sql);	
							
							if($res->num_rows>0)
							{
								echo "successfull login";
							header('location:teacher_display.php');
							}
							else
							{
								echo "<center><p style='float:center'><img src='oops.png' style='height:15px; width:20px; margin-bottom:3px;padding-right:5px; align:top'>";
								echo "<b >Check your username and password</b></p></center>";
							}

						}
						//echo "hiiii";
						else if($_POST['loginas']=='admin')
						{
							
							$sql="SELECT * FROM admin_table WHERE aid= '$uvar' and password='$pvar'";
							$res=$con->query($sql);	
							
							if($res->num_rows>0)
							{
								echo "successfull login";
								header('location:timetable.php');
							}
							
							else
							{
								echo "<center><p style='float:center'><img src='oops.png' style='height:15px; width:20px; margin-bottom:3px;padding-right:5px; align:top'>";
								echo "<b >OOPS!check your username and password</b></p></center>";
								echo "<script>alert('Username or Password did not match..!');</script>";
							}
						}
					}
					else{
						
							echo "<center><p style='float:center'><img src='oops.png' style='height:15px; width:20px; margin-bottom:3px;padding-right:5px; align:top'>";
							echo "<b >Fill All Requred Fields  :( </b></p></center>";
							echo "<script>alert('Please Fill All The Requred Fields...!');</script>";
					}
				}
			?>
			<div id="WELCOME">
				<b >WELCOME TO CLASSROOM MANAGEMENT SYSTEM LOGIN PAGE!</b><br><b>Enter Required Details to Proceed....</b>
			</div>
		</div>
	</body>
</html>
