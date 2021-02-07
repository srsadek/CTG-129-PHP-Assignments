
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color of heading</title>
    <style>
        body{
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items:center;
            text-align: center;
        }
    </style>
</head>
<body>
    
    <h2>বাংলার রঙের নাম (লাল, সবুজ, নীল, হলুদ, কালো) লিখুন</h2>
<form action="" method="post">
        <label for="color">রঙ :</label> <br>  <input type="text" name="color" /><br />
        <input type="submit" name="submit" value="Submit!" />
    </form>

    <?php 
        $color = $_POST["color"];
        $heading = "শিরোনাম রঙ পরিবর্তন";
        
        if($color != 0) {
            echo changeFontColorOfAnElement($color, $heading);
        } else {
            echo $heading;
        }

        function changeFontColorOfAnElement($color, $text) {
                if($color == "লাল") {
                    return "<h1 style='color:red'>". $text . "</h1>";
                }
                if($color == "সবুজ") {
                    return "<h1 style='color:green'>". $text . "</h1>";
                }
                if($color == "নীল") {
                    return "<h1 style='color:blue'>". $text . "</h1>";
                }
                if($color == "বেগুনি") {
                    return "<h1 style='color:SlateBlue'>". $text . "</h1>";
                }
                if($color == "হলুদ") {
                    return "<h1 style='color:yellow'>". $text . "</h1>";
                }
                if($color == "কালো") {
                    return "<h1 style='color:black'>". $text . "</h1>";
                } 
        }
    ?>
</body>
</html>