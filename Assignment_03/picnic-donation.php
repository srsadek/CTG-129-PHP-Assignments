<?php
    // Assignment requirement: 
    //- একটি বনভোজনের জন্য চাদার এরে ডাটা তৈরি করুন যেখানে সবাই সবার বেসিক ইনফরমেসন সহ চাদা প্রদান করবে ইচ্ছামতন , , , ফাইনালি মোট চাদার পরিমান বের করুন


    session_start();
    $_SESSION['donation_entry'] = isset($_SESSION['donation_entry']) ? $_SESSION['donation_entry'] : [];

    $new_input_errors = "";
    $selected_entry = null;
    $total_accumulated = getTotalAmount($_SESSION['donation_entry']);
    $highest_contributors = getHighestContributors($_SESSION['donation_entry']);
    
    if(isset($_POST['add-donation']) && $_POST['add-donation'] == "true"){
        $new_input_errors = getInputErrors();
        if(empty($new_input_errors)){
            $new_entry = getNewDonationEntry();
            array_push($_SESSION['donation_entry'], $new_entry);

            $total_accumulated = getTotalAmount($_SESSION['donation_entry']);
            $highest_contributors = getHighestContributors($_SESSION['donation_entry']);
            $_POST = array();
        }
    }elseif (isset($_POST['selected-person-name'])) {
        $selected_entry = getMemberWithPropertyValue($_SESSION['donation_entry'], 'name', $_POST['selected-person-name']);
    }
    
    function getInputErrors(){
        $error_msgs = "";
        if(!isset($_POST['name']) || empty($_POST['name'])){
            $error_msgs = $error_msgs ."<p>Please enter your name</p>";
        }

        //check if member with the same name exists
        $member_with_same_name = getMemberWithPropertyValue($_SESSION['donation_entry'], 'name', $_POST['name']);
        if($member_with_same_name != null){
            $error_msgs = $error_msgs ."<p>Member with the same name is already registered!</p>";
        }

        if(!isPhoneNumberValid($_POST['phone-number'])){
            $error_msgs = $error_msgs ."<p>Please enter a valid number between 9 and 13 digits!</p>";
        }

        if(!isset($_POST['donation-amount']) || !is_numeric($_POST['donation-amount'])){
            $error_msgs = $error_msgs ."<p>Dont be stingy! Please pay in a form of valid amount!</p>";
        }

        if(!isset($_POST['address']) || empty($_POST['address'])){
            $error_msgs = $error_msgs ."<p>Please enter your address!</p>";
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

    function getNewDonationEntry(){
        $name = isset($_POST["name"]) ? ucfirst(trim($_POST["name"]))  :  "";
        $number = $_POST['phone-number'];
        $donation_amount  = $_POST['donation-amount'];
        $address  = $_POST['address'];
        return [ "name" => $name, "number" => $number, 'donation_amount' => $donation_amount, 'address' => $address];
    }

    function getMemberWithPropertyValue($members_array, $property_name, $property_value){
        foreach ($members_array as $member) {
            if(strtolower($member[$property_name]) == strtolower($property_value)){
                return $member;
            }
        }
        return null;
    }

    function getTotalAmount($all_entries){
        $total = 0;
        foreach ($all_entries as $entry) {
            $total += $entry['donation_amount'];
        }
        return $total;
    }

    function getHighestContributors($all_entries){
        if(count($all_entries) == 0){
            return [];
        }

        $highestContributors = [];
        $highest_amount = max(array_column($all_entries, 'donation_amount'));
        foreach ($all_entries as $entry) {
            if($entry['donation_amount'] >= $highest_amount){
                array_push($highestContributors, $entry); 
            }
        }
        return $highestContributors;
    }

    function showSelectedEntry($selected_entry){
        if($selected_entry == null){
            return;
        }
        $name = $selected_entry['name'];
        $amount = $selected_entry['donation_amount'];
        $number = $selected_entry['number'];
        $address = $selected_entry['address'];

        echo
        "<div class='selected-entry'>
            <div class='name'>
                $name
            </div>
            <hr>
            <div class='info'>
                <h4>Donated Tk $amount</h4>  
                <div class='personal-info'>             
                    <p>$number</p>
                    <p>$address</p>
                </div>
            </div>
        </div>";
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
            margin-top:0;
        }
        .selected-entry, .total{
            background: white;
            padding: 25px;
            border: 1px solid skyblue;
            border-radius: 5px;
            min-width: 300px;
            margin-top : 20px ;
            text-align: center;
        }
        .selected-entry{
            margin-bottom: 50px;
        }
        .personal-info{
            font-size: small;
        }
        .personal-info p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Picnic</h1>
        <form action="" id="main-form" method="post" autocomplete="off">
            <h4 style="text-align: center;">Add Donation Information: </h4>
            <hr style="border-top: 8px dotted skyblue; border-bottom: none; width: 50px;">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name"  class="input-text" name="name"
                 value = "<?php echo isset($_POST['name'])? $_POST['name'] : ""?>">
            </div>
            <div class="form-field">
                <label for="phone-number">Phone Number:</label>
                <input type="text" id="phone-number"  class="input-text" name="phone-number" 
                value = "<?php echo isset($_POST['phone-number'])? $_POST['phone-number'] : ""?>">
            </div>
            <div class="form-field">
                <label for="donation">Donation Amount:</label>
                <input type="text" id="donation"  class="input-text" name="donation-amount" 
                value = "<?php echo isset($_POST['donation-amount'])? $_POST['donation-amount'] : ""?>">
            </div>
            
            <div class="form-field">
                <label for="address">Address:</label>
                <input type="text" id="address"  class="input-text" name="address" 
                value = "<?php echo isset($_POST['address'])? $_POST['address'] : ""?>">
            </div>

            <button class="submit-btn" type="submit" name = "add-donation" value = "true">Add Donation</button>
            <div style="margin-top: 25px;" class="red-text">
                <?php echo $new_input_errors ?>
            </div>
        </form>

        <div class="total">
            <p>Total Accumulated: <strong><?php echo $total_accumulated; ?> Tk.</strong></p>
            
            <?php
                if(count($highest_contributors) > 0){
                    echo "<p>Highest Contributor[s]:</P>";
                    foreach ($highest_contributors as $contributor) {
                        $style = 'style="font-size: small;"';
                        echo "<span $style>" . $contributor['name'] . " - " . $contributor['donation_amount'] . "Tk.</span></br>";
                    }
                }
            ?>
        </div>

        <br>
        <?php 
        if(count($_SESSION['donation_entry']) > 0){ ?>
            <form action="" id="select_person" method="post" autocomplete="off">
                <h4 style="text-align: center; margin: 0;">View Individual Contribution:</h4>
                <div class="form-field select-field">
                    <label >Name:</label>
                    <select name="selected-person-name" id="select-field" onchange= "this.form.submit()">
                        <option value= "select_person">Select a Name</option>
                        <?php
                            $entries = isset($_SESSION['donation_entry']) ? $_SESSION['donation_entry'] : [];
                            foreach ($entries as $entry) {
                        ?>
                        <option value= "<?php echo $entry['name']; ?>"><?php echo $entry['name']; ?></option>
                        <?php } ?>
                    </select>
                    <noscript><input type="submit"  name = "action" value = "show-member"></noscript>
                </div>
            </form>
        <?php } ?>
        <?php showSelectedEntry($selected_entry); ?>

    </div>
</body>
</html>


