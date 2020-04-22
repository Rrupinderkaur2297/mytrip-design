<?php
require "navigation.php";
require "Authentication/authenticate.php";
?>


<script>
function deleteRow(tableID) {
	console.log(" I am here");
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	console.log(rowCount);
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[1];
		console.log(chkbox);
		console.log(chkbox.checked);
		if(null != chkbox && true == chkbox.checked) {
			console.log( "ethey aajo");
			if(rowCount <= 1) {               // limit the user from removing all the fields
				alert("Cannot Remove all the Passenger.");
				break;
			}
			console.log("I am here");
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
<?php 
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
           <div class="row">
			<form class= "form" method="post" action="checkout.php?action=checkout&id=<?php echo $row["pk_id"]; ?>" >
			<img  class ="rounded-circle" width= 200 src="<?php echo $row["pk_image"];?>" alt="">
			<h4 class = "name"><a href="item.php?id=<?php echo $row["pk_id"]; ?> "> <?php echo $row["pk_title"]; ?></a></h4>
			<p><?php echo $row['pk_destination']?></p>
			<h4>$ <?php echo $row["pk_price"]; ?></h4>
			<input type="hidden" name="hidden_name" value = "<?php echo $row["pk_destination"]; ?>">
			<input type="hidden" name="hidden_price" value = "<?php echo $row["pk_price"]; ?>">
			<input type="submit" class="btn btn-secondary" name ="add_to_cart" value ="Purchase" >
		 </form>
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
<?php foreach($BX_NAME as $a => $b){ ?>
	<tr>
	<p>
		<td>
			<?php echo $a+1; ?>
		</td>
		<td>
			<label>Name</label>
			<input type="text" readonly="readonly" name="BX_NAME[$a]" value="<?php echo $BX_NAME[$a]; ?>">
		</td>
		<td>
			<label for="BX_age">Age</label>
			<input type="text" readonly="readonly" class="small"  name="BX_age[]" value="<?php echo $BX_age[$a]; ?>">
		</td>
		<td>
			<label for="BX_gender">Gender</label>
			<input type="text" readonly="readonly" name="BX_gender[]" value="<?php echo $BX_gender[$a]; ?>">
		</td>
		<td>
			<label for="BX_birth">Berth Pre</label>
			<input type="text" readonly="readonly" name="BX_birth[]" value="<?php echo $BX_birth[$a]; ?>">
		</td>
	</p>
	</tr>
<?php } ?>

<p> 
  <input type="button" value="Add Passenger" onClick="addRow('dataTable')" /> 
  <input type="button" value="Remove Passenger" onClick="deleteRow('dataTable')" /> 
  <p>(All acions apply only to entries with check marked check boxes only.)</p>
</p>
				
<table id="dataTable" class="form">
 <tbody>
  <tr>
	<p>
	<td >
		<input type="checkbox" name="chk[]" />
	</td>
	<td>
	<label>Name</label>
	<input type="text" name="BX_NAME[]">
	</td>
	<td>
	<label for="BX_age">Age</label>
	<input type="text" class="small"  name="BX_age[]">
	</td>
	<td>
	<label for="BX_gender">Gender</label>
	<select id="BX_gender" name="BX_gender">
		<option>....</option>
		<option>Male</option>
		<option>Female</option>
	</select>
	</td>
	<td>
	<label for="BX_birth">Berth Pre</label>
	<select id="BX_birth" name="BX_birth">
		<option>....</option>
		<option>Window</option>
		<option>No Choice</option>
	</select>
	</td>
	</p>
  </tr>
 </tbody>
</table>
</section>