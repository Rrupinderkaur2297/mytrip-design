<?php
$title="Sign Up";
include "../navigation.php";

$pname = $username= $password = $confirmPassword= $msg= " ";
$pname_err= $username_err = $password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){

        $username_err = "Please enter a username.";
    }
    else{
        $sql = "Select id from users where username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);
             if(mysqli_stmt_execute($stmt)){
                 mysqli_stmt_store_result($stmt);
                 if(mysqli_stmt_num_rows($stmt)==1){
                     $username_err = "This username is already taken";
                 }
                 else{
                     $username = trim($_POST["username"]);
                 }
             }
            else{
                echo "Oops! something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }
     if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty(trim($_POST["pname"]))){
        $name_err = "Please enter a name.";
    }
    else{
        $pname=trim($_POST["pname"]);
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $encrypt_password=password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (id,username, password,name,role) VALUES (DEFAULT,'$username','$encrypt_password','$pname',Default)";
        $row=@mysqli_query($link,$sql);
            if ($row){
                $msg= "User is created";
            }
        else{
            $msg="Try again";
        }

    }

    // Close connection
    mysqli_close($link);
}

?>
<section>
    
        <div class="loginbox">
            
        <h1 class="text-center" >SIGN UP</h1>
            <?php if($msg!=" "){?>
            <div class="alert alert-primary" style="text-align:center; background-color:#3498db; color:#ecf0f1;"> <?php echo $msg;?> </div>
            <?php }?>
        <form class="reg_form" method="post" action=<?php $_SERVER['PHP_SELF']?>>

          <label for="pname">Name: </label>
              <input type="text" class="form-control" name="pname" value = '<?php if(isset($_POST['pname'])) echo $_POST['pname']; ?>'><br>
              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <label for=username>Username</label>
                  <input type="email" name="username" class="form-control" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                  <span class="help-block"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
                  <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                  <label>Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control">
                  <span class="help-block"><?php echo $confirm_password_err; ?></span>
              </div>
              <input type='submit' name='submit' class="btn btn-primary" value='submit'>
		<p class="message">Already Registered?&nbsp;<a href=<?php echo BASEURL."/Authentication/Login.php"?>>LOGIN</a></p>
    </form>

    </div>
</section>
    <div class="footer">
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

                </div></div><!--footer-->
	</div><!--wrapper-->
</body>
</html>
