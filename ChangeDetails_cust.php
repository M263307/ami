<?php

					include('database_connection.php');
					
						$parent_id=1;
					$data=$_POST['data'];
					$query = mysqli_query($con,"SELECT id FROM customers WHERE name='$data'");
					if($query!=false){
					if(mysqli_num_rows($query) > 0 )
					{
						$sql1="UPDATE customers SET visit='No' WHERE visit='Yes' and name <> '$data'";
						mysqli_query($con,$sql1);
						
						$sql2="UPDATE customers SET visit='Yes' WHERE name='".$data."'";
						mysqli_query($con,$sql2);
					}
					}
				
?>

