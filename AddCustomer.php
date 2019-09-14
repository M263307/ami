<?php
							include('database_connection.php');
							
							$name= $_POST['name'];
							$id= $_POST['id'];
							$email= $_POST['email'];
							$phone= $_POST['phone'];
							$address= $_POST['address'];
							
							if (empty($name) && empty($id) && empty($email) && empty($phone) && empty($address)) {
								return false;
							}
							$sql_add_customer= "INSERT INTO customers(name,id,email,phone,street_address_line_1) VALUES('$name','$id','$email','$phone','$address')";
							$data=mysqli_query($con,$sql_add_customer);

							$sql_add_in_tree="INSERT INTO treeview(name,parent_id) VALUES('$name',1)";
							mysqli_query($con,$sql_add_in_tree);
							
							?>