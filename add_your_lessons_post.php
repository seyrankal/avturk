<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

if(isset($_POST['number']) && isset($_POST['courseName']) && isset($_POST['semester']) && isset($_POST['gradeNumber']) ) {	
	$number = $_POST['number'];
	$courseName = $_POST['courseName'];
    $semester = $_POST['semester'];
	$gradeNumber = $_POST['gradeNumber'];
		
	// checking empty fields
	if(empty($number) || empty($courseName) || empty($semester) || empty($gradeNumber)) {
		if(empty($number)) {
			echo "<font color='red'>Student Number field is empty.</font><br/>";
		}
		
		if(empty($courseName)) {
			echo "<font color='red'>Course Name field is empty.</font><br/>";
		}
		
		if(empty($semester)) {
			echo "<font color='red'>Semester field is empty.</font><br/>";
		}

        if(empty($gradeNumber)) {
			echo "<font color='red'>Grade field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO students_grade(student_id, course_name, semester,grade ) VALUES('$number','$courseName','$semester','$gradeNumber')");
		//display success message

        $response = array();
        /* print_r($result);
        die(); */
        if(isset($result) && $result ==1){
            $response['res'] = "true";
        }else{
            $response['res'] = "false";
        }
        exit(json_encode($response));

        /* $base_url="http://".$_SERVER['SERVER_NAME']."/complete-php-crud-master/show_your_lessons_index.php";
        header("Location:".$base_url); */
		
	}
}
?>

