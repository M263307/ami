
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AMI</title>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
  
  <style>
	h2, td, th{
		text-align: center;
	}
	th{
		background-color: #D3D1D1;
	}
	.form-group{
		margin-bottom: 0px;
	}
	
	.btn{
		display: block;
		width:100%;
		float:right;
	}
	tr:nth-child(odd) {background-color: #f2f2f2;}
	
	.center {
    margin: auto;
    width: 60%;
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}

	.hideform {
    display: none;
	}

  </style>
  </head>
	<h2>Customer Details</h2><br><br>
   <body>	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" >
				
			<div id="treeview" >
			<script >
			var selected_customer="none";
				$(document).ready(function(){ 
					$.ajax({	
					  url: "json_for_treeview.php",
					  type: "POST", 
					  dataType: "json",       
					  success: function(data)  
					  {
						$('#treeview').treeview({data:data});
					  }   
					});				
					
					  treeview.addEventListener('click', event => { 
					  selected_customer= event.target.textContent;
					  console.log(selected_customer);
					  ChangeDetails(selected_customer);
					  
					  <?php

								include('database_connection.php');

								$sql="SELECT * FROM customers WHERE visit='Yes'";
								$data=mysqli_query($con,$sql);

								$record=mysqli_fetch_assoc($data);
								
								

								?>
					});
				});
				
				function ChangeDetails(selected_customer) {
					var method="submit";
					var selected_customer= ({data:selected_customer});
					
					$.ajax({
						
						cache:false,
						url:"ChangeDetails_cust.php",
						type:"post",
						dataType: "text",
						data: selected_customer,
						success: function(phpresponse){
							//alert(phpresponse);
						}
					});
					$("#DisplayCustomerDetails").load(" #DisplayCustomerDetails > *");
					$("#DisplayAddress").load(" #DisplayAddress > *");
					$("#form_section").load(" #form_section > *");
					//$("#plant_table").load(" #plant_table > *");
					//$("#AddPlantButton").load(" #AddPlantButton > *");
					$(DisplayCustomerDetails).load(" #DisplayCustomerDetails > *");

				}
				</script>
				
			</div>
				
			</div>
		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" id="form_section">
			

		<form >
		
					<div class="form-group">
						<div class="row">
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="Button">
								<button class="btn" style="width:full;" onclick="AddCustomerButton();return false;" >Add Customer</button><br><br>
							</div>
							<div  class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="AddButton" style="display:none;">
								<button type="submit" class="btn" style="width:full;" id="AddButton">Add</button><br><br>
							</div>
						<script>
						$(function() {
						$("#AddButton").click(function() {
							  	  var customername = $("input#customername").val();
							  	  var customerid = $("input#customerid").val();
							  	  var email = $("input#email").val();
							  	  var phone = $("input#phone").val();
							  	  var address = $("textarea#address").val();

								var dataString= 'id='+customerid+ '&name=' +customername+ '&email=' +email+ '&phone=' +phone+ '&address=' +address;
								$.ajax({
								type: "POST",
								url: "AddCustomer.php",
								data: dataString,
								success: function(res) {
								  //alert(res);
								}
							  });
						  
						});
						  return false;
						  
						});
						</script>
						</div>	
						<div class="row">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding-right:0px;">
								<p style="height:26px; font-size:13px;"><b>Customer Name:</b></p><br>
								<p style="height:26px;"><b>Customer Id:</b></p><br>
								<p style="height:26px;"><b>Email:</b></p><br>
								<p style="height:26px;"><b>Phone:</b></p><br>
							</div>
							<script >
								
								function AddCustomerButton() {
								document.getElementById('AddCustomerFields').style.display= "block";
								document.getElementById('AddressField').style.display = "block";
								document.getElementById('AddButton').style.display = "block";
								document.getElementById('DisplayCustomerDetails').style.display = "none";
								document.getElementById('DisplayAddress').style.display = "none";
								document.getElementById('Button').style.display = "none";
								}
								
								
							</script>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="AddCustomerFields" style="display:none;">
								<p > <input type="text" name="customername" id="customername"></p><br>
								<p ><input type="text" name="customerid" id="customerid" ></p><br>
								<p ><input type="text" name="email"id="email" ></p><br>
								<p ><input type="text" name="phone" id="phone" ></p><br>
							</div>
							
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"  id="DisplayCustomerDetails" >
								<p style="height:26px; "><?php echo $record['name'] ?></p><br>
								<p style="height:26px;"><?php echo $record['id'] ?></p><br>
								<p style="height:26px;"><?php echo $record['email'] ?></p><br>
								<p style="height:26px;"><?php echo $record['phone'] ?></p><br>
							</div>
							<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
								
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="padding-right:0px;">
								<p ><b>Address of HQ:</b></p>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="AddressField"style="display:none;">
								<p ><textarea name="address" rows="4" cols="27" id="address"></textarea></p>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="DisplayAddress"  >
							<p><?php echo $record['street_address_line_1'] ?></p>
							</div>
						</div>
					</div>
        </form>
		<table width=95% height=10% border=1 id="plant_table"> 
		<tr>
		<th>Name</th>
		<th>Address<button  style="float:right;border-radius: 50%;" id="AddPlantButton" ><span>&#9998;</span></button></th>
		</tr>


<?php

		include('database_connection.php');
		
		$sql="SELECT plants.name,plants.street_address_line_1 FROM plants,customers WHERE plants.customer_id=customers.id and customers.visit='Yes'";
		$data=mysqli_query($con,$sql);

		
		while($record=mysqli_fetch_assoc($data))
		{ ?>
			<tr>
			<td><?php echo $record['name']; ?></td>
			<td><?php echo $record['street_address_line_1']; ?></td>
			</tr>
		<?php } ?>
		</table>
<?php
		mysqli_close($con);

?>

<div class="center hideform">
    <button id="close" style="float: right;">X</button>
    <form method="post" action="index.php">
        Plant name:<br>
        <input type="text" name="plantname" value="plant name">
        <br><br>
		Customer Id:<br>
        <input type="text" name="customer_id" value="Customer Id">
        <br><br>
        Street Address:<br>
        <input type="text" name="address" value="address">
        <br><br>
		City:<br>
        <input type="text" name="city" value="city">
        <br><br>
		State:<br>
        <input type="text" name="state" value="state">
        <br><br>
		Country:<br>
        <input type="text" name="country" value="country">
        <br><br>
		Postal Code:<br>
        <input type="text" name="postalCode" value="postal code">
        <br><br>
        <input type="submit" value="Add" id="Add"/>
    </form>
</div>

<script>
	$(document).ready(function() {
	$('#AddPlantButton').click( function () {
		//alert("clicked addplant");
    $('.center').show();
    $(this).hide();
	return false;
	
});
});

$(function() {
      $(document).on('click', '#AddPlantButton', function(e) {
            //alert( 'You clicked me' );
			$('.center').show();
			$(this).hide();
			return false;
	
      });
});

$(function() {
      $(document).on('click', '#close', function(e) {
            $('.center').hide();
			$('#AddPlantButton').show();
			return false;
      });
});



$(document).ready(function() {
$('#close').click( function () {
    $('.center').hide();
    $('#AddPlantButton').show();
	return false;
});
});

$(document).ready(function() {
$('#Add').click(function() {
	<?php

							include('database_connection.php');
							if (isset($_POST['plantname'])) 
							{
								$name= $_POST['plantname'];
							}
							if (isset($_POST['customer_id'])) 
							{
								$customer_id= $_POST['customer_id'];
							}
							if (isset($_POST['address'])) 
							{
								$address= $_POST['address'];
							}
							if (isset($_POST['city'])) 
							{
								$city= $_POST['city'];
							}
							if (isset($_POST['state'])) 
							{
								$state= $_POST['state'];
							}
							if (isset($_POST['country'])) 
							{
								$country= $_POST['country'];
							}
							if (isset($_POST['postalCode'])) 
							{
								$postalcode= $_POST['postalCode'];
						
															
							$sql_add_plant= "INSERT INTO plants(name,street_address_line_1,city,state,country,postal_code,customer_id) 
											VALUES('$name','$address','$city','$state','$country','$postalcode','$customer_id')";
							mysqli_query($con,$sql_add_plant);

							}
?>
					
window.location.reload();
});
});
</script>
		
		</div>
	</div>
	</div>

	</body>
<footer style="height:30px;">
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script></footer>
</html>

