<?php  

    function imageUploader($x, $y, $z) {
        return "<img src='./laptop_&_coffee.jpg' style='height:$x; width:$y' alt='$z'> <h3>$z</h3>";
    }

    function createImageElement(string $img_name,  int $width = 200, int $height = 200){
        $height = $height . 'px';
        $width = $width . 'px';
        return "<img src= $img_name style='height: $height; width: $width' alt='$img_name'><h5>$img_name</h5>";
    }

    $error_msgs = array('file' => '', 'dimension' => ''); 
    $file_path = "";
    $width = "";
    $height = "";
    $img_element = "";

    if(isset($_POST["submit"])){
        if(empty($_POST['file-name'])){
            $error_msgs['file'] = "Please enter a valid file name, including extension";
        }
        if(
            empty($_POST['width']) || empty($_POST['height'])||
            !is_numeric($_POST['width']) || !is_numeric($_POST['height'])
        ){
            $error_msgs['dimension'] = "Please enter valid numeric value for width and height";
        }
    

        $file_path = trim($_POST["file-name"]) ;
        $width = trim($_POST["width"]);
        $height = trim($_POST["height"]);
        
        if(empty($error_msgs['file']) && empty($error_msgs['dimension'])){
            $img_element = createImageElement($file_path, $width, $height);
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
    <style>
        .container{
            flex-direction : column;
            align-items:center;
        }

        .img-display{
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="image-updater.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field">
                <label for="file-path">File Location:</label>
                <input type="text" id="file-path" class="input-text" name="file-name" value="<?php echo $file_path ?>"><br><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['file']; ?></div>
            <div class="form-field">
                <label>Width:</label>
                <input type="text" class="numeric-input input-text" name="width" value="<?php echo $width ?>" ><br><br>
            </div>
            <div class="form-field">
                <label>Height:</label>
                <input type="text" class="numeric-input input-text" name="height" value="<?php echo $height ?>" ><br><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['dimension']; ?></div>
            <button class="submit-btn" name = "submit" type="submit">Show Image</button><br><br>
        </form>
        <div class='img-display'>
            <?php echo $img_element ?>
        </div>
    </div>
</body>

</html>