<?php

    function getParagraphWithCaseConverted($text, $case){
        $text_transform = 'lowercase';
        if($case=='UPPER'){
            $text_transform = 'uppercase';
        }
        return "<p style='text-transform:$text_transform'>$text</p>";
    }
    $text_entered = "";
    $output = "";
    if(isset($_POST["submit-upper"]) || isset($_POST["submit-lower"]))
    {
        $case_type = array_key_exists('submit-upper', $_POST) ? 'UPPER' : 'LOWER';

        $text_entered = isset($_POST["text-to-convert"]) ? $_POST["text-to-convert"] : '';

        $output = getParagraphWithCaseConverted($text_entered, $case_type);
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
        .case-buttons{
            display : flex;   
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
        <form action="case-function.php" id="main-form" method="post" autocomplete="off">
            <h2 style="color:deepskyblue;margin-top: -10px; text-align:center;">Case Converter</h2>
            <p style = "text-align:center;color:grey;">Enter your text below: </p>
            
            <div class="form-field">
                <input class="input-text" name="text-to-convert" min = "0" value="<?php echo $text_entered ?>"><br>
            </div>
            <div class="case-buttons">
                <button class ="submit-btn" name = "submit-upper" type="submit">To Upper Case</button>
                <button class ="submit-btn" name = "submit-lower" type="submit">To lower Case</button>
            </div>
            <div class="output" style = "display: <?php echo empty($text_entered)? 'none' : 'block' ?>">
                <h5>Converted Text: </h5>
                <?php echo $output ?>
            </div>
            <!--  -->
        </form>
    </div>
</body>
