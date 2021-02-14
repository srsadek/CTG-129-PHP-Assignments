<?php
    // Assignment requirement: একটি ক্লাবের সকল মেমবারদের ডাটা এরেতে নিয়ে বয়সের উপর বেইজ করে ১৮ বছরের বেশি সবাইতে একটি স্বাগত মেসেজ পাঠান


    session_start();

    $_SESSION['phonebook_entry'] = isset($_SESSION['phonebook_entry']) ? $_SESSION['phonebook_entry'] : [];

    $new_input_errors = "";
    $selected_entry = null;
    
    if(isset($_POST['add-number']) && $_POST['add-number'] == "true"){
        $new_input_errors = getInputErrors();
        if(empty($new_input_errors)){
            $new_member = getNewPhoneEntry();
            array_push($_SESSION['phonebook_entry'], $new_member);
            $_POST = array();
        }
    }elseif (isset($_POST['selected-person-name'])) {
        $selected_entry = getMemberWithPropertyValue($_SESSION['phonebook_entry'], 'name', $_POST['selected-person-name']);
        $number = $selected_entry['number'];
        // echo "<div class='output'>$number</div>";
    }
    
    function getInputErrors(){
        $error_msgs = "";
        if(!isset($_POST['name']) || empty($_POST['name'])){
            $error_msgs = $error_msgs ."<p>Please enter your name</p>";
        }

        //check if member with the same name exists
        $member_with_same_name = getMemberWithPropertyValue($_SESSION['phonebook_entry'], 'name', $_POST['name']);
        if($member_with_same_name != null){
            $error_msgs = $error_msgs ."<p>Member with the same name is already registered!</p>";
        }

        if(!isPhoneNumberValid($_POST['phone-number'])){
            $error_msgs = $error_msgs ."<p>Please enter a valid number!</p><p>Number has to be numberic!</p>
            <p>with minimum of 9 and maximum of 13 digits including country code</p>";
        }

        return $error_msgs;
    }

    function isPhoneNumberValid(string $number){
        if(strlen($number) > 13 || strlen($number) < 9){
            return false;
        }
        if(!is_numeric($number)){
            return false;
        }
        return true;
    }

    function getNewPhoneEntry(){
        $name = isset($_POST["name"]) ? ucfirst(trim($_POST["name"]))  :  "";
        $number = $_POST['phone-number'];
        return [ "name" => $name, "number" => $number];
    }

    function getMemberWithPropertyValue($members_array, $property_name, $property_value){
        foreach ($members_array as $member) {
            if(strtolower($member[$property_name]) == strtolower($property_value)){
                return $member;
            }
        }
        return null;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5Th Grade Result System</title>
    <link rel="stylesheet" href="./css/formstyle.css" />
    <link rel="stylesheet" href="./css/result-sheet.css" />
    <style>
        .container{
            flex-direction : column;
            align-items:center;
        }
        .selected-entry{
            background: white;
            padding: 25px;
            border: 1px solid skyblue;
            border-radius: 5px;
            min-width: 300px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Phonebook</h1>
        <form action="phonebook.php" id="main-form" method="post" autocomplete="off">
            <h4 style="text-align: center;">Add New Number: </h4>
            <hr style="border-top: 8px dotted skyblue; border-bottom: none; width: 50px;">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name"  class="input-text" name="name"
                 value = "<?php echo isset($_POST['name'])? $_POST['name'] : ""?>"><br><br>
            </div>
            <div class="form-field">
                <label for="phone-number">Phone Number</label>
                <input type="text" id="phone-number"  class="input-text" name="phone-number" 
                value = "<?php echo isset($_POST['phone-number'])? $_POST['phone-number'] : ""?>"><br><br>
            </div>
            <button class="submit-btn" type="submit" name = "add-number" value = "true">Add Number</button>
            <div style="margin-top: 25px;" class="red-text">
                <?php echo $new_input_errors ?>
            </div>
        </form>

        <br>

        <form action="phonebook.php" id="select_person" method="post" autocomplete="off">
            <h4 style="text-align: center;">Select a person's name below: </h4>
            <div class="form-field select-field">
                <label >Name:</label>
                <select name="selected-person-name" id="select-field" onchange= "this.form.submit()">
                    <option value= "select_person">Select a Name</option>
                    <?php
                        $entries = isset($_SESSION['phonebook_entry']) ? $_SESSION['phonebook_entry'] : [];
                        foreach ($entries as $entry) {
                    ?>
                    <option value= "<?php echo $entry['name']; ?>"><?php echo $entry['name']; ?></option>
                    <?php } ?>
                </select>
                <noscript><input type="submit"  name = "action" value = "show-member"></noscript>
            </div>
        </form>
        <div class="selected-entry">
            <div class="name">
                <?php echo $selected_entry == null? "" : $selected_entry['name']; ?>
            </div>
            <hr>
            <div class="number">
                <?php echo $selected_entry == null? "" : $selected_entry['number']; ?>
            </div>
        </div>
        <!-- <?php if($selected_entry == null){return;} ?> -->

    </div>
</body>
</html>


