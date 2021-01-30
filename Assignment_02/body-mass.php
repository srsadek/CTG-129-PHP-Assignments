<?php 
    function bodyMassIndex($mass, $height){
        $bodyMassIndex= $mass/ ($height * $height);
            echo "The body mass index is $bodyMassIndex";
    }
    // bodyMassIndex (50, 5.2);





    function bmi(string $name = "Shuvo",float $mass = 0, float $height = 0){
        
        echo $name == true;
        echo $height = $height*0.3048;
        
        if ($name){
            
            // if ($height = $height*0.3048){
                $bmi = $mass/($height*$height);
                echo "Your Body Mass Index : $bmi .";
                //echo $height;
                echo "<br>";
            // }
        }
    
    }
    $sa = bmi("dfasdf");
    echo $sa;

?>