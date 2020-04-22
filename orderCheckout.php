<?php
$title="checkout";
include "navigation.php";
include "vendor/autoload.php";
require_once('vendor/stripe/stripe-php/init.php');

if(isset($_GET["action"])){
    if($_GET["action"]=="Purchase"){
        if(isset($_GET["id"])){
            $query= 'SELECT * from vacationpack where pk_id='.$_GET["id"];
            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    $packageId=$row["pk_id"];
                    $packageName=$row["pk_title"];
                    $packagePrice=$row["pk_price"];
                    $packageDest=$row["pk_destination"];
                    $packageImage=$row["pk_image"];
     }
 }
 else{
     echo mysqli_error($link);
 }
        }
    }
}
?>


<?php
    //set api key
    $stripe = array(
      "secret_key"      => "sk_test_PoUnwLB4z7Q4djkOb0phK7k800vC91VbhP",
      "publishable_key" => "pk_test_XE3IrfVLlHAryp0NcH3O3fqg00aFBatgag"
    );
    \Stripe\Stripe::setApiKey($stripe['secret_key']);
$statusMsg="";
if(!empty($_POST['stripeToken'])){
    //get token, card and user info from the form
    $token  = $_POST['stripeToken'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_num = $_POST['card_num'];
    $card_cvc = $_POST['cvc'];
    $card_exp_month = $_POST['exp_month'];
    $card_exp_year = $_POST['exp_year'];
    $pkName= $_POST["packageName"];
    $pkPrice = $_POST["packagePrice"];
    $pkId = $_POST["packageId"];
    
    echo $token;
    echo $name;
    echo $email;
    echo $card_num;
    echo $card_cvc;
    echo $card_exp_month."<br>";
    echo $card_exp_year;
    //include Stripe PHP library
    
    $itemName=$pkName;
    $itemNumber=$pkId;
    $itemPrice=$pkPrice;
    $currency="cad";
    $orderID="abc123";
    
    //add customer to stripe
    //charge a credit or a debit card
       $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source'  => $token
    ));
    echo $customer->id."<br>";
 
    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $itemPrice,
        'currency' => $currency,
        'description' => $itemName,
        'metadata' => array(
            'order_id' => $orderID
        )
    ));
    
    //retrieve charge details
    $chargeJson = $charge->jsonSerialize();

    //item information
    //check whether the charge is successful
    if($chargeJson['amount_refunded'] == 0 && empty($chargeJson
['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
    echo "m heree";
        //order details */
        $amount = $chargeJson['amount'];
        $balance_transaction = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $status = $chargeJson['status'];
        $date = date("2012-02-20");
        
        //insert tansaction data into the database
        echo $amount;
        echo $balance_transaction;
        echo $currency;
        echo $status;
        echo $date;

        $sql = 
"INSERT INTO orders(name,email,card_num,card_cvc,card_exp_month,card_exp_year,
item_name,item_number,item_price,item_price_currency,paid_amount,
paid_amount_currency,txn_id,payment_status,created,modified) VALUES
('".$name."','".$email."','".$card_num."','".$card_cvc."','".$card_exp_month."',
'".$card_exp_year."','".$itemName."','".$itemNumber."','".$itemPrice."','".$currency."',
'".$amount."','".$currency."','".$balance_transaction."'
,'".$status."','".$date."','".$date."')";
    $row=@mysqli_query($link,$sql);
    $last_insert_id = $link->insert_id;

            if ($row){
                echo '<p></p>';
            }
        else{
            $output= mysqli_error($link);
        }
        
        //if order inserted successfully
        if($last_insert_id && $status == 'succeeded'){
            $statusMsg = "<h2>The transaction was successful.</h2>";
            header("Location: index.php?message=successfull");

//<h4>Order ID: {$last_insert_id}</h4>";
        }else{
            $statusMsg = "Transaction has been failed";
        }
    }else{
        $statusMsg = "Transaction has been failed";
    }
}else{
    
}

//show success or error message
echo $statusMsg;
?>

<script>
Stripe.setPublishableKey('pk_test_XE3IrfVLlHAryp0NcH3O3fqg00aFBatgag');

function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        $('#payBtn').removeAttr("disabled");
        //display the errors on the form
        $(".payment-errors").html(response.error.message);
    } else {
        var form$ = $("#paymentFrm");
        //get token id
        var token = response['id'];
        //insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" 
+ token + "' />");
        //submit form to the server
        form$.get(0).submit();
    }
}
$(document).ready(function() {
    //on form submit
    $("#paymentFrm").submit(function(event) {
        //disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");
        
        //create single-use token to charge the user
        Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
        
        //submit from callback
        return false;
    });
});
</script>
<script>
function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	console.log(rowCount);
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[1];
		console.log(chkbox);
		console.log(chkbox.checked);
		if(null != chkbox && true == chkbox.checked) {
			if(rowCount <= 1) {               // limit the user from removing all the fields
				alert("Cannot Remove all the Passenger.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}

function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 5){                            // limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i <colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum Passenger per ticket is 5");
			   
	}
}
</script>
<section>


<div class=container><!-- display errors returned by createToken -->
<span class="payment-errors"></span>

<!-- stripe payment form -->
<form action="orderCheckout.php" method="POST" id="paymentFrm">
    <p>
        <label>Name</label>
        <input type="text" class="form-control" name="name" size="50" required/>
    </p>
    <p>
        <label>Email</label>
        <input type="text" class="form-control" name="email" size="50" required />
    </p>
    <p>
        <label>Card Number</label>
        <input type="text" name="card_num" class="card-number form-control" size="20" autocomplete="off" required  />
    </p>
    <p>
        <label>CVC</label>
        <input type="text" name="cvc" size="4" class="card-cvc form-control" autocomplete="off" required />
    </p>
    <p>
        <label>Expiration (MM/YYYY)</label>
        <input type="text" name="exp_month" size="2" class="card-expiry-month" required/>
        <span> / </span>
        <input type="text" name="exp_year" size="4" class="card-expiry-year" required/>
    </p>
    <input type="hidden" name="packageName" value="<?php echo $packageName ?>">
    <input type="hidden" name="packagePrice" value=<?php echo $packagePrice ?> >
    <input type="hidden" name="packageId" value =<?php echo $packageId ?> >
<div class="contain-wrap">

    <?php 
    $BX_NAME=[];
if(isset($_POST)==true && empty($_POST)==false){ 
	$chkbox = $_POST['chk'];                              // array
	$bus = $_POST['bus'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$mob = $_POST['mob'];
	$type = $_POST['type'];
	$from = $_POST['from'];
	$to=$_POST['to'];
	$root=$_POST['root'];
	$BX_NAME=$_POST['BX_NAME'];        // array
	$BX_age=$_POST['BX_age'];	   // array		
	$BX_gender=$_POST['BX_gender'];    // array
	$BX_birth=$_POST['BX_birth'];	   // array
}				
if(isset($_GET["action"])){
    if($_GET["action"]=="Purchase"){
        if(isset($_GET["id"])){
            $query= 'SELECT * from vacationpack where pk_id='.$_GET["id"];
            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
					?>
           <div class="row-product">
			<img  class ="rounded-circle" width= 200 src="<?php echo $row["pk_image"];?>" alt=""><br>
			<h4 class = "name"> <?php //echo $row["pk_title"];
                echo $packageName ?></h4>
			<p><?php echo $row['pk_destination']?></p>
			<h4>$ <?php echo $row["pk_price"]; ?></h4>
			
		</div>
     <?php
     }
 }
 else{
     echo mysqli_error($link);
 }
        }
    }
}
?>
<div class="add-pass">  
<div> 
  <input type="button" class="btn btn-primary" value="Add Passenger" onClick="addRow('dataTable')" /> 
  <input type="button" value="Remove Passenger" class="btn btn-primary" onClick="deleteRow('dataTable')" /> 
  <p>(All acions apply only to entries with check marked check boxes only.)</p>
</div>
				
<table id="dataTable" class="form">
 <tbody>
  <tr>
	<p>
	<td >
		<input type="checkbox" name="chk[]" />
	</td>
	<td>
	<label>Name</label>
	<input type="text" class="form-control" name="BX_NAME[]" required>
	</td>
	<td>
	<label for="BX_age">Age</label>
	<input type="text" class="small form-control"  name="BX_age[]" required>
	</td>
	<td>
	<label for="BX_gender">Gender</label>
	<select id="BX_gender" class=form-control name="BX_gender" required>
		<option>....</option>
		<option>Male</option>
		<option>Female</option>
	</select>
	</td>
	<td>
	<label for="BX_birth">Berth Pre</label>
	<select id="BX_birth" class="form-control" name="BX_birth"required>
		<option>....</option>
		<option>Window</option>
		<option>No Choice</option>
	</select>
	</td>
	</p>
  </tr>
 </tbody>
</table>
</div>
</div>
    
    <button type="submit" id="payBtn" class="btn btn-primary">Submit Payment</button>
</form>

<?php 
    foreach($BX_NAME as $a => $b){ 
    ?>
	<tr>
	<p>
		<td>
			<?php echo $a+1; ?>
		</td>
		<td>
			<label>Name</label>
			<input type="text" readonly="readonly" class="form-control" name="BX_NAME[$a]" value="<?php echo $BX_NAME[$a]; ?>">
		</td>
		<td>
			<label for="BX_age">Age</label>
			<input type="text" readonly="readonly" class="small"  class="form-control" name="BX_age[]" value="<?php echo $BX_age[$a]; ?>">
		</td>
		<td>
			<label for="BX_gender">Gender</label>
			<input type="text" readonly="readonly" name="BX_gender[]" class="form-control" value="<?php echo $BX_gender[$a]; ?>">
		</td>
		<td>
			<label for="BX_birth">Berth Pre</label>
			<input type="text" readonly="readonly" name="BX_birth[]" class="form-control" value="<?php echo $BX_birth[$a]; ?>">
		</td>
	</p>
	</tr>
<?php } ?>

</div>
</section>