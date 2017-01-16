<?php
	# Stop Hacking attempt
	if(!defined('__APP__')) {
		die("Hacking attempt");
	}

print '
<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">';
				if (isset($_SESSION['message'])) {
						print $_SESSION['message'];
						unset($_SESSION['message']);
					}
					print '
					<form action="trigger.php" name="myForm" id="myForm" method="POST">
					<input type="hidden" id="_action_" name="_action_" value="sign_up">
						<section>
							<br>
							<br>
							<h2>Prijava u sustav</h2>
							<h6>Sva polja su obavezna za popunjavanje!</h6> 
								<div class="row uniform 50%">
									<div class="6u 12u$(4)">
										<label for="username">Korisničko ime:*</label>
										<input type="text" id="username" name="username" value="" pattern=".{5,15}" required>
										<smal>
									</div>

									<div class="6u 12u$(4)">
										<label for="password">Lozinka:*</label>
										<input type="password" id="password" name="password" value="" pattern=".{4,}" required>
									</div>	

									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Prijava" class="special" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</div>
								</div>
								<br>
						</section> 
					</form>
				</div>
			</section>';

?>
