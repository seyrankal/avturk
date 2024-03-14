
<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM students_add  ORDER BY id DESC");
?>

<html>
<head>
    
	<title>Add Student</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<a href="index.php">Home</a>  | <a href="add_student_index.php">Add Student</a> | <a href="logout.php">Logout</a>
	<br/><br/>

	<form action="add_student_post.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>Student Name</td>
				<td><input type="text" name="studentName"></td>
			</tr>
			<tr> 
				<td>Student Surname</td>
				<td><input type="text" name="studentSurname"></td>
			</tr>
			<tr> 
				<td>Student Number</td>
				<td><input type="text" name="studentNumber"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>

    <br/><br/>
	
	<table width='80%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>Student Name</td>
			<td>Surname</td>
			<td>Student Number</td>
			<td>Update</td>
		</tr>
		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr>";
			echo "<td>".$res['student_name']."</td>";
			echo "<td>".$res['student_surname']."</td>";
			echo "<td>".$res['student_number']."</td>";	
			echo "<td><a id=\"editStudent_$res[id]\" class=\"btn btn-primary editStudent\" >Edit</a> | <a id=\"showLesson_$res[id]\" class=\"btn btn-info showLessons\" >Show Your Lessons</a> | <a class=\"btn btn-danger \" href=\"deleteStudent.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a> </td>";		
		}

		?>
	</table>

        <!-- Button trigger modal -->
    <button type="button"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOgrenci" style="display:none;">
    Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="editOgrenci" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editOgrenciLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form id="editStudentForm" name="editStudentForm" method="post" action="student_edit.php">
                    <table border="0">
                        <tr> 
                            <td>Student Name</td>
                            <td><input type="text" id="studentNameEdit" name="studentNameEdit" value=""></td>
                        </tr>
                        <tr> 
                            <td>Student Surname</td>
                            <td><input type="text" id="studentSurnameEdit" name="studentSurnameEdit" value=""></td>
                        </tr>
                        <tr> 
                            <td>Student Number</td>
                            <td><input type="text" id="studentNumberEdit" name="studentNumberEdit" value=""></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" id="idsecret" name="idsecret" value=""></td>
                            <td><input type="submit" name="update" value="Update"></td>
                        </tr>
                    </table>
                </form>
                <form id="getStudentForm" action="getStudenValue" name="getStudenValue" method="post">
                    <td><input type="hidden" id="getStudent" name="getStudent" value=""></td>
                </form>

                <form action="show_your_lessons_index.php" method="post" name="show_your_lessons">
                        <tr> 
                            <td><input type="hidden" id="hidden_show_lessons_id" name="hidden_show_lessons_id" value=""></td>
                            <td><input type="submit" id="submit_show_your_lessons" name="Submit" value="Add"></td>
                        </tr>

                </form>
                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="updateStudentButton" type="button" class="btn btn-primary">Update</button>
        </div>
        </div>
    </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    $(".editStudent").click(function(){
            $('#editOgrenci').modal('show');
            var idValue = this.id.split('_')[1];
            $("#idsecret").val(idValue);
            $("#getStudent").val(idValue);
            var frm2 = $('#getStudentForm');
            $.ajax({
            url: "student_edit_get.php",
            type: "post",
            data: frm2.serialize(),
            success: function (response) {
                var responseParse = JSON.parse(response);
                console.log(responseParse.success);
                if(responseParse.success =='true'){
                    $("#studentNameEdit").val(responseParse.name);
                    $("#studentSurnameEdit").val(responseParse.surname);
                    $("#studentNumberEdit").val(responseParse.number);    
                    
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
    });
   
    $("#updateStudentButton").click(function(){
            var frm = $('#editStudentForm');
        $.ajax({
            url: "student_edit.php",
            type: "post",
            data: frm.serialize() ,
            success: function (response) {
                var responseParse = JSON.parse(response);
                if(responseParse.success =='true'){
                    $('#editOgrenci').modal('toggle');
                   /*  location.reload(); */
                    toastr.success("Successfully updated.");
                }
            // You will get response from your PHP page (what you echo or print)
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
    });

    $(".showLessons").click(function(){
        var idButton = this.id.split('_')[1];
        $("#hidden_show_lessons_id").val(idButton);
        $( "#submit_show_your_lessons" ).trigger( "click" );
    });

    </script>
</body>
</html>