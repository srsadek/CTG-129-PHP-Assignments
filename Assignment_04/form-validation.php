<?php
    @include 'error-handler.php';
    /*
    this is going to be a signup form following fields will be shown
        -name
        -email
        -cell
        -age
        -mathmatics solution system
        -string captcha
    */
    if(isset($_POST['insert'])){
        
        $err = getInputErrors();
        
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
                    <div class="card-body">
                        <?php  echo isset($display_msg) ? $display_msg : "" ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-sm">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" class="form-control">
                                    <?php echo isset($err['name']) ? $err['name'] : "" ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control">
                                    <?php echo isset($err['email']) ? $err['email'] : "" ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm">
                                    <label for="phone">Your Phone Number</label>
                                    <input type="text" name="phone" class="form-control">
                                    <?php echo isset($err['phone'])?  $err['phone'] : "";?>
                                </div>
                            </div>
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
                            <div class="row form-row">
                                <div class="form-group col-sm-6">
                                    <label for="age">Your Age</label>
                                    <input type="number" max=100 min=1 name="age" class="form-control">
                                    <?php echo isset($err['age']) ? $err['age'] : "" ?>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="gender">Gender</label>
                                    <select id="inputState" name="gender" class="form-control">
                                        <option selected>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-row">
                                <div class="form-group col-sm-6 d-flex justify-content-start align-items-center">
                                    <label for="avatar_upload">
                                        <img 
                                            src="./assets/media/img/upload_avatar.png" 
                                            width = "50"
                                            style="cursor: pointer;"
                                            accept=".jpg,.jpeg, .png"
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="profile image">
                                    </label>   
                                    <input type="file" name="profile_image" id="avatar_upload" class="d-none"> 
                                </div>
                                <div class="form-group col-sm-6 py-3">
                                        <img id="img-preview" src="" width = "150px">
                                </div>        
                            </div>
                            <div class="row form-row">
                                <div class="form-group col-sm-6">
                                    <label for="math-captha">Captcha</p>
                                    <img id="math-captcha" src="captcha.php" alt="captcha">
                                    <span>=</span>
                                    <input  type="text" style="vertical-align:middle;"  size="2">
                                </div>
                                <div class="form-group col-sm-6 d-flex align-items-end">
                                    <img id="reload-math-captcha" class="px-2 reload" src="./assets/media/img/reload.png" width="50" alt="reload_math_captcha">
                                    <span class="pb-1">Reload</span>
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