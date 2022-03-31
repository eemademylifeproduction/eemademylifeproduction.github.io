<?php 

session_start();

	include("db.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			//read from database
			$query = "select * from signup where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="style.css">
	<title>Login</title>
</head>
<body>
<header>

<a href="index.html"><img  src="images/logo1.png" alt="" class="logo"></a>

<div id="menu" class="fas fa-bars"></div>

<nav class="navbar">
	<a href="index.html">Home</a>
	<a href="About.html">About Us</a>
	<a href="#footer">Contact Us</a>
	<div class="dropdown">
		<a href="" class="dropbtn">Categories</a>
		<div class="dropdown-content">
		  <a href="#">Ebooks</a>
		  <a href="#">Videos</a>
		</div>
	</div>
	<a href="login.php">Login</a>
	<a href="signup.php">Register</a>
</nav>

</header>
	<style type="text/css">
	
	#text{

		height: 35px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: green;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
		margin-top: 100px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 30px;margin: 10px;color: white;">Login</div>
			<label class="form-label">User name</label>
			<input id="text" type="text" name="user_name"><br><br>
			
			<label class="form-label">User name</label>
			<input id="text" type="password" name="password"><br><br>
			
			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
	<script src="index.js"></script>
</body>
</html>