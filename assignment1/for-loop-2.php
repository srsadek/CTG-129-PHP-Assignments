<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Loop 2</title>
</head>

<body>
    <h1>For Loop - 2</h1>
    <p>
        Using for loop where initial value increments by three each time and will break at first occurance of a number that is divisble by 11.
    </p>

    <?php
        for($i = 1;  ; $i+= 3){
            if($i % 11 == 0){
                echo "First number found that is divisible by 11 is $i <br>Breaking out of loop";
                break;
            }
        }
    ?>
</body>

</html>