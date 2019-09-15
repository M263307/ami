
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
	
	.error_form{
		color:red;
	}
  </style>
  </head>
	<h2>Customer Details</h2><br><br>
   <body>	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" id="tree_view">
				
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
							<span class="error_form" id="error_message"></span>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="Button">
								<button class="btn" style="width:full;" onclick="AddCustomerButton();return false;" >Add Customer</button><br><br>
							</div>
							<div  class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="AddButton" style="display:none;">
								<button type="submit" class="btn" style="width:full;" id="AddButton" >Add</button><br><br>
							</div>
						<script>
						$(function() {
						//$(document).on("click", "#AddButton", function (event)
						$("#AddButton").click(function(event) 
						{
							event.preventDefault();
									
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
								  //alert("Customer Added Successfully"+res);

								}
							  }).done(function(result){
								 $("#error_message").html(result); 
								 $("#error_message").show(); 
								 
								 if(result=="Submitted"){
									 CustomerAdded();
								 }
							  })
						  
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
								document.getElementById('plant_table').style.display = "none";
								}
								
								function CustomerAdded() {
									document.getElementById('plant_table').style.display = "block";
									$("#DisplayCustomerDetails").load(" #DisplayCustomerDetails > *");									
									$("#form_section").load(" #form_section > *");									
									//$("#tree_view").load(" #tree_view > *");									
								}
								
								$(function() {
									
									$("#error_message").hide();
									
									var error_custname= false;
							
									$("#customername").focusout(function(){
										//Checking if field is empty
										var length = $("#customername").val().length;
										if(length < 1){
											$("#error_message").html("Customer Name field cannot be empty");
											$("#error_message").show();
											error_custname = true;
										}
										else{
											$("#error_message").hide();
										}
										
										});
										
										$("#customerid").focusout(function(){
										//Checking if field is empty
										var length = $("#customerid").val().length;
										if(length < 1){
											$("#error_message").html("Customer ID field cannot be empty");
											$("#error_message").show();
											error_custname = true;
										}
										else{
											$("#error_message").hide();
										}
										});
										
										$("#email").focusout(function(){
										//Checking valid email
										var email = $("#email").val();
										
										if(IsEmail(email) == false){
											$("#error_message").html("Enter valid email address");
											$("#error_message").show();
											error_custname = true;
										}
										else{
											$("#error_message").hide();
										}
										});
										
										$("#phone").focusout(function(){
										//Checking valid phone
										var phone = $("#phone").val();
										
										if(IsDigit(phone) == false){
											$("#error_message").html("Enter valid phone number");
											$("#error_message").show();
											error_custname = true;
										}
										else{
											$("#error_message").hide();
										}
										});
								
								
								});
								
								function IsEmail(email) {
								  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
								  if(!regex.test(email)) {
									return false;
								  }else{
									return true;
								  }
								}
								
								function IsDigit(phone) {
								  var regex = /^\d{10}$/;
								  if(!regex.test(phone)) {
									return false;
								  }else{
									return true;
								  }
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
		<th>Address<button  style="float:right;border-radius: 50%;" id="AddPlantButton" data-toggle="modal" data-target="#PlantFormModal"><span>&#9998;</span></button></th>
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

<div id="PlantFormModal" class="modal fade in" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
				<h4 class="modal-title">Add Plants</h4>			
			</div>
			<div class="modal-body">
			<span  class="error_form" id="error_message_for_plants"></span>	
			<form method="post" action="index.php">
				Plant name:<br>
				<input type="text" name="plantname" id="plantname" value="plant name">
				<br><br>
				Street Address:<br>
				<input type="text" name="address" id="address" value="address">
				<br><br>
				City:<br>
				<input type="text" name="city" id="city" value="city">
				<br><br>
				State:<br>
				<input type="text" name="state" id="state" value="state">
				<br><br>
				Country:<br>
				<input type="text" name="country" id="country" value="country">
				<br><br>
				Postal Code:<br>
				<input type="text" name="postalCode" id="postalCode" value="postal code">
				<br><br>
				<input type="submit" value="Add" id="Add"/>	
			</form>	
			</div>
		</div>
	</div>
</div>



<script>

$(document).ready(function() {
$('#Add').click(function() {
	<?php

							include('database_connection.php');
							if (isset($_POST['plantname'])) 
							{
								$name= $_POST['plantname'];
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
							SELECT '$name','$address','$city','$state','$country','$postalcode', id FROM customers WHERE visit='Yes' ";
							mysqli_query($con,$sql_add_plant);
							
							
							$sql_treeview_add_plant="INSERT INTO treeview(name,parent_id) SELECT '$name' , id FROM treeview WHERE name IN (SELECT name FROM customers WHERE visit = 'Yes') ";
							mysqli_query($con,$sql_treeview_add_plant);
							
}
?>
					
window.location.reload();
});
});


$(function() {
				$("#error_message_for_plants").hide();
				
		
				$("#plantname").focusout(function(){
					//Checking if field is empty
					var length = $("#plantname").val().length;
					if(length < 1){
						$(error_message_for_plants).html("Plant name field cannot be empty");
						$("#error_message_for_plants").show();
						error_custname = true;
					}
					else{
						$("#error_message_for_plants").hide();
					}
					
					});
				$("#address").focusout(function(){
					//Checking if field is empty
					var length = $("#address").val().length;
					if(length < 1){
						$(error_message_for_plants).html("Please enter all fields");
						$("#error_message_for_plants").show();
						error_custname = true;}
					else{$("#error_message_for_plants").hide();}
					});	
				$("#address").focusout(function(){
					//Checking if field is empty
					var length = $("#address").val().length;
					if(length < 1){
						$(error_message_for_plants).html("Please enter all fields");
						$("#error_message_for_plants").show();
						error_custname = true;}
					else{$("#error_message_for_plants").hide();}
					});	
				$("#city").focusout(function(){
					//Checking if field is empty
					var length = $("#city").val().length;
					if(length < 1){
						$(error_message_for_plants).html("Please enter all fields");
						$("#error_message_for_plants").show();
						error_custname = true;}
					else{$("#error_message_for_plants").hide();}
					});	
				$("#country").focusout(function(){
					//Checking if field is empty
					var length = $("#country").val().length;
					if(length < 1){
						$(error_message_for_plants).html("Please enter all fields");
						$("#error_message_for_plants").show();
						error_custname = true;}
					else{$("#error_message_for_plants").hide();}
					});		
				$("#postalCode").focusout(function(){
					//Checking if field is empty
					var length = $("#postalCode").val().length;
					if(length < 1){
						$(error_message_for_plants).html("Please enter all fields");
						$("#error_message_for_plants").show();
						error_custname = true;}
					else{$("#error_message_for_plants").hide();}
					});		
				$("#state").focusout(function(){
					//Checking if field is empty
					var length = $("#state").val().length;
					if(length < 1){
						$(error_message_for_plants).html("Please enter all fields");
						$("#error_message_for_plants").show();
						error_custname = true;}
					else{$("#error_message_for_plants").hide();}
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

