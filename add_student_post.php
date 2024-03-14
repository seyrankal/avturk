<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

if(isset($_POST['Submit'])) {	
	$studentName = $_POST['studentName'];
	$studentSurname = $_POST['studentSurname'];
	$studentNumber = $_POST['studentNumber'];
	$loginId = $_SESSION['id'];
		
	// checking empty fields
	if(empty($studentName) || empty($studentSurname) || empty($studentNumber)) {
				
		if(empty($studentName)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($studentSurname)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}
		
		if(empty($studentNumber)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO students_add(student_name, student_surname, student_number) VALUES('$studentName','$studentSurname','$studentNumber')");
		
		//display success message
		
        $base_url="http://".$_SERVER['SERVER_NAME']."/complete-php-crud-master/add_student_index.php";
        header("Location:".$base_url);
		
	}
}
?>

