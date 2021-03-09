<?php
    session_start();
    include './utils/text-to-image-converter.php';
    //sometimes captcha may not work
    //in that case uncomment "extension=gd" in php.ini file


    $num1=rand(1,9); //Generate First number between 1 and 9  
    $num2=rand(1,9); //Generate Second number between 1 and 9  
    $captcha_total=$num1+$num2;  

    $captcha_text = "$num1"." + "."$num2";  

    $_SESSION['math_captcha_expected_value'] = $captcha_total;

    $image = createCaptchaImage($captcha_text);
?>