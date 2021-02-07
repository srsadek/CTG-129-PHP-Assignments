<?php 

    function getBodyMassIndex(float $weight, float $height ){
        return round($weight / pow($height, 2), 2);
    }

    $height = $weight = '';
    $error_msgs =  array('height' => '' , 'weight' => '');

    if(isset($_POST['submit'])){
        if(!isset($_POST['height']) || !is_numeric($_POST['height']) || $_POST['height'] <= 0  ){
            $error_msgs['height'] = "Please enter a valid numeric value for height";
        }
        
        if(!isset($_POST['weight']) || !is_numeric($_POST['weight']) || $_POST['weight'] <= 0){
            $error_msgs['weight'] = "Please enter a valid numeric value for weight";
        }
        

        $weight = floatval($_POST['weight']);
        $height = floatval($_POST['height']);

        if(empty($error_msgs['height']) && empty($error_msgs['weight'])){
            $bmi = getBodyMassIndex($weight, $height);
            echo "<div class='output'>Your BMI is: $bmi</div>";
            $weight = $height = '';
        }
    }
?>


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
        <form action="bmi.php" id="main-form" method="post" autocomplete="off">
            <!--  -->
            <div class="form-field form-field-input ">
                <label for="radius">Height(Mtr):</label>
                <input type="text" class="input-text" name="height" value="<?php echo $height ?>"><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['height'] ?></div>

            <div class="form-field form-field-input ">
                <label for="radius">Weight(KG):</label>
                <input type="text" class="input-text" name="weight" value="<?php echo $weight ?>"><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['weight'] ?></div>
            
            <!--  -->
            <button class="submit-btn" name = "submit" type="submit">Show BMI</button>
        </form>
    </div>
</body>

</html>