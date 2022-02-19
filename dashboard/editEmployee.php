<?php 
include"../db.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
$edit=$_GET["id"];
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
       $data=("SELECT * FROM employees WHERE id='$edit'");
        $result=$conn->query($data);
        $row=$result->fetch(PDO::FETCH_ASSOC);
}
?>
   <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
       $data=("UPDATE employees SET `name`='$_POST[edit_name]',`position`='$_POST[edit_position]',
       `office`='$_POST[edit_office]',`age`='$_POST[edit_age]',`salary`='$_POST[edit_salary]' WHERE id='$edit'");
        $stmt=$conn->prepare($data);
        $stmt->execute();
        header("Location:http://localhost/JOBTASK/dashboard/showEmployees.php");
    }
?> 
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Employee Information</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div>
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <!-- <div class="col-lg-7"> -->
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Edit Employees Information</h1>
                            </div>
                            <form  method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"
                                            placeholder="Employee Name" name="edit_name" value="<?php echo $row['name'];?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" 
                                            placeholder="position" name="edit_position" value="<?php echo $row['position'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" 
                                        placeholder="office" name="edit_office" value="<?php echo $row['office'];?>">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user"
                                           placeholder="age" name="edit_age" value="<?php echo $row['age'];?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user"
                                             placeholder="salary" name="edit_salary" value="<?php echo $row['salary'];?>">
                                    </div>
                                </div>
                                <button type='submit' class="btn btn-primary btn-user btn-block">
                                    Edit Employee Information
                                 </button>
                            
                            </form>
                           
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>