<?php
    // Assignment requirement: একটি ক্লাবের সকল মেমবারদের ডাটা এরেতে নিয়ে বয়সের উপর বেইজ করে ১৮ বছরের বেশি সবাইতে একটি স্বাগত মেসেজ পাঠান


    session_start();

    $_SESSION['all_members'] = isset($_SESSION['all_members']) ? $_SESSION['all_members'] : [];

    $new_input_errors = "";
    $selected_member = null;

    if(isset($_POST['add-member']) && $_POST['add-member'] == "true"){
        $new_input_errors = getInputErrors();
        if(empty($new_input_errors)){
            $new_member = getNewMemberInformation();
            array_push($_SESSION['all_members'], $new_member);
            $_POST = array();
        }
    }elseif (isset($_POST['selected-member-name'])) {
        $selected_member = getMemberWithPropertyValue($_SESSION['all_members'], 'name', $_POST['selected-member-name']);
        $msg = getMessageStringForAMember($selected_member);
        echo "<div class='output'>$msg</div>";
    }
    
    function getInputErrors(){
        $error_msgs = "";
        if(!isset($_POST['name']) || empty($_POST['name'])){
            $error_msgs = $error_msgs ."<p>Please enter your name</p>";
        }

        //check if member with the same name exists
        $member_with_same_name = getMemberWithPropertyValue($_SESSION['all_members'], 'name', $_POST['name']);
        if($member_with_same_name != null){
            $error_msgs = $error_msgs ."<p>Member with the same name is already registered!</p>";
        }


        if(!isset($_POST['member-age']) || empty($_POST['member-age']) || $_POST['member-age'] < 1){
            $error_msgs = $error_msgs ."<p>Please enter a valid age in year</p>";
        } 
        return $error_msgs;
    }

    function getNewMemberInformation(){
        $name = isset($_POST["name"]) ? ucfirst(trim($_POST["name"]))  :  "";
        $age = $_POST["member-age"];
        return [ "name" => $name, "age" => $age];
    }

    function getMessageStringForAMember($member){
        
        $name = $member['name'];
        $message = "$name, ";
        
        if($member['age'] < 18 ){
            $message = $message . "Your membership is pending. It will be activated once you reach 18."; 
        }elseif ($member['age'] < 41) {
            $message = $message . "Thank you for being part of the club."; 
        }
        elseif ($member['age'] < 101) {
            $message = $message . "You have been with us for so many years.<br>You have been upgraded to gold membership"; 
        }
        else{
            $message = $message . "You sure you are that old!!!"; 
        }
        return $message;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to "The Club"</h1>
        <form action="club_member.php" id="main-form" method="post" autocomplete="off">
            <h4 style="text-align: center;">Add New Member: </h4>
            <hr style="border-top: 8px dotted skyblue; border-bottom: none; width: 50px;">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name"  class="input-text" name="name"
                 value = "<?php echo isset($_POST['name'])? $_POST['name'] : ""?>"><br><br>
            </div>
            <div class="form-field">
                <label for="age">Age</label>
                <input type="number" id="age"  class="input-text" name="member-age" 
                value = "<?php echo isset($_POST['member-age'])? $_POST['member-age'] : ""?>"><br><br>
            </div>
            <button class="submit-btn" type="submit" name = "add-member" value = "true">Add Memmber</button>
            <div style="margin-top: 25px;" class="red-text">
                <?php echo $new_input_errors ?>
            </div>
        </form>

        <br>

        <form action="club_member.php" id="select-member" method="post" autocomplete="off">
            <h4 style="text-align: center;">Select a member below: </h4>
            <div class="form-field select-field">
                <label >Name:</label>
                <select name="selected-member-name" id="select-field" onchange= "this.form.submit()">
                    <option value= "select-member">Select a Member</option>
                    <?php
                        $members = isset($_SESSION['all_members']) ? $_SESSION['all_members'] : [];
                        foreach ($members as $member) {
                    ?>
                    <option value= "<?php echo $member['name']; ?>"><?php echo $member['name']; ?></option>
                    <?php } ?>
                </select>
                <noscript><input type="submit"  name = "action" value = "show-member"></noscript>
            </div>
        </form>
        <!-- <?php if($selected_member == null){return;} ?> -->

    </div>
</body>
</html>


