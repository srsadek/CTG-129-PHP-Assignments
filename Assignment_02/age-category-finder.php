<?php     
    $error_msgs = array('name' => '', 'age' => ''); 
    $name = '';
    $age = '';

    function getAgeGroup($age)
    {
        if ($age > 65) {
            return "Old";
        }
        if($age > 45){
            return "Middle Aged";
        }
        if($age > 30){
            return "Man";
        }
        if($age > 19){
            return "Young Adult";
        }
        if($age > 12){
            return "Teen Age";
        }
        if($age > 6){
            return "Boy";
        }
        if($age > 2){
            return "Toddler";
        }
        if($age > 0){
            return"Baby";
        }
        return "Undefined";
    }
    if(isset($_POST["submit"])){
        if(empty($_POST['name'])){
            $error_msgs['name'] = "Please enter your name";
        }
        if(empty($_POST['age'])){
            $error_msgs['age'] = "Please enter your age";
        }
    

        $name = trim($_POST["name"]) ;
        $age = trim($_POST["age"]);

        if (!is_numeric($age) || $age > 130) {
            $error_msgs['age'] = "Please a valid numeric value for your age";
        }
        
        if(empty($error_msgs['name']) && empty($error_msgs['age'])){

            $age_group = getAgeGroup($age);
            echo "<div class='output'>$name, Your age group is: $age_group </div>";
            $age = '';
            $name = '';
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
        <form action="age-category-finder.php" id="main-form" method="post" autocomplete="off">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name" class="input-text" name="name" value="<?php echo $name ?>"><br><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['name']; ?></div>
            <div class="form-field">
                <label for="age">Age:</label>
                <input type="text" class="numeric-input input-text" name="age" value="<?php echo $age ?>" ><br><br>
            </div>
            <div class="red-text"><?php echo $error_msgs['age']; ?></div>
            <button class="submit-btn" name = "submit" type="submit">Show Age Group</button>
        </form>
    </div>
</body>

</html>