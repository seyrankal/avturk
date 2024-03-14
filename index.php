<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="header">
		Welcome to my page!
	</div>
	<?php
	if(isset($_SESSION['valid'])) {			
		include("connection.php");					
		$result = mysqli_query($mysqli, "SELECT * FROM login");
		$base_url="http://".$_SERVER['SERVER_NAME']."/complete-php-crud-master/add_student_index.php";
        header("Location:".$base_url);
	?>
				
		Welcome <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Logout</a><br/>
		<br/>
		
		<a href='add_student_index.php'>View and Add Products</a>
		<br/><br/>
	<?php	
	} else {
		echo "You must be logged in to view this page.<br/><br/>";
		echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
	}
	?>
	<div id="footer">
		
	</div>
</body>
</html>
