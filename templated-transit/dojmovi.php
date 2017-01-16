<?php
	# Stop Hacking attempt
	define('__APP__', TRUE);


print '
		<!-- Main -->
			<section id="one" class="wrapper style1">
				<div class="container">';
				if (isset($_SESSION['message'])) { 
						print $_SESSION['message'];
						unset($_SESSION['message']);
					}
					$query  = "SELECT * FROM dojmovnik where state = 1";
									$result = @mysqli_query($MySQL, $query);
									while($row = @mysqli_fetch_array($result)) {
										print '
											<div><p><span class="image left"><img src="images/user1.png" alt="" /></span>' . $row['message'] . ' <br><b> '. $row['first_name'] . ' ' . $row['last_name'] . '</b> - '. $row['city'] . '  ( ' . $row['country'] . ' )<hr> </p></div><br>';
									}
				
print '				
				</div>
			</section>';
?>