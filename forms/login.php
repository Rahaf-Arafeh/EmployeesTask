<?php 
session_start();
 include"../db.php";
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
		<?php
		  try{
			  if($_SERVER['REQUEST_METHOD']=='POST'){
				  $email=$_POST['email1'];
				  $password=$_POST['password1'];
				  if(empty($email) || empty($password)){
					  $msg="<label>All Field Required!!</label>";
				  }
				  else{
					  $sql="SELECT * FROM users WHERE password='$password' AND email='$email'";
					  $result=$conn->query($sql);
					  if($result->rowCount()!=0){
						  $row=$result->fetch(PDO::FETCH_ASSOC);
						  if($row['isAdmin']==1){
							  header('Location:http://localhost/JOBTASK/dashboard/tables.php');
						  }
						  else{
							$_SESSION["username"]=$row['username'];
							header('Location:http://localhost/JOBTASK/landingpage/landing.php'); 
						  }
                         $date="UPDATE users SET `date_last_login`=CURRENT_TIMESTAMP WHERE id='$row[id]'";
						 $stmt=$conn->prepare($date);
						 $stmt->execute();
					  }
					  else {
						$msg="<label>Username or password are wrong!!</label>";
					}
				  }
			  }
		  } catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		  }
		
		?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
				
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2>Welcome to login</h2>
								<p>Don't have an account?</p>
								<a href="register.php" class="btn btn-white btn-outline-white">Sign Up</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
					<form action="<?php $_SERVER['PHP_SELF']; ?>" class="signin-form" method="POST">
					<div class="form-group mb-3">
			      			<label class="label" for="name">Email</label>
			      			<input type="email" class="form-control" name="email1" placeholder="Email" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" class="form-control" name="password1" placeholder="Password" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
										</label>
									</div>
		            </div>
					<?php
                      if(isset($msg))
                       echo '<label class="form-label text-danger">'.$msg.'</label>';
                       ?>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

