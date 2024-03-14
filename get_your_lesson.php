<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");


if(isset($_POST['getStudent']) )
{	
	$id = $_POST['getStudent'];
	
    $result = mysqli_query($mysqli, "SELECT * FROM students_grade WHERE id=$id");
    
    $response = array();
    $response['success'] = "true";
   
    while($res = mysqli_fetch_array($result))
    {
        $response['courseName'] = $res['course_name'];
        $response['semester'] = $res['semester'];
        $response['grade'] = $res['grade'];
    } 
    
    exit(json_encode($response));
   
/* 	$studentNameEdit = $_POST['studentNameEdit'];
	$studentSurnameEdit = $_POST['studentSurnameEdit'];
	$studentNumberEdit = $_POST['studentNumberEdit'];	 */

	
	// checking empty fields
	/* if(empty($studentNameEdit) || empty($studentSurnameEdit) || empty($studentNumberEdit)) {
				
		if(empty($studentNameEdit)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($studentSurnameEdit)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}
		
		if(empty($studentNumberEdit)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE students_add SET student_name='$studentNameEdit', student_surname='$studentSurnameEdit', student_number='$studentNumberEdit' WHERE id=$id");
		
        $response = array();
        $response['success'] = "true";
        exit(json_encode($response));
	} */
}
?>