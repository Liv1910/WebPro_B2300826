<?php
                                        include('db.php');
										$fk = "SET FOREIGN_KEY_CHECKS = 0;";
										if(mysqli_query($con,$fk)){
                                        $sql ="TRUNCATE TABLE items" ;
												if(mysqli_query($con,$sql)){
                                                    echo "<script>alert('Dataset has been Sucessfully Deleted.');window.location.href = 'http://localhost/Test/staff/inventory.php';</script>";
									    		}
												else {
												echo '<script>alert("An Unexpected Error has Occured") </script>' ;
                                           		echo "Error : $sql<br>".
                                            	mysqli_error($con) ; 
										}
										}
										else{
										echo '<script>alert(An Unexpected Error has Occured") </script>' ;
										echo "Error : $sql<br>".
										mysqli_error($con) ; 
										}
										$fk = "SET FOREIGN_KEY_CHECKS = 1;";
										if(mysqli_query($con,$fk)){
										}
										else{
											echo '<script>alert("An Unexpected Error has Occured") </script>' ;
											echo "Error : $sql<br>".
											mysqli_error($con) ; 
										}
?>