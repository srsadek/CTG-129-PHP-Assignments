<?php
    @include_once "autoload.php";


    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $name = $_POST['name'];
        $cell = $_POST['cell'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $location = $_POST['location'];
        $gender = $_POST['gender'];


        if(empty($name) || empty($username) || empty($email) || empty($cell) || empty($location)){
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    All fields are required!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    All fields are required!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }




    }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>CRUD</title>
  </head>
  <body>
    
    <div class="container-fluid">
        <div class="app">
            <div class="student-data mt-5">
                <button class="btn btn-small btn-success mb-4" data-bs-toggle="modal" data-bs-target="#add-student-modal">Add Student</button>

                <?php echo isset($msg)? $msg : '' ?>    

                <table class="table table-info table-striped table-hover shadow">
                    <thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="align-middle">
							<td>1</td>
							<td>Asraful Haque</td>
							<td>haq@gmail.com</td>
							<td>01717700811</td>
							<td>
                                <img class="profile-thumbnails" src="assets/media/img/babu.jpg" alt="">
                            </td>
							<td class="text-center">
								<a class="btn btn btn-info" href="#">View</a>
								<a class="btn btn btn-warning" href="#">Edit</a>
								<a class="btn btn btn-danger" href="#">De-Activate</a>
							</td>
						</tr>

                    </tbody>
                  </table>
            </div>

            <div class="modal" id="add-student-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Add New Student</h3>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Username:</label>
                                    <input name="username" type="text" class="form-control">
                                </div>
                                
                                <div class="form-group mt-1">
                                    <label for="">Student Name:</label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                                
                                <div class="form-group mt-1">
                                    <label for="">Email:</label>
                                    <input name="email" type="text" class="form-control">
                                </div>

                                <div class="form-group mt-1">
                                    <label for="">Cell No:</label>
                                    <input name="cell" type="text" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Location:</label>
                                    <select class="form-control" name="location" id="">
                                        <option value="">--Select--</option>
                                        <option value="mirpur">Mirpur</option>
                                        <option value="mohammadpur">Mohammadpur</option>
                                        <option value="banani">Banani</option>
                                        <option value="uttara">Uttara</option>
                                        <option value="badda">Badda</option>
                                        <option value="dhanmondi">Dhanmondi</option>
                                        <option value="gulshan">Glshan</option>
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Age:</label>
                                    <input name="age" type="text" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Gender:</label><br>
                                    <input name="gender" checked type="radio" id="m"> <label for="male">Male</label>
                                    <input name="gender" type="radio" id="f"> <label for="female">Female</label>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="">Course:</label>
                                    <select class="form-control" name="" id="">
                                        <option value="">--Select--</option>
                                    </select>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="">Profile Photo:</label>
                                    <br>
                                    <label for="student-photo"><img id="student-photo-preview" width="100" src="assets/media/img/upload-image.png" alt="upload-image"></label>
                                    <input id="student-photo" name="student-photo" style="display: none;" class="form-control" type="file">
                                </div>

                                <div class="form-group mt-5">
                                    <input class="btn btn-primary" type="submit" name="submit" value="add-student">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer"></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper as well as jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

    <script>
        $("#student-photo").change((e)=>{
            let file_url = URL.createObjectURL(e.target.files[0]);
            $("#student-photo-preview").attr('src', file_url);
        });
    </script>


  </body>
</html>