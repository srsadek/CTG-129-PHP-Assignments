<?php     
    function getAreaForACircle($radius){
        if(!is_numeric($radius)){
            throw new Exception('Radius value must be a valid number!');
        }
        $pi = 3.141;
        return $pi * $radius * $radius;
    }
    function getAreaForASquare($side){
        if(!is_numeric($side)){
            throw new Exception('Side value must be a valid number!');
        }        
        return $side * $side;
    }
    function getAreaForARectangle($width, $height){
        if(!is_numeric($width) || !is_numeric($height)){
            throw new Exception('Both height and width values must be valid numbers!');
        }          
        return  $width * $height;
    }

    
    $error_msg = '';
    $output_msg = '';
    $radius = $side = $width = $height = '';

    $selected_shape = 'circle';


    if(isset($_POST["submit"])){
        $shape = trim($_POST["shape"]);

        try {
            switch ($shape) {
                case 'circle':
                    $selected_shape = 'circle';
                    $radius = $_POST['radius'];
                    $result = getAreaForACircle($radius);
                    $output_msg = "The area of the circle is: $result";
                    break;
                
                case 'square':
                    $selected_shape = 'square';
                    $side = $_POST['side'];
                    $result = getAreaForASquare($side);
                    $output_msg = "The area of the square is: $result";
                    break;
                
                case 'rectangle':
                    $selected_shape = 'rectangle';
                    $width = $_POST['rectangle-width'];
                    $height = $_POST['rectangle-height'];
                    $result = getAreaForARectangle($width, $height);
                    $output_msg = "The area of the rectangle is: $result";
                    break;

                default:
                    Throw new Exception("Please enter a value!");
                    break;
            }

            echo "<div class='output'>$output_msg</div>";

        } catch (Exception $e) {
            $error_msg =  $e->getMessage();
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
        <form action="finding-area.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field select-field">
                <label for="score">Shape Type:</label>
                <select name="shape" id="select-field">
                    <option value="circle" <?php echo ($selected_shape == "circle") ? 'selected' : '' ;?> >Circle</option>
                    <option value="rectangle" <?php echo ($selected_shape == "rectangle") ? 'selected' : '' ;?>  >Rectangle</option>
                    <option value="square" <?php echo ($selected_shape == "square") ? 'selected' : '' ;?>  >Square</option>
                </select>
            </div>

            <!--  -->
            <div class="form-field form-field-input circle">
                <label for="radius">Radius:</label>
                <input type="text" class="input-text" name="radius" value="<?php echo $radius ?>"><br>
            </div>

            <!--  -->
            <div class="form-field form-field-input hidden square">
                <label for="square">Side:</label>
                <input type="text" class="numeric-input input-text" name="side" value="<?php echo $side ?>" ><br><br>
            </div>
                        
            <!--  -->
            <div class="form-field form-field-input hidden rectangle">
                <label for="rectangle">Width:</label>
                <input type="text" class="numeric-input input-text" name="rectangle-width" value="<?php echo $width ?>" ><br><br>
            </div>
            <div class="form-field form-field-input hidden rectangle">
                <label for="rectangle">Height:</label>
                <input type="text" class="numeric-input input-text" name="rectangle-height" value="<?php echo $height ?>" ><br><br>
            </div>

            <div class="red-text"><?php echo $error_msg; ?></div>
            
            <!--  -->
            <button class ="submit-btn" name = "submit" type="submit">Show Area</button>
        </form>
    </div>


    <script>
        
        const selectField = document.getElementById('select-field');
        
        window.onload = ()=>{
            showRelevantInputs();
        }
        
        selectField.onchange = ()=>{
            showRelevantInputs();

            const redText = document.getElementsByClassName('red-text');
            if(redText.length > 0){
                const mainForm = document.getElementById('main-form');
                mainForm.removeChild(redText[0]);
            }

        }

        function showRelevantInputs(){
            const allFormInputs = document.getElementsByClassName('form-field-input');
            for (let index = 0; index < allFormInputs.length; index++) {
                allFormInputs[index].classList.add("hidden");
            }

            const inputsToShow = document.getElementsByClassName(selectField.value);
            for (let index = 0; index < inputsToShow.length; index++) {
                inputsToShow[index].classList.remove("hidden");
            }   
        }

    </script>

</body>

</html>