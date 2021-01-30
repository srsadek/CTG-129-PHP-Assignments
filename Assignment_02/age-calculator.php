    <!-- /////////PHP code///////// -->
    <?php
    
        function getAge(int $birthYear){
            
            $year_in_str = strval($birthYear);
            if(strlen($year_in_str) != 4 || !is_numeric($year_in_str)){
                throw new Exception("Please provide a valid birth year!");
            }

            $current_year = date("Y");

            $diff = ($current_year - (int)$year_in_str);

            if($diff < 0 ){
                throw new Exception("Please provide a valid birth year!");
            }
            return $diff;
        }

        echo "you are " . getAge(1930) . " years old";
    ?>    