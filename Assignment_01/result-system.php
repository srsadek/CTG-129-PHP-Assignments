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
        <form action="result-system.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name"  class="input-text" name="name"><br><br>
            </div>
            <div class="form-field">
                <label for="score">Score:</label>
                <input type="text" class="numeric-input input-text" name="score"><br><br>
            </div>
            <button id="submit-btn" type="submit">Get Grade</button>
        </form>
    </div>

    <script src=".scripts/script.js"></script>

    <!-- /////////PHP code///////// -->
    <?php
        $name = isset($_POST["name"]) ? trim($_POST["name"])  :  "";
        $score = isset($_POST["score"]) ? trim($_POST["score"]) : "";
        $letter_grade = "";
        $grade_point = 0.0;
        $output_msg = "";

        if ($name == ""  || $score == ""){
            return;
        }

        if (!is_numeric($score) || $score < 0 || $score > 100){
            echo "<div class='output'>Please enter a valid numeric value between 0 and 100, for your score</div>";
            return;
        }

        $score = (int)trim($_POST["score"]);

        switch (true) {
            case $score < 33:
                $letter_grade = "F";
                $grade_point = 0.0;
                break;
            case $score < 40:
                $letter_grade = "D";
                $grade_point = 1.0;
                break;
            case $score < 50:
                $letter_grade = "C";
                $grade_point = 2.0;
                break;
            case $score < 60:
                $letter_grade = "B";
                $grade_point = 3.0;
                break;
            case $score < 70:
                $letter_grade = "A-";
                $grade_point = 3.5;
                break;
            case $score < 80:
                $letter_grade = "A";
                $grade_point = 4.0;
                break;
            default:
                $letter_grade = "A+";
                $grade_point = 5.0;
                break;
        }
        $output_msg = "$name, you got \"$letter_grade\" - $grade_point";


        if (trim($output_msg) != "") {
            echo "<div class='output'>$output_msg</div>";
        }
    ?>

</body>

</html>