<?php
    @include 'utils/error-handler.php';
    // @include 'utils/image-handler.php';
    /*
    this is going to be a signup form following fields will be shown
        -name
        -email
        -cell
        -age
        -mathmatics solution system
        -string captcha
        */
    $entered_value['gender'] = isset($_POST['gender'])? $_POST['gender']: 'male';

    if(isset($_POST['insert'])){
        $entered_value['name'] = $_POST['name'];
        $entered_value['email'] = $_POST['email'];
        $entered_value['phone'] = $_POST['phone'];
        $entered_value['age'] = $_POST['age'];
        $err = getInputErrors();
        if(!errorExists($err)){
            storeImageToMediaDir($_FILES['profile_image']);
            clearInputs($entered_value);
            $msg =  '<div class="alert alert-success alert-dismissible mx-3 fade show" role="alert">
            User Signed Up !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }else{
            $msg =  '<div class="alert alert-danger alert-dismissible mx-3 fade show" role="alert">
            All fields are required !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    function clearInputs(&$input_fields){
        $input_fields['gender'] = 'male';
        $input_fields['name'] = '';
        $input_fields['email'] = '';
        $input_fields['phone'] = '';
        $input_fields['age'] = '';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/styles.css" />
</head>
<body>
    <div class="container-fluid d-flex flex-row justify-content-center ">
        <div class="main d-flex align-items-center">
            <div class="wrap shadow">
                <div class="card">
                    <div class="card-title text-center">
                        <h2 style="margin-top:20px;">Sign Up</h2>
                    </div>
                    <?php echo isset($msg)? $msg : ''; ?>
                    <div class="card-body">
                        <?php  echo isset($display_msg) ? $display_msg : "" ?>
                        <form action="" method="post" enctype="multipart/form-data">

                            <!-- Name Input -->
                            <div class="form-row">
                                <div class="form-group col-sm">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" class="form-control" 
                                        value=<?php echo isset( $entered_value['name'])?  $entered_value['name'] : ''; ?>>
                                    <?php echo isset($err['name']) ? $err['name'] : "" ?>
                                </div>
                            </div>

                            <!-- Email Input -->
                            <div class="form-row">
                                <div class="form-group col-sm">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control"
                                        value=<?php echo isset( $entered_value['email'])?  $entered_value['email'] : ''; ?>
                                    >
                                    <?php echo isset($err['email']) ? $err['email'] : "" ?>
                                </div>
                            </div>

                            <!-- Phone Input -->
                            <div class="form-row">
                                <div class="form-group col-sm">
                                    <label for="phone">Your Phone Number</label>
                                    <input type="text" name="phone" class="form-control"
                                        value=<?php echo isset( $entered_value['phone'])?  $entered_value['phone'] : ''; ?>
                                    >
                                    <?php echo isset($err['phone'])?  $err['phone'] : "";?>
                                </div>
                            </div>

                            <!-- Passwords -->
                            <div class="row form-row">
                                <div class="form-group col-sm-6">
                                    <label for="password">Your Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" name="confirm-password" class="form-control">
                                </div>
                                <?php echo isset($err['password'])? $err['password'] : "" ?>
                            </div>

                            <!-- Age/Gender Input -->
                            <div class="row form-row">
                                <div class="form-group col-sm-6">
                                    <label for="age">Your Age</label>
                                    <input type="number" max=100 min=1 name="age" class="form-control"
                                    value=<?php echo isset( $entered_value['age'])?  $entered_value['age'] : ''; ?>
                                    >
                                    <?php echo isset($err['age']) ? $err['age'] : "" ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="gender">Gender</label>
                                    <select id="inputState" name="gender" class="form-control">
                                        <option value="male" 
                                            <?php echo $entered_value['gender'] == 'male'? 'Selected' : '' ?>>
                                                Male
                                        </option>
                                        <option value="female" <?php echo $entered_value['gender'] == 'female'? 'Selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Avatar Image -->
                            <div class="row form-row">
                                <div class="form-group col-sm-6 d-flex justify-content-start align-items-center">
                                    <label for="avatar_upload">
                                        <img 
                                            src="./assets/media/img/upload_avatar.png" 
                                            width = "50"
                                            style="cursor: pointer;"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="profile image">
                                    </label>   
                                    <input 
                                        type="file" 
                                        name="profile_image" 
                                        accept="image/*"
                                        id="avatar_upload" 
                                        class="d-none"> 
                                </div>
                                <div class="form-group col-sm-6 py-3">
                                        <img id="img-preview" src="" width = "150px">
                                </div>    
                                <div class="pt-1">
                                    <?php echo isset($err['profile_image']) ? $err['profile_image'] : "" ?>
                                </div>                                    
                            </div>

                            <!-- Math Captcha -->
                            <div class="row form-row py-2">
                                <div class="form-group col-sm-8">
                                    <label for="math-captha">Math Captcha</label>
                                    <div class="d-flex justify-content-between">
                                        <img id="math-captcha" src="math-captcha.php" alt="captcha">
                                        <span class="mx-3">=</span>
                                        <input  class="form-control" type="text" name = "math-captcha-result"style="vertical-align:middle;"  size="6">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 d-flex align-items-end">
                                    <img id="reload-math-captcha" class="px-2 reload" src="./assets/media/img/reload.png" width="50" alt="reload_math_captcha">
                                    <span class="pb-1">Reload</span>
                                </div>
                                <div class="pt-1">
                                    <?php echo isset($err['math_captcha']) ? $err['math_captcha'] : "" ?>
                                </div>
                            </div>
                            
                            <!-- Text Captcha -->
                            <div class="row form-row py-2">
                                <div class="form-group col-sm-8">
                                    <label for="text-captcha">Text Captcha</label>
                                    <div class="d-flex justify-content-between">
                                        <img id="text-captcha" src="text-captcha.php" alt="captcha">
                                        <span class="mx-3">=</span>
                                        <input  type="text" class="form-control" name="text-captcha-result" style="vertical-align:middle;"  size="6">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 d-flex align-items-end">
                                    <img id="reload-text-captcha" class="px-2 reload" src="./assets/media/img/reload.png" width="50" alt="reload_text_captcha">
                                    <span class="pb-1">Reload</span>
                                </div>
                                <div class="pt-1">
                                    <?php echo isset($err['text_captcha']) ? $err['text_captcha'] : "" ?>
                                </div>
                            </div>
                            <button type="submit" name="insert" class="btn btn-block btn-primary mt-3">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src = "./assets/js/script.js"></script>
</body>
</html>