<?php     
    function getCovertedCurrencyValue(float $amount, string $convert_to_code){

        $usd_to_bdt_rate = 84.66;
        $cad_to_bdt_rate = 66.27;
        $gbp_to_bdt_rate = 115.74;

        switch (strtoupper($convert_to_code)) {
            case 'USD':
                return $amount * $usd_to_bdt_rate;
            
            case 'CAD':
                return $amount * $cad_to_bdt_rate;
            
            case 'GBP':
                return $amount * $gbp_to_bdt_rate;
            
            default:
                throw new Exception('Currency code could not be recognized!');
                break;
        }

    }


    $bdt= '';
    $error_msg = '';
    $result = '';
    $value_to_convert = 0.00;
    $currency_code_to_convert_to = 'USD';

    if(isset($_POST["submit"])){
        $currency_code_to_convert_to = trim($_POST["to-currency-code"]);
        $value_to_convert = $_POST["value-to-convert"];

        try{
            if(!is_numeric($value_to_convert) || $value_to_convert < 0){
                throw new Exception('amount value must be a valid positive number!');
            }            
            $result = getCovertedCurrencyValue($value_to_convert, $currency_code_to_convert_to);
            
        } catch (Exception $e) {
            $error_msg =  $e->getMessage();
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
    <style>
    .form-field input{
        width: 70px;
        margin: 0 auto 0 10px;
    }
    #select-field{
        margin : 0 10px 0 auto;  
    }
    .input-text{
        padding: 0 0 0 10px !important;
    }

    .form-field span{
        padding-top: 10px; 
        margin: auto;
    }

    .result{
        margin-top: 30px;
        text-align: center;
        font-size: large;
    }
    </style>
</head>

<body>
    <div class="container">
        <form action="currency-converter.php" id="main-form" method="post" autocomplete="off">
            <h2 style="color:deepskyblue;margin-top: -10px; text-align:center;">Currency Converter</h2>
            <div class="form-field select-field">
                <select name="to-currency-code" id="select-field">
                    <option value="USD"  <?php echo ($currency_code_to_convert_to == "USD") ? 'selected' : '' ;?>>USD</option>
                    <option value="CAD"  <?php echo ($currency_code_to_convert_to == "CAD") ? 'selected' : '' ;?>>CAD</option>
                    <option value="GBP"  <?php echo ($currency_code_to_convert_to == "GBP") ? 'selected' : '' ;?>>GBP</option>
                </select>
                <input  class="input-text" name="value-to-convert" min = "0" value="<?php echo $value_to_convert ?>"><br>
            </div>            

            <div class="red-text"><?php echo $error_msg; ?></div>
            <div class="result"><?php echo "$result Tk/-"; ?></div>
            
            <!--  -->
            <button class ="submit-btn" name = "submit" type="submit">Convert</button>
        </form>
    </div>

</body>

</html>