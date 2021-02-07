<?php
    function head($tag='H2', $header_text='Default Header Text', $align='center', $color='Orange', $font='Arial'){
      echo "<$tag style='text-align:$align; color:$color; font-family:$font'>$header_text</$tag>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Header</title>
    
    <style>
    .intro{
        width: 70%;
        text-align: center;
        margin: 0 auto;
        padding: 10px;
        border : 1px solid skyblue;
        border-radius : 10px;
    }
    </style>

</head>
<body>
    <div class="intro">
    <h1>This is a test for dynamic header</h1>
    <p>First header call will be shown with default value and the next one would be called with prameters</p>
    </div>
    <br>
    <br>
    <br>

    <?php

        echo head();
        echo "<br><br><br>";
        echo head("h3", "This is a custom heading1", "right", "cadetblue", "times new roman");
        echo "<br><br><br>";
        echo head("h4", "This is a custom heading2", "left", "darkblue", "monospace");
    ?>

</body>
</html>