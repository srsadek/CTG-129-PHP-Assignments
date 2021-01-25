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
        <form action="user-access.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name" class="input-text"  name="name"><br><br>
            </div>
            <div class="form-field">
                <label for="age">Age:</label>
                <input type="text" class="numeric-input input-text"  name="age"><br><br>
            </div>
            <button id="submit-btn" type="submit">Login</button>
        </form>
    </div>

    <script src="./scripts/script.js"></script>
</body>

</html>

<!-- /////////PHP code///////// -->
<?php
    $name = isset($_POST["name"]) ? trim($_POST["name"])  :  "";
    $age = isset($_POST["age"]) ? trim($_POST["age"]) : "";

    if ($name == ""  || $age == "") {
        return;
    }

    if (!is_numeric($age)) {
        echo "<div class='output'>Please enter a valid numeric value for your age</div>";
        return;
    }

    if ($age < 20 || $age > 35) {
        echo "<div class='output'>Access Denied</div>";
        return;
    }
    echo "<div class='output'>Access Granted!!!</div>";
?>