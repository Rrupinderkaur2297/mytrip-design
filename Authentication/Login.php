<?php
$title="Login";
include "../navigation.php";

if(isset($_SESSION["Loggedin"]) && $_SESSION["loggedin"]==true){
    header("location: welcome.php");
    exit;
}



$username = $password = "";
$err=$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    }
    else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

     if(empty($username_err) && empty($password_err)){
         $sql = "SELECT id, username,password FROM users WHERE username='$username'";
           $r=@mysqli_query($link,$sql);
         if($r){
             while($row = mysqli_fetch_array($r)){
             if (password_verify($password,$row["password"])){
                 session_start();
                 $_SESSION["loggedin"]=true;
                 $_SESSION["id"]=$row["id"];
                 $_SESSION["username"]= $row["username"];
                 $_SESSION["role"]= $row["role"];
                  header("location:".BASEURL."/index.php");
             }
             else{
                 $password_err= "The password you entered was not valid";
             }
             }
         }

         else{
             $username_err="No account found with that username.";
         }
}
    else{
        $err="Username or Password is missing";
    }
    mysqli_close($link);
}

?>
<section>
<div class="loginbox">
    <div class="login-wrapper">
        <h1 class="header_main" >Login Here</h1>
        <form  method="post" action=<?php $_SERVER['PHP_SELF']?>>
            <div class="form-group">
                 <?php if($username_err!=" "){?>
            <div style="color:red;"> <?php echo $err?> </div>
            <?php }?>
                <label for="username">Username:</label>
                <input class="login-user form-control" type="text" name="username" placeholder="Enter Username">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for='password'>Password</label>
                <input class="login-pass form-control" type='password' name='password' placeholder="Enter Password" >
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="check1">
                <label class="form-check-label" for="check1">Remember me</label>
            </div>
             <input type='submit' name='submit' class="btn btn-primary" value='submit'>
             <p>Don't have an account-><a href="SignUp.php">Register now </a></p>

        </form>
</div>
    </div>
</section>


    <footer class="footer">
			<div class="container">
				<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_part">
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="contact_us">
							<h4>Contact Us</h4>
							<div class="contact_us_menu">
								<ul>
                                    <li><i class="fa fa-envelope-open" aria-hidden="true"></i><span>webdesigners@gmail.com</span></li>
									<li><i class="fa fa-mobile" aria-hidden="true"></i><span>235-562-2563</span></li>

									<li><i class="fa fa-map-pin" aria-hidden="true"></i><span>1235,Street Market Canada Ontario. </span></li>
								</ul>
                                <p>© 2019. All rights reserved. </p>
							</div>
						</div>
					</div>

                </div>
            </div><!--footer-->
</footer><!--wrapper-->
</body>

</html>
