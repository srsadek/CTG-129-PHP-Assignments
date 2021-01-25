<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Loop 3</title>
</head>

<body>
    <h1>For Loop - 3</h1>
    <p>
        Times Table
    </p>

    <?php
       for ($i = 2; $i <= 5; $i++) {
        echo "<br><br>Times table for $i : <br>-----------------------<br>";
        for ($j = 1; $j <= 10; $j++) {
             $result = $i * $j;
            echo  "$i * $j = $result <br>";
        }
    }
    ?>
</body>

</html>