<?php

require "config/mysqli_connect.php";

if(isset($_POST["data"]))
{
 $query = "
  SELECT * FROM vacationpack WHERE pk_id IS NOT Null
 ";
 if(isset($_POST["search"])){
   $query .= "
 And pk_name Like '%".$_POST["search"]."%'
  ";
 }
 if(isset($_POST["minimum"])&& isset($_POST["maximum_price"]))
 {
   $minimum= $_POST["minimum"];
   $maximum=$_POST["maximum_price"];
   $query .= "
 And pk_price Between ".$minimum." And ".$maximum ;
 }
 if(isset($_POST["region"]))
 {
  $region_filter = implode("','", $_POST["region"]);
  $query .= "
 And pk_region IN('".$region_filter."')
  ";
 }
 if(isset($_POST["destination"]))
 {
  $destination_filter = implode("','", $_POST["destination"]);
  $query .= "
   And pk_destination IN('".$destination_filter."')
  ";
 }

 $result = mysqli_query($link,$query);
 $output = '';
 if($result)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="package">
  <form class= "form" method="post" action="view.php?action=view&id='.$row["pk_id"].'" >
         <img  class ="package-image" width= 200 src="'.$row["pk_image"].'" alt="">
         <h4 class = "package-name"><a href="view.php?action=view&id='. $row["pk_id"].'">'.$row["pk_title"].'</a></h4>
         <p>'.$row["pk_destination"].'</p>
         <h4>$'. $row["pk_price"].'</h4>
         <input type="hidden" name="hidden_name" value = "'.$row["pk_destination"].'">
         <input type="hidden" name="hidden_price" value = "'.$row["pk_price"].'">
         <input type="submit" class="btn btn-secondary" name ="details" value ="View More details" >
         </form>    
        </div>

   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
echo $output;
 }
?>