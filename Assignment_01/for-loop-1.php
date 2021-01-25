<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Loop 1</title>
</head>

<body>
    <h1>For Loop - 1</h1>
    <p>
        Using for loop that iterates 500 times and shows the numbers which are divisible by 3 and 4 ( i am guessing its not 3 or 4).
    </p>

    <?php
        for($i = 1; $i <= 500; $i++){
            if($i % 3 == 0 && $i % 4 == 0){
                echo "# The number $i is divisible by both 3 and 4.<br>"; 
            }
        }
    ?>
</body>

</html>