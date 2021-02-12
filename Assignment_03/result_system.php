<?php
    // Assignment requirement: পঞ্চম শ্রেণীর ছাত্রছাত্রীদের কিছু ডাটা নিয়ে একটি এরে স্ট্রাকচার তৈরি করুন

    // it may seem like an overkill, but the reason why made the file complex is to learn and apply more on how to manipulate array data structure and utilize the functions
    // if you copy the code in your local drive, please do not forget to add the linked css as well
    // this will present a form to the user where user can add a 5th grade strudent's personal information and grades for five subjects
    //once added student's name will appear in the drop down box within "Get a Student's Result below:" section, where user can select the name of a student and his/her result will be shown below
    
    //the code is tested with invalid values, student with same roll no, page refresh with same value etc.
    //please feel free to test it and notify if you found any issue. 

    session_start();
    
    $_SESSION['allStudents'] = isset($_SESSION['allStudents']) ? $_SESSION['allStudents'] : [];

    $new_input_errors = "";
    $selected_student = null;

    if(isset($_POST['add-grade']) && $_POST['add-grade'] == "true"){
        $new_input_errors = getInputErrors();
        if(empty($new_input_errors)){
            $new_student = getNewStudentInformation();
            array_push($_SESSION['allStudents'], $new_student);
            $_POST = array();
        }
    }elseif (isset($_POST['selected-student-name'])) {
        $selected_student = getStudentWithPropertyValue($_SESSION['allStudents'], 'name', $_POST['selected-student-name']);
    }
    
    function getInputErrors(){
        $error_msgs = "";
        if(!isset($_POST['name']) || empty($_POST['name'])){
            $error_msgs = $error_msgs ."<p>Please enter your name</p>";
        }

        if(!isset($_POST['role-no']) || empty($_POST['role-no']) || $_POST['role-no'] < 1){
            $error_msgs = $error_msgs ."<p>Please enter your class role number as a valid positive integer</p>";
        } 
        
        if(!isRoleNumberUnique($_SESSION['allStudents'], $_POST['role-no'])){
            $error_msgs = $error_msgs ."<p>A student with that role number already exists</p>";
        } 
        
        $scores = $_POST['score'];
        foreach ($scores as $key => $value) {
            if(!is_numeric($value) || $value > 100 || $value < 0){
                $subject = ucfirst($key);
                $error_msgs = $error_msgs ."<p>Please enter a valid number for your $subject between (0 - 100)</p>";
            }
        }

        return $error_msgs;
    }

    function getNewStudentInformation(){
        $name = isset($_POST["name"]) ? ucfirst(trim($_POST["name"]))  :  "";
        $role = $_POST["role-no"];
        $gender = isset($_POST["gender"]) ? trim($_POST["gender"]) : "m";
        $gender = $gender == "m"? "Male" : "Female";
        $result = calculateResult( $_POST['score']);

        return [ "name" => $name, "role" => $role, "gender" => $gender, "result" =>  $result];
    }

    function calculateResult($score_array){
        $result = [];
        $scores = [];
        $total_mark = 0;
        $accumulated_point = 0;
        foreach ($score_array as $subject => $mark) {
            
            $grade_point = getSubjectGradeAndPoint($mark);
            $current_sub_result = ['mark' => $mark, 'grade' => $grade_point['grade'], 'point' => $grade_point['point']];
            $scores[$subject] = $current_sub_result;
            $total_mark += $mark;
            $accumulated_point += $grade_point['point'];
        }
        $cgpa = $accumulated_point / count($_POST['score']);
        return ['scores' => $scores, 'total_mark' => $total_mark, 'cgpa' => $cgpa];
    }

    function getSubjectGradeAndPoint($mark){
        if($mark < 0 || $mark > 100){
            throw new Exception("Mark provided is not a valid number!");
        }
        $point = 0;
        $grade = "F";

        switch (true) {
            case $mark >= 90 :
                $point = 4.00;
                $grade = "A+";
                break;
            
            case $mark >= 80 :
                $point = 3.75;
                $grade = "A";
                break;
            
            case $mark >= 70 :
                $point = 3.50;
                $grade = "B+";
                break;
            
            case $mark >= 65 :
                $point = 3.25;
                $grade = "B";
                break;
            
            case $mark >= 55 :
                $point = 3.00;
                $grade = "C+";
                break;
            
            case $mark >= 50 :
                $point = 2.75;
                $grade = "C";
                break;
            
            case $mark >= 40 :
                $point = 2.50;
                $grade = "D+";
                break;
            
            case $mark >= 33 :
                $point = 2.25;
                $grade = "D";
                break;
            
            default:
                $point = 0;
                $grade = "F";
                break;
        }
        return ['point' => $point, 'grade' => $grade];
    }

    function isRoleNumberUnique($student_array, $role_number){
        $student_with_role_number = getStudentWithPropertyValue($student_array, "role", $role_number);
        return $student_with_role_number == null ; 
    }

    function getStudentWithPropertyValue($students_array, $property_name, $property_value){
        foreach ($students_array as $student) {
            if($student[$property_name] == $property_value){
                return $student;
            }
        }
        return null;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5Th Grade Result System</title>
    <link rel="stylesheet" href="./css/formstyle.css" />
    <link rel="stylesheet" href="./css/result-sheet.css" />
    <style>
        .container{
            flex-direction : column;
            align-items:center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Fifth Grade Results</h1>
        <form action="result_system.php" id="main-form" method="post" autocomplete="off">
            <h4 style="text-align: center;">Add Student Result Information below: </h4>
            <hr style="border-top: 8px dotted skyblue; border-bottom: none; width: 50px;">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name"  class="input-text" name="name"
                 value = "<?php echo isset($_POST['name'])? $_POST['name'] : ""?>"><br><br>
            </div>
            <div class="form-field">
                <label for="role">Class Role No:</label>
                <input type="number" id="role"  class="input-text" name="role-no" value = "<?php echo isset($_POST['role-no'])? $_POST['role-no'] : ""?>"><br><br>
            </div>
            <div class="form-field select-field">
                <label >Gender:</label>
                <select name="gender" id="select-field">
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </div>
            <div class="form-field">
                <label>Bangla Score:</label>
                <input type="text" class="numeric-input input-text" name="score[bangla]" value ="<?php echo isset($_POST['score']['bangla'])? $_POST['score']['bangla'] : ""?>"><br><br>
            </div>
            <div class="form-field">
                <label>Eangla Score:</label>
                <input type="text" class="numeric-input input-text" name="score[english]"  
                value ="<?php echo isset($_POST['score']['english'])? $_POST['score']['english'] : ""?>"><br><br>
            </div>
            <div class="form-field">
                <label>Math Score:</label>
                <input type="text" class="numeric-input input-text" name="score[math]"
                value ="<?php echo isset($_POST['score']['math'])? $_POST['score']['math'] : ""?>"><br><br>
            </div>
            <div class="form-field">
                <label>Sceince Score:</label>
                <input type="text" class="numeric-input input-text" name="score[sceince]" 
                value ="<?php echo isset($_POST['score']['sceince'])? $_POST['score']['sceince'] : ""?>"><br><br>
            </div>
            <div class="form-field">
                <label>Religion Score:</label>
                <input type="text" class="numeric-input input-text" name="score[religion]" 
                value ="<?php echo isset($_POST['score']['religion'])? $_POST['score']['religion'] : ""?>"><br><br>
            </div>
            <button class="submit-btn" type="submit" name = "add-grade" value = "true">Add Grade</button>
            <div style="margin-top: 25px;" class="red-text">
                <?php echo $new_input_errors ?>
            </div>
        </form>

        <br>

        <form action="result_system.php" id="result-form" method="post" autocomplete="off">
            <h4 style="text-align: center;">Get a Student's Result below: </h4>
            <div class="form-field select-field">
                <label >Name:</label>
                <select name="selected-student-name" id="select-field" onchange= "this.form.submit()">
                    <option value= "select-student">Select a Student</option>
                    <?php
                        $students = isset($_SESSION['allStudents']) ? $_SESSION['allStudents'] : [];
                        foreach ($students as $student) {
                    ?>
                    <option value= "<?php echo $student['name']; ?>"><?php echo $student['name']; ?></option>
                    <?php } ?>
                </select>
                <noscript><input type="submit"  name = "action" value = "show-grade"></noscript>
            </div>
        </form>
        <!-- <?php if($selected_student == null){return;} ?> -->

        <!-- [ "name" => $name, "role" => $role, "gender" => $gender, "scores" =>  $_POST['score']]; -->

        <div class="result-sheet">
            <div class="info-card">
                <div class="personal-info">
                    <div class="infofield">
                        <span>Name:</span><span><?php echo $selected_student["name"]; ?></span>
                    </div>
                    <div class="infofield">
                        <span>Class Role No:</span><span><?php echo $selected_student["role"]; ?></span>
                    </div>
                    <div class="infofield">
                        <span>Gender:</span><span><?php echo $selected_student["gender"]; ?></span>
                    </div>
                </div>
                <div class="score-summary-info">
                    <div class="infofield">
                        <span>Total Mark:</span><span><?php echo $selected_student["result"]["total_mark"]; ?></span>
                    </div>
                    <div class="infofield">
                        <span>CGPA:</span><span><?php echo $selected_student["result"]["cgpa"]; ?></span>
                    </div>
                </div>    
            </div>
            <div class="scores">

                <?php
                    foreach ($selected_student['result']['scores'] as $subject_name => $subject_result) {
                ?>
                 <div class="subject-result">
                    <div class="subject-name"><?php echo ucfirst($subject_name) ; ?></div>
                    <hr>
                    <span class="subject-score">Mark : <?php echo $subject_result['mark'] ; ?></span>
                    /
                    <span class="subject-score">Grade : <?php echo $subject_result['grade'] ; ?></span>
                 </div>  
                <?php }?> 
                <hr>              
            </div>
        </div>
    </div>
</body>
</html>


