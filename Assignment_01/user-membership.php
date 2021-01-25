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
        <form action="user-membership.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name" class="input-text" name="name"><br><br>
            </div>
            <div class="form-field">
                <label for="credit">Credit:</label>
                <input type="text" class="numeric-input input-text" name="credit"><br><br>
            </div>
            <button id="submit-btn" type="submit">Show Membership</button>
        </form>
    </div>

    <script src="./scripts/script.js"></script>
</body>

</html>

<!-- /////////PHP code///////// -->
<?php
    $name = isset($_POST["name"]) ? trim($_POST["name"])  :  "";
    $credit = isset($_POST["credit"]) ? trim($_POST["credit"]) : "";

    if ($name == ""  || $credit == "") {
        return;
    }

    if (!is_numeric($credit)) {
        echo "<div class='output'>Please enter a valid numeric value for your credit</div>";
        return;
    }

    $membership_level = "";
    if ($credit > 100) {
        $membership_level = "Platinum";
    }
    else if($credit > 80){
        $membership_level = "Dimond";
    }
    else if($credit > 60){
        $membership_level = "Gold";
    }
    else if($credit > 40){
        $membership_level = "Silver";
    }
    else if($credit > 20){
        $membership_level = "Bronze";
    }
    else if($credit > 0){
        $membership_level = "Starter";
    }

    if($credit <= 0){
        echo "<div class='output'>You are not a member, <br>please signup for free to get the starter package</div>";
        return;
    }

    echo "<div class='output'>$name, You are our $membership_level member. <br>We appeciate your business</div>";
?>