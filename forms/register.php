<?php 
 include"../db.php";
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $username=$_POST['username'];
            $password=$_POST['password'];
            $email=$_POST['email'];
            $confirm_pass=$_POST['conPassword'];
            $email_regx= "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
            $flag=0;
            
            if(!empty($email) && preg_match($email_regx,$email)){
                $flag++;
            }
            if(!empty($password) && strlen($password)>=8){
                $flag++;
            }
            if(!empty($confirm_pass) && $password==$confirm_pass){
                $flag++;
            }
            if ($flag==3){
             try {
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "INSERT INTO users (username, password , email)
              VALUES (:username, :password, :email)";
              $stmt= $conn->prepare($sql);
              $stmt->execute(['username'=>$username,'password'=>$password,'email'=>$email]);
              $conn->exec($stmt);
              echo "New record created successfully";
            } catch(PDOException $e) {
             echo $sql . "<br>" . $e->getMessage();
            }
  
               $conn = null;
               header('Location:http://localhost/JOBTASK/forms/login.php'); 
           }
            
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
								<h2>Welcome to sign up</h2>
								<p>already have an account?</p>
								<a href="login.php" class="btn btn-white btn-outline-white">Sign in</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign up</h3>
			      		</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
			      	</div>
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="signup-form">
			      		<div class="mb-3">
			      			<label class="label" for="username">Username</label>
			      			<input type="text" id="username" class="form-control" name="username"
                               placeholder="Username" onchange="usernameValidation()" required/>
                              <span id="username_err"></span>
                        </div>
                          <div class="mb-3">
			      			<label class="label" for="email">Email</label>
			      			<input type="email" id="email" class="form-control" name="email"
                               placeholder="Email" onchange="emailValidation()" required/>
                              <span id="email_err"></span>
                        </div>
		            <div class="mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" id="password" class="form-control" name="password"
                       placeholder="Password" onchange="passwordValidation()" required/>
		              <span id="password_err"></span>
                    </div>
                    <div class="mb-3">
		            	<label class="label" for="conPassword">Confirm Password</label>
		              <input type="password" id="conPassword" class="form-control" name="conPassword" 
                      placeholder="Confirm Password" onchange="conPasswordValidation()" required/>
		              <span id="con_pass_err"></span>
                    </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign up</button>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
<script>
let username=document.getElementById("username");
let email=document.getElementById("email");
let password=document.getElementById("password");
let conPassword=document.getElementById("conPassword");
function usernameValidation(e){
    let username_message=document.getElementById("username_err");
    if(username.value.length>=3){
        username_message.innerText="Valid";
        username_message.style.color="green";
    }
   if(username.value.length<3){
        username_message.innerText="Not Valid";
        username_message.style.color="red"; 
    }
}
function emailValidation(e){
    let email_message=document.getElementById("email_err");
    let email_regx="[a-z0-9]+@[a-z]+.[a-z]{2,3}";
    if(email.value.match(email_regx)){
        email_message.innerText="Valid";
        email_message.style.color="green";
    }
    else{
        email_message.innerText="Not Valid";
        email_message.style.color="red"; 
    }
}
function passwordValidation(e){
    let password_message=document.getElementById("password_err");
    if(password.value.length<8){
        password_message.innerText="Not Valid";
        password_message.style.color="red";
    }
    else{ 
        password_message.innerText="Valid";
        password_message.style.color="green"; 
    }
}
function conPasswordValidation(e){
    let conPassword_message=document.getElementById("con_pass_err");
    if(conPassword.value!=password.value){
        conPassword_message.innerText="Not Valid";
        conPassword_message.style.color="red";
    }
    else{
        conPassword_message.innerText="Valid";
        conPassword_message.style.color="green"; 
    }
}

</script>

	</body>
</html>
