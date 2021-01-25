<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        $value = 100000;
        $counter = 1;
        echo "Looping 50 times while incrementing the value of $value<br><br>";

        while ($value < 100050) {
            echo "$counter.Current Value: $value<br>";
            $value++;
            $counter++;
        }

        echo "<br><br><br><br>";

        //reintializing to original value
        $value = 100000;
        $counter = 1;
        echo "Looping 50 times while decrementing the value of $value<br><br>";
        while ($value > 99950) {
            echo "$counter.Current Value: $value<br>";
            $value--;
            $counter++;
        }
    ?>
</body>
</html>