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
        <form action="result-msg-student.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name" class="input-text" name="name"><br><br>
            </div>
            <div class="form-field select-field">
                <label for="score">Sex:</label>
                <select name="sex" id="select-field">
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
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
    $sex = isset($_POST["sex"]) ? trim($_POST["sex"]) : "m";

    if ($name == ""  || $score == "") {
        return;
    }

    if (!is_numeric($score) || $score < 0 || $score > 100){
        echo "<div class='output'>Please enter a valid numeric value between 0 and 100, for your score</div>";
        return;
    }

    $score = (int)trim($_POST["score"]);
    $addressBy  = "ভাইয়া";
    if($sex == "f"){
        $addressBy = "আপু";
    }

    if($score < 33){
        echo "<div class='output'>$name $addressBy, দুঃখিত, আপনি fail করেছেন।<br>পরেরবারের জন্য শুভকামনা রইল - 👍 </div>";
        return;
    }
    echo "<div class='output'>$name $addressBy, Congrates, আপনি pass করেছেন।<br>মিষ্টি বাকি রইল - 😄</div>";
    ?>

</body>

</html>