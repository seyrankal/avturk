<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include("connection.php");

//getting id of the data from url
$id = $_POST['getStudent'];

//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM students_grade WHERE id=$id");
$response = array();
/* print_r($result);
die(); */
if(isset($result) && $result == 1 ){
    $response['res'] = "true";
}else{
    $response['res'] = "false";
}

    exit(json_encode($response));

//redirecting to the display page (view.php in our case)
/* header("Location:show_your_lessons_index.php"); */
?>

