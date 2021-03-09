<?php

function createCaptchaImage($captcha_text){

    $font = 'assets/fonts/staypuft.ttf';

    $image = imagecreate(135, 30); //Change the numbers to adjust the size of the image
    $background = imagecolorallocate($image, 255, 255, 255);
    $text_color = imagecolorallocate($image, 0, 100, 90);

    // set background colour.
    // imagettftext( [image], [size], [angle], [x], [y], [color], [fontfile], [text] )
    imagettftext ($image, 20, 0, 0, 25, $text_color, $font, $captcha_text );//Change the numbers to adjust the font-size


    $white_line = imagecolorallocate($image, 255, 255, 255);
    $black_line = imagecolorallocate($image, 0, 0, 0);
    for ($i = 0; $i < 50; $i++) {
        //imagefilledrectangle($im, $i + $i2, 5, $i + $i3, 70, $black_line);
        imagesetthickness($image, rand(1, 3));
        imagearc(
            $image,
            rand(1, 300), // x-coordinate of the center.
            rand(1, 300), // y-coordinate of the center.
            rand(1, 300), // The arc width.
            rand(1, 300), // The arc height.
            rand(1, 300), // The arc start angle, in degrees.
            rand(1, 300), // The arc end angle, in degrees.
            (rand(0, 1) ? $black_line : $white_line) // A color identifier.
        );
    }

    header("Content-type: image/png");
    imagepng($image);


    //destroy used resources
    imagecolordeallocate($image, $text_color); 
    imagecolordeallocate($image, $background);
    imagedestroy($image); 

    return $image;
}

?>