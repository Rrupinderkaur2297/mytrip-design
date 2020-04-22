<?php
include "navigation.php";
$pk_image = $pkdestination= $pkregion = $pkdescription= $pkprice =" ";
$pk_image_err= $pkdestination_err = $pkregion_err = $pkdescription_err = $pkprice_err ="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["pkdestination"]))){

        $pkdestination_err = "Please enter a pkdestination.";
    }
    else{             $pkdestination = trim($_POST["pkdestination"]);
    }
     if(empty(trim($_POST["pkregion"]))){
        $pkregion_err = "Please enter a pkregion.";
      }  else{
        $pkregion = trim($_POST["pkregion"]);
    }

    // Validate confirm pkregion
    if(empty(trim($_POST["pkdescription"]))){
        $pkdescription_err = "Please confirm pkregion.";
    } else{
        $pkdescription = trim($_POST["pkdescription"]);
      }

    if(empty(trim($_POST["pk_image"]))){
        $name_err = "Please enter a image string.";
    }
    else{
        $pk_image=trim($_POST["pk_image"]);
    }
    if(empty(trim($_POST["pkprice"]))){
        $pkprice_err = "Please enter a price";
    }
    else{
        $pkprice=$_POST["pkprice"];
    }

    if(empty($pkdestination_err) && empty($pkregion_err) && empty($pkdescription_err)){
        $sql = "INSERT INTO vacationpack(pk_id,pk_image,pk_destination,pk_region,pk_description,pk_price)
        VALUES (DEFAULT,'$pk_image','$pkdestination','$pkregion','$pkdescription',$pkprice);";
        $row=@mysqli_query($link,$sql);
            if ($row){
                echo '<p> Package is created</p>';
            }
        else{
            echo mysqli_error($link);
        }

    }

    // Close connection
    mysqli_close($link);
}

?>
        <div class="packageBox container">
        <h1 class="header_main" >Create New Package</h1>
        <form class="pack_form" method="post" action=<?php $_SERVER['PHP_SELF']?>>

          <label for="pk_image">Pakage image: </label>
              <input type="text" name="pk_image" value = '<?php if(isset($_POST['pk_image'])) echo $_POST['pk_image']; ?>'><br>
              <div class="form-group <?php echo (!empty($pkdestination_err)) ? 'has-error' : ''; ?>">
                  <label for=pkdestination>Destination</label>
                  <input type="text" name="pkdestination" class="form-control" value="<?php if(isset($_POST['pkdestination'])) echo $_POST['pkdestination']; ?>">
                  <span class="help-block"><?php echo $pkdestination_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($pkregion_err)) ? 'has-error' : ''; ?>">
                  <label>Region</label>
                  <input type="text" name="pkregion" class="form-control">
                  <span class="help-block"><?php echo $pkregion_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($pkdescription_err)) ? 'has-error' : ''; ?>">
                  <label>Package Description</label>
                  <input type="text" name="pkdescription" class="form-control">
                  <span class="help-block"><?php echo $pkdescription_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($pkprice_err)) ? 'has-error' : ''; ?>">
                  <label>Package price($)</label>
                  <input type="text" name="pkprice" class="form-control">
                  <span class="help-block"><?php echo $pkprice_err; ?></span>
              </div>
              <input class="btn btn-success" type='submit' name='submit' value='Create'>
    </form>

    </div>

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
