<?php

    function getReversedString($text){
        return "<bdo dir='rtl'>$text</bdo>";
    }

    $text_entered = "";
    $output = "";
    if(isset($_POST["btn-reverse"]))
    {
        $text_entered = isset($_POST["text-to-convert"]) ? $_POST["text-to-convert"] : '';

        $output = getReversedString($text_entered);
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/formstyle.css" />

    <style>
        .form-field input{
            width : 90%;
            margin: auto;
            text-align : left;
        }

        .submit-btn{
            margin: 40px 10px auto 10px;
        }
        .output{
            margin: 50px auto 10px;
            width: 90%;
            text-align: center;
        }
    </style>

</head>

<body>
    <div class="container">
        <form action="reverse.php" id="main-form" method="post" autocomplete="off">
            <h2 style="color:deepskyblue;margin-top: -10px; text-align:center;">Reverse String</h2>
            <p style = "text-align:center;color:grey;">Enter your text below: </p>
            
            <div class="form-field">
                <input class="input-text" name="text-to-convert" min = "0" value="<?php echo $text_entered ?>"><br>
            </div>
            <button class ="submit-btn" name = "btn-reverse" type="submit">Show Reversed</button>
            <div class="output" style = "display: <?php echo empty($text_entered)? 'none' : 'block' ?>">
                <h5>Reversed Text: </h5>
                <?php echo $output ?>
            </div>
            <!--  -->
        </form>
    </div>
</body>
