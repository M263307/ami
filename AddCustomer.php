<?php
							include('database_connection.php');
							
							$name= $_POST['name'];
							$id= $_POST['id'];
							$email= $_POST['email'];
							$phone= $_POST['phone'];
							$address= $_POST['address'];
							
							$sql_checking_no_duplicate_customerid="SELECT id FROM customers WHERE id= '".$id."'";
							$number_of_id=mysqli_query($con,$sql_checking_no_duplicate_customerid);
							
							$Checkphone= filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT );
							
							$Checkemail= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL );
							
							if (empty($name) || empty($id) || empty($email) || empty($phone) || empty($address)) {
								echo "Please enter all fields";
								exit();
							}
							if($Checkphone==false){
								echo "Invalid Phone";
								exit();	
							}
							
							if($Checkemail==false){
								echo "Invalid email address";
								exit();	
							}
							
							if(mysqli_num_rows($number_of_id) > 0){
								echo "Customer ID already exists";
								exit();
							}
							else{	
							echo "Submitted";
							$sql_add_customer= "INSERT INTO customers(name,id,email,phone,street_address_line_1,visit) VALUES('$name','$id','$email','$phone','$address','Yes')";
							$data=mysqli_query($con,$sql_add_customer);
	
							$sql_add_in_tree="INSERT INTO treeview(name,parent_id) VALUES('$name',1)";
							mysqli_query($con,$sql_add_in_tree);
							
							$sql_Change_View_Status= "UPDATE customers SET visit='No' WHERE visit='Yes' and id <> '".$id."'";
							mysqli_query($con,$sql_Change_View_Status);
							}
							?>