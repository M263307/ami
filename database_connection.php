<?php

								$con=mysqli_connect("localhost","root","");
								if(!$con)
									die("Cannot Connect" . mysql_error());

								mysqli_select_db($con,'ami');
								
								
?>