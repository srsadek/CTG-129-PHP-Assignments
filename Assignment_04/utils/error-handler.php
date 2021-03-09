<?php
    session_start();
    @include 'constants.php';
    @include 'image-handler.php';
    


    function errorExists($error_msgs){
        foreach ($error_msgs as $key => $value) {
            if(!empty($value)){
                return true;
            }
        }
        return false;
    }
    
    function getInputErrors(){
        
        $error_msgs = [
                        'name' => '', 'email' => '', 'phone' => '', 'password' => '', 
                        'age' => '', 'math_captcha' => '', 'text_captcha' => '',
                        'profile_image' => ''
                      ];
       
        if(empty($_POST['name'])){
            $error_msgs['name'] = constructErrorMessageParagraph('Required field');
       }

       $error_msgs['email'] = getErrorMsgForInvalidEmail($_POST['email']);
       $error_msgs['phone'] = getErrorMsgForInvalidPhone($_POST['phone']);
       $error_msgs['password'] = getErrorMsgForInvalidPassword($_POST['password'], $_POST['confirm-password']);
       $error_msgs['age'] = getErrorMsgForAgeOutOfRange($_POST['age']);
       $error_msgs['math_captcha'] = getErrorMsgForMathCaptchaMissmatch($_POST['math-captcha-result'], $_SESSION['math_captcha_expected_value']);
       $error_msgs['text_captcha'] = getErrorMsgForMathCaptchaMissmatch($_POST['text-captcha-result'], $_SESSION['text_captcha_expected_value']);
       $error_msgs['profile_image'] = getErrorMsgOnInvalidImageData();
       return $error_msgs;
    }

    function constructErrorMessageParagraph($msg){
        return "<p style=\" color:red; \"> * " . $msg . "</p>";
    }

    //Email 
    function getErrorMsgForInvalidEmail($email){
        if(empty($email)){
            return  constructErrorMessageParagraph('Required field');
       }else if(!isEmailValid($email)){
            return constructErrorMessageParagraph('A valid ' . DOMAIN . ' email is required');
       }
       return '';
    }

    function isEmailValid($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $email_domain = explode("@", $email);
        $email_domain = trim(end($email_domain));
        $expected_domain = trim(strtolower(DOMAIN));
        if($email_domain != $expected_domain){
            return false;
        }
        return true;

    }

    //Phone
    function getErrorMsgForInvalidPhone($phone){
        if(empty($phone)){
            return constructErrorMessageParagraph('Required field');
        }else if(strlen($phone) != 11){
            return constructErrorMessageParagraph('Phone number is not valid.');
        }
        else if(!isPhoneNumberValid($phone)){
            $msg = 'Area code is not valid.<br>* Accepted codes are: ' . implode(", ", PHONE_ACCEPTED_AREA_CODE);
            return constructErrorMessageParagraph($msg);
        }       
    }
    function isPhoneNumberValid($phone){
        $area_code = substr($phone, 0, 3);
        if(!in_array($area_code, PHONE_ACCEPTED_AREA_CODE)
        ){
            return false;
        }
        return true;
    }

    //password
    function getErrorMsgForInvalidPassword($password, $confirmed_password){
        if(empty($password)){
            return constructErrorMessageParagraph('Required field');
        }
        if(empty($confirmed_password)){
            return constructErrorMessageParagraph('Please confirm password');
        }
        if($password != $confirmed_password){
            return constructErrorMessageParagraph('Confirmed password does not match!');
        }
        return "";
    }

    //Age
    function getErrorMsgForAgeOutOfRange($age){
        if(empty($age)){
            return constructErrorMessageParagraph('Required field');
        }
        if($age >= 40 || $age <= 18){
            return constructErrorMessageParagraph('Age must be between 18 and 40 to sign up.');
        }
        return "";
    }

    //captcha
    function getErrorMsgForMathCaptchaMissmatch($entered_value, $expected_value){
        //$_SESSION['rand_code']
        if(empty($entered_value)){
            return  constructErrorMessageParagraph('Please enter captcha value to proceed.');
        }
        
        if($entered_value != $expected_value){
            return  constructErrorMessageParagraph('Captcha did not match!');
        }
    }

    //profile photo upload
    function getErrorMsgOnInvalidImageData(){
        $image_file = $_FILES['profile_image'];
        if($image_file['error'] > 0 || strlen($image_file['tmp_name']) == 0){
            return constructErrorMessageParagraph('A profile image is required!');
        }

        if(!isProfilePhotoWithinExpectedSize($image_file)){
            $msg = 'Profile image must be less than ' . PROFILE_IMAGE_ACCEPTED_SIZE_KB . 'Kb in size';
            return constructErrorMessageParagraph($msg);
        }
    }

?>