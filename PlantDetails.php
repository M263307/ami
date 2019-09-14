
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
	#AddFormButton{
		float:left !important;
		width:70% !important;
	}
	button{
		float:right;
	}
	tr:nth-child(odd) {background-color: #f2f2f2;}
	th{
		background-color: #D3D1D1;
	}
	#uploadButton{
		float:left;
		margin-left:5%;
	}
	span{
		float:right;
		font-size: 18px;
		margin-right:5%;
	}
  </style>
  </head>
	<h2>Plants Details</h2><br><br>
   <body>
<?php
if (isset($GET['del']))
	if($_GET['del'])
				   {
					DeletePlant($form);

					} 
?>   
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
					$("#plant_table").load(" #plant_table > *");

				}
				</script>
				
			</div>
				
			</div>
		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" id="form_section">
			<?php
			
					
				include('database_Connection.php');
				
				$sql="SELECT * from plants WHERE id='2'";
				$data=mysqli_query($con,$sql);
				$record=mysqli_fetch_assoc($data);
				
				$sql_plants_count="SELECT * from inspections WHERE plant_id = '".$record['id']."' GROUP BY program";
				$count=mysqli_query($con,$sql_plants_count);
				$record_count=mysqli_num_rows($count);
				//number of rows received
				
			?>	
			<div class="row">
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<b>Plants: <?php echo $record['name']?></b>
				</div>
				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
					<b><p>Address: <?php echo $record['street_address_line_1']?></p></b>
				</div>
			</div><br>
			
			<?php
				foreach ($count as $pt){
					echo "<div class=\"row\">
							<div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\">";
					echo "<p>".$pt['program']. "</p>
							</div>";
										
										$sql_within_group="SELECT * from inspections WHERE plant_id = '".$record['id']."' and program='".$pt['program']."'";
										$tableContentForPlants = mysqli_query($con, $sql_within_group);
							
					echo "<div class=\"col-xs-6 col-sm-6 col-md-6 col-lg-6\"></div>";
					echo "<div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\">
							<button id = \"AddFormButton\">Add Form</button>
					      </div><br><br>
						  </div>";
						  
					echo "<table width=95% height=65% border=1>
					<tr>
					<th>FORM TYPE</th>
					<th>TEMPLATE</th>
					</tr>";
						foreach($tableContentForPlants as $content)
					{
						echo "<tr>";
						echo "<td>" . $content['form_type'] . "<button onclick=\"DeleteTemplate(\"".$content['form_type']."\")\" >&#128465;</button></td>";
						echo "<td><button><span id=\"uploadButton\">&#8683;</span></button>" . $content['form_uploaded'] . "</td>";
						echo "</tr>";
					}
					echo "</table><br><br>";
					;	  
				}
				
				function DeletePlant($form){
					 $del="DELETE FROM inspections WHERE form_type='".$form."' ";
					 mysqli_query($con, $del);
				}
				
			?>
		<script>
			function DeleteTemplate(form){
				console.log("gfhgfg");
				 if(confirm("Are you sure you want to delete this form?")==true)
				   window.location="PlantDetails.php?del="+form;
				return false;
			}
		</script>
		</div>
	</div>

	</body>
<footer ></footer>
</html>

