<?php
$title="Home";
include "navigation.php";
$query= "SELECT * from vacationpack";
$result = mysqli_query($link,$query);
  $JsonData=array();
  if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_array($result)){
          $JsonData[]=$row;
       }
     }
     else{
         echo mysqli_error($link);
                }
?>
<div class="slider">
			<div class="slider-container">
				<div class="slider_main">
                                            <?php 
if (isset($_GET["message"])){
echo "<p style='text-align:center;background-color:#2ecc71;'> Payment is ".$_GET["message"]. ". You will Recieve an email shortly regarding your trip details
    </p>";
}
?>
					<p>Find Your Wave Chasin smile!</p>
					<h1>Beauty, Charm, And Adventure.</h1>
					<div class="find">
						<input type="text" id="index-search" class=index-search>
											<div id=result class="result-search">
					</div>
					</div>

					<div class="features">
						<ul class=featureOne>
							<li>Unlimited meals</li>
							<li>Lowest Price</li>
							<li>Luxuirous Travel</li>
							<li>Executive Member Benifits</li>
							<li>Pack The Best Deals</li>
</ul>
<ul class=featureTwo>
							<li>Live the Adventure</li>
							<li>Romantic Gateways</li>
							<li>Signature Vacation</li>
							<li>Party at Cruise</li>
							<li>Disco Night</li>
</ul>
</div>
					
						<!--<form class="form-container">
									<div class="form-group">
								     	<label for="from" method="GET">Packages</label><br>
								      	<select class="list" name="from" id="from">
										  <?php  
										   /*$query= 'SELECT `pk_region` from vacationpack';
            								$result = mysqli_query($link,$query);
            								if(mysqli_num_rows($result)>0){
                								while($row = mysqli_fetch_array($result)){
													echo "<option value = ".$row['pk_id'].">".$row["pk_region"]."</option>";
												}
											}*/
                    					   ?>
										</select>
								    </div>
								    <div class="form-group">
								     	<label for="Departure">Departure:</label><br>
								      <input type=date name ="departDate">
								    </div>
								    <div class="form-group">
									<label for="return">
								   <input type="date" name="returnDate">
								   </div>
								</div>
									<div class="search_button">
										<a href="#">Search</a>
								</div>
						</form>-->
			</div>
		</div>
										</div><!--slider-->
										<script>
  var packagedata =<?php echo json_encode($JsonData);?>;
    var options={
        keys:[{
            name: 'pk_title'
        }]
    };
    var fuse = new Fuse(packagedata,options)
        $('#index-search').on('input', function() {
			console.log($(this).val());
          var result = fuse.search($(this).val());
            for (var i = 0; i < result.length; i++) {
                $('#result a').remove();
                for (i = 0; i < result.length; i++) {
                    $('#result').append("<a class=link href=view.php?action=view&id="+result[i]['pk_id']+" rel= " + JSON.stringify(result[i]['pk_title']) +
                        "dataurl=" + JSON.stringify(result[i]['pk_title']) + ">" +"<img width=60px src="+result[i]['pk_image']+">"+
                        (JSON.stringify(result[i]['pk_title'])).replace('"','') + "</a>");
                }
            }
        });

</script>
<div class="packages">
<?php $query= "SELECT * from vacationpack";
 $result = mysqli_query($link,$query);
 if(mysqli_num_rows($result)>0){
     while($row = mysqli_fetch_array($result)){
         ?>
           <div class="package">
         <form class= "form" method="post" action="view.php?action=view&id=<?php echo $row["pk_id"]; ?>" >
         <img  class ="package-image" width= 200 src="<?php echo $row["pk_image"];?>" alt="">
         <h4 class = "package-name"><a href="view.php?action=view&id=<?php echo $row["pk_id"]; ?> "> <?php echo $row["pk_title"]; ?></a>,<span> <?php echo $row["pk_destination"]?></Span></h4>
         
         <h4>$<?php echo $row["pk_price"]; ?></h4>
         <input type="hidden" name="hidden_name" value = "<?php echo $row["pk_destination"]; ?>">
         <input type="hidden" name="hidden_price" value = "<?php echo $row["pk_price"]; ?>">
         <input type="submit" class="btn btn-secondary" name ="details" value ="View More details" >
         </form>    </div>
     <?php
     }
 }
 else{
     echo mysqli_error($link);
 }
?>
		<div class="media">
			<div class="container">
				<div class="media_title">
					<h2>WHY My TRIP?</h2>
				</div>
				<div class="col-lg-12 padding_part media_main">

					<div class="col-lg-4 ">
						<div class="media_first">
							<div class="col-lg-5  media_first_left">

								<i class="fa fa-plane" aria-hidden="true"></i>
							</div>
							<div class="col-lg-7 media_first_right">
								<h4>Travel with Confidence.</h4>
								<p>Be served by travel agents that know! 24/7 service just a phone-call away.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 ">
						<div class="media_first">
							<div class="col-lg-5 media_first_left">

								<i class="fa fa-compass" aria-hidden="true"></i>
							</div>
							<div class="col-lg-7 media_first_right">
								<h4>OUR BEST DEALS</h4>
								<p>Prices to worldwide destinations are constantly updated due to our one-of-a-kind enhanced software engine.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 ">
						<div class="media_first">
							<div class="col-lg-5 media_first_left">

								<i class="fa fa-hotel" aria-hidden="true"></i>
							</div>
							<div class="col-lg-7 media_first_right">
								<h4>Leisure Expreience</h4>
								<p>Prices to worldwide destinations are constantly updated due to our one-of-a-kind enhanced software engine.</p>
							</div>
						</div>
					</div>
				</div>
			</div>



		<div class="footer">
			<div class="container">
				<div class=" col-lg-12  padding_part">
					<div class="col-lg-3 ">
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
	</div><!--wrapper-->
    </div>
</body>
</html>
