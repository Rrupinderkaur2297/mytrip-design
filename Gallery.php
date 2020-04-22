
<?php
$title= "Packages";
include "navigation.php";

?>
<section class=content-wrapper>
<?php 
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
<script>

$(document).ready(function(){
    
    var packagedata =<?php echo json_encode($JsonData);?>;
    console.log(packagedata);
    var options={
        keys:[{
            name: 'pk_title'
        }]
    };
    var fuse = new Fuse(packagedata,options)
        $('#search_text').on('input', function() {
          var result = fuse.search($(this).val());
            for (var i = 0; i < result.length; i++) {
                $('#result a').remove();
                for (i = 0; i < result.length; i++) {
                    $('#result').append("<a class=link href=view.php?action=view&id="+result[i]['pk_id']+" rel= " + JSON.stringify(result[i]['pk_title']) +"dataurl=" + JSON.stringify(result[i]['pk_title']) + ">" +"<img width=60px src="+result[i]['pk_image']+">"+
(JSON.stringify(result[i]['pk_title'])).replace('"','') + "</a>");
                }
            }
        });

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var acti = 'fetch';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var region = get_filter('region');
        var destination = get_filter('destination');

        $.post("./fetch_data.php",{data:acti,minimum:minimum_price,maximum_price:maximum_price, region:region, destination:destination},function(data,status){
            $('.filter_data').html(data);
          
        });
    }
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        console.log(filter);
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:0,
        max:5000,
        values:[0, 5000],
        step:100,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>

       <div class="col-md-3">                    
       <div class="list-group">
                <div class= "w-100 p-3">
                    <input class="form-control" type = text id="search_text" name="search_text" placeholder="Search Package">
                </div>
                <div id="result">
                </div>
                </div>    
    <div class="list-group">
         <h3>Price</h3>
         <input type="hidden" id="hidden_minimum_price" value="0" />
        <input type="hidden" id="hidden_maximum_price" value="5000" />
        <p id="price_show">0 - 5000</p>
    <div id="price_range"></div>
                
</div>
<div class="list-group">
     <h3>Region</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
     <?php

                    $query = "SELECT DISTINCT(pk_region) FROM vacationpack ORDER BY pk_region DESC";
                    $result = mysqli_query($link,$query);
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector region" value="<?php echo $row['pk_region']; ?>"  > <?php echo $row['pk_region']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

    <div class="list-group">
     <h3>Destination</h3>
                    <?php

                    $query = "SELECT DISTINCT(pk_destination) FROM vacationpack ORDER BY pk_destination DESC";
                    $result = mysqli_query($link,$query);
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector destination" value="<?php echo $row['pk_destination']; ?>" > <?php echo $row['pk_destination']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>
    
        </div>



	<?php
    if(isset($_SESSION["username"])){
	if($_SESSION["username"]=="admin"){
	echo '<div class="create-package">
		<a href= "'.BASEURL.'/create.php">create</a>





        </div>';
}
    }?>

<div class="col-md-6 packages">
             <br />
                <div class="row filter_data">

                </div>
            </div>
        </section>
</BODY>

</HTML>