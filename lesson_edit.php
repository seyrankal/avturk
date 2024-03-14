<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
// including the database connection file
include_once("connection.php");

if(isset($_POST['numberEdit']) && isset($_POST['courseNameEdit']) && isset($_POST['semesterEdit']) && isset($_POST['gradeNumberEdit']) )
{	
	$id = $_POST['idsecret'];
	
	$courseNameEdit = $_POST['courseNameEdit'];
	$semesterEdit = $_POST['semesterEdit'];	
    $gradeNumberEdit = $_POST['gradeNumberEdit'];	

	// checking empty fields
	if(empty($courseNameEdit) || empty($semesterEdit) || empty($gradeNumberEdit)) {
				
		if(empty($courseNameEdit)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($semesterEdit)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}
		
		if(empty($gradeNumberEdit)) {
			echo "<font color='red'>Price field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE students_grade SET course_name='$courseNameEdit', semester='$semesterEdit', grade='$gradeNumberEdit' WHERE id=$id");
		
        $response = array();
        $response['success'] = "true";
        exit(json_encode($response));

		//redirectig to the display page. In our case, it is view.php
		/* header("Location: view.php"); */
	}
}
?>
<?php
//getting id from url
/* $id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$qty = $res['qty'];
	$price = $res['price'];
} */
?>