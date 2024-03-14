
<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");
        $id=0;
        if(isset($_POST['Submit']) )
        {	
            $id = $_POST['hidden_show_lessons_id'];
        }           

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM students_grade WHERE student_id='$id'  ORDER BY id DESC");
$avarage = mysqli_query($mysqli, "SELECT AVG(grade) as grade FROM students_grade WHERE student_id='$id'");
$avarageVal=0;
while($av = mysqli_fetch_array($avarage)) {		
    $avarageVal =   $av[0];		
}

?>

<html>
<head>
    
	<title>Add Student</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            <a href="index.php">Home</a>  | <a href="add_student_index.php">Add Student</a> | <a href="logout.php">Logout</a>
                <br/><br/>
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <form id="formShowYourLesson" action="add_your_lessons_post.php" method="post" name="formShowYourLesson">
                            <table width="25%" border="0">
                                <!-- <tr> 
                                    <td>Student Number</td> -->
                                    <td><input type="hidden" id ="number" name="number" value="<?php echo($id) ?>"></td> 
                                <!-- </tr> -->
                                <tr> 
                                    <td>Course Name</td>
                                    <td><input type="text" name="courseName"></td>
                                </tr>
                                <tr> 
                                    <td>Semester</td>
                                    <td><input type="text" name="semester"></td>
                                </tr>
                                <tr> 
                                    <td>Grade</td>
                                    <td><input type="text" name="gradeNumber"></td>
                                </tr>
                                <tr> 
                                    <td></td>
                                    <td><button type="button" class="addLesson btn btn-primary">Add Button</button></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    <span class="badge bg-success">Grade Point Average: <?php echo($avarageVal)  ?> </span>
                    </div>

                </div>
                

                <br/><br/>
                
                <table width='80%' border=0>
                        <tr bgcolor='#CCCCCC'>
                            <td>Student Number</td>
                            <td>Course Name</td>
                            <td>Semester</td>
                            <td>Grade</td>
                        </tr>
                    <?php
                    while($res = mysqli_fetch_array($result)) {		
                        echo "<tr>";
                        echo "<td>".$res['student_id']."</td>";
                        echo "<td>".$res['course_name']."</td>";
                        echo "<td>".$res['semester']."</td>";
                        echo "<td>".$res['grade']."</td>";	
                        echo "<td><a id=\"editLesson_$res[id]\" class=\"btn btn-primary editLesson\" >Edit</a> | <a id=\"deleteLesson_$res[id]\" class=\"btn btn-danger deleteLesson\" >Delete</a> </td>";		
                    }
                    ?>
                </table>

                <br/><br/>
            </div>
        </div>
    </div>
    
	
	
	

        <!-- Button trigger modal -->
    <button type="button"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editLesson" style="display:none;">
    Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="editLesson" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editLessonLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form id="editLessonForm" name="editLessonForm" method="post" action="student_edit.php">
                    <table border="0">
                       <!--  <tr> 
                            <td></td> -->
                            <td><input type="hidden" id ="numberEdit" name="numberEdit" value="<?php echo($id) ?>"></td> 
                        <!-- </tr> -->
                        <tr> 
                            <td>Course Name</td>
                            <td><input type="text" id="courseNameEdit" name="courseNameEdit" value=""></td>
                        </tr>
                        <tr> 
                            <td>Semester</td>
                            <td><input type="text" id="semesterEdit" name="semesterEdit" value=""></td>
                        </tr>
                        <tr> 
                            <td>Grade</td>
                            <td><input type="text" id="gradeNumberEdit" name="gradeNumberEdit" value=""></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" id="idsecret" name="idsecret" value=""></td>
                        </tr>
                    </table>
                </form>
                <form id="getLessonForm" action="getStudenValue" name="getStudenValue" method="post">
                    <td><input type="hidden" id="getStudent" name="getStudent" value=""></td>
                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="updateLessonButton" type="button" class="btn btn-primary">Update</button>
        </div>
        </div>
    </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">

$( document ).ready(function() {
   
    $(".editLesson").click(function(){
            $('#editLesson').modal('show');
            var idValue = this.id.split('_')[1];
            $("#idsecret").val(idValue);
            $("#getStudent").val(idValue);
            var frm2 = $('#getLessonForm');
            $.ajax({
            url: "get_your_lesson.php",
            type: "post",
            data: frm2.serialize(),
            success: function (response) {
                var responseParse = JSON.parse(response);
                console.log(responseParse.success);
                if(responseParse.success =='true'){
                    $("#courseNameEdit").val(responseParse.courseName);
                    $("#semesterEdit").val(responseParse.semester);
                    $("#gradeNumberEdit").val(responseParse.grade);    
                    
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
    });
   
    $("#updateLessonButton").click(function(){
            var frm = $('#editLessonForm');
        $.ajax({
            url: "lesson_edit.php",
            type: "post",
            data: frm.serialize() ,
            success: function (response) {
                var responseParse = JSON.parse(response);
                if(responseParse.success =='true'){
                    $('#editLesson').modal('toggle');
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
    $(".deleteLesson").click(function(){
        if(confirm('Are you sure you want to delete?')) {
            var idValue = this.id.split('_')[1];
            $("#getStudent").val(idValue);
            var frm = $('#getLessonForm');
            $.ajax({
                url: "delete_lesson.php",
                type: "post",
                data: frm.serialize() ,
                success: function (response) {
                    var responseParse = JSON.parse(response);
                    if(responseParse.res =='true'){
                        location.reload();
                        toastr.success("Successfully updated.");
                    }
                // You will get response from your PHP page (what you echo or print)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
        }
    });
    $(".addLesson").click(function(){
        var frm = $('#formShowYourLesson');
        $.ajax({
            url: "add_your_lessons_post.php",
            type: "post",
            data: frm.serialize() ,
            success: function (response) {
                var responseParse = JSON.parse(response);
                if(responseParse.res =='true'){
                    location.reload();
                    toastr.success("Successfully updated.");
                }
            // You will get response from your PHP page (what you echo or print)
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
    });


});

    



    </script>
</body>
</html>