<?php
    @include 'constants.php';
    
    function getInputErrors(){
       $error_msgs = ['name' => '', 'email' => '', 'phone' => '', 'password' => '', 'age' => '', 'captcha' => ''];

       //Name
       if(empty($_POST['name'])){
            $error_msgs['name'] = constructErrorMessageParagraph('Required field');
       }

       $error_msgs['name'] = getErrorMsgForInvalidEmail($_POST['email']);
       $error_msgs['phone'] = getErrorMsgForInvalidPhone($_POST['phone']);
       $error_msgs['password'] = getErrorMsgForInvalidPassword($_POST['password'], $_POST['confirm-password']);
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
        if($age >= 40 || age <= 18){
            return constructErrorMessageParagraph('Age must be between 18 and 40 to signin.');
        }
        return "";
    }

    //math captcha
    function getErrorMsgForMathCaptchaMissmatch(){
        //$_SESSION['rand_code']
        
    }
?>