    <!-- /////////PHP code///////// -->
    <?php
    
        function getGpaGrade($score){
            switch (true) {
                case $score < 33:
                    return array("grade" => "F", "gpa" => 0.0);
                case $score < 40:
                    return array("grade" => "D", "gpa" => 1.0);
                case $score < 50:
                    return array("grade" => "C", "gpa" => 2.0);
                case $score < 60:
                    return array("grade" => "B", "gpa" => 3.0);
                case $score < 70:
                    return array("grade" => "A-", "gpa" => 3.5);
                case $score < 80:
                    return array("grade" => "A", "gpa" => 4.0);
                default:
                    return array("grade" => "A+", "gpa" => 5.0);
            }
        }
        
        $error_msgs = array('name' => '', 'score' => ''); 
        $name = $score = '';

        if(isset($_POST["submit"])){
            if(empty($_POST['name'])){
                $error_msgs['name'] = "Please enter your name";
            }
            if(empty($_POST['score']) || 
                !is_numeric($_POST['score']) || 
                $_POST['score'] < 0 || 
                $_POST['score'] > 100)
            {
                $error_msgs['score'] = "Please enter a valid numeric value between 0 and 100, for your score.";
            }

            $name = trim($_POST["name"]) ;
            $score = trim($_POST["score"]);
            if(empty($error_msgs['name']) && empty($error_msgs['score'])){
                $result = getGpaGrade($score);
                $grade = $result["grade"];
                $gpa = $result["gpa"];
                $output_msg = "$name, your Grade: $grade and GPA: $gpa";
                echo "<div class='output'>$output_msg</div>";
                $name = '';
                $score = '';
            }
        }
    ?>




<!-- /////////HTML Markups///////// -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/formstyle.css" />
</head>

<body>
    <div class="container">
        <form action="grade-gpa.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name"  class="input-text" name="name" value="<?php echo $name ?>"><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['name']; ?></div>
            <div class="form-field">
                <label for="score">Score:</label>
                <input type="text" class="numeric-input input-text" name="score" value="<?php echo $score ?>"><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['score']; ?></div>
            <button id="submit-btn" type="submit" name = "submit">Get Grade</button>
        </form>
    </div>
</body>

</html>