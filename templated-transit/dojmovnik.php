<?php
	# Stop Hacking attempt
	define('__APP__', TRUE);


print '
		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">';
				if (isset($_SESSION['message'])) {
						print $_SESSION['message'];
						unset($_SESSION['message']);
					}
					print '
					<form action="trigger.php" name="dojmovnik_form" id="dojmovnik_form" method="POST">
					<input type="hidden" id="_action_" name="_action_" value="send"> 
						<section>
							<h3>Dojmovnik<hr></h3>
								<div class="row uniform 50%">
									<div class="6u 12u$(4)">
										<label for="firstname">Vaše ime:</label>
										<input type="text" name="firstname" id="firstname" value="" placeholder="Ime" required />
									</div>
									<div class="6u 12u$(4)">
										<label for="lastname">Vaše prezime:</label>
										<input type="text" name="lastname" id="lastname" value="" placeholder="Prezime" required />
									</div>	
									</div>
									<div class="row uniform 50%">
									<div class="6u 12u$(4)">
									<label for="country">Država:</label>
									<div class="select-wrapper">
									<select name="country" id="country">
										<option value="">Odaberi državu</option>';
										$_query  = "SELECT * FROM countries";
										$_result = @mysqli_query($MySQL, $_query);
										while($_row = @mysqli_fetch_array($_result)) {
											print '<option value="' . $_row['country_name'] . '">' . $_row['country_name'] . '</option>';
										}
										print '
									</select>
									</div>
									</div>
									<div class="6u 12u$(4)">
									<label for="city">Grad:</label>
									<div class="select-wrapper">
									<select name="city" id="city">
										<option value="">Odaberi grad</option>';
										$_query  = "SELECT * FROM city";
										$_result = @mysqli_query($MySQL, $_query);
										while($_row = @mysqli_fetch_array($_result)) {
											print '<option value="' . $_row['city_name'] . '">' . $_row['city_name'] . '</option>';
										}
										print '
									</select>
									</div>
									</div>
									</div>
									<div class="6u 12u$(4)">
										<label for="email">E-mail adresa:</label>
										<input type="email" name="email" id="email" value="" placeholder="Email" required />
									</div>
									<div class="4u 12u$(3)">
										<label>Da li želite primati obavijesti ?</label>
									</div>
									<div class="4u 12u$(3)">
										<input type="radio" id="notification-yes" name="notification" value="1" >
										<label for="notification-yes">Da</label>
									</div>
									<div class="4u$ 12u$(3)">
										<input type="radio" id="notification-no" name="notification" value="0" >
										<label for="notification-no">Ne</label>
									</div>
									<div class="12u$">
										<label for="message">Vaša poruka:</label>
										<textarea name="message" id="message" placeholder="Ovdje unesite tekst poruke" rows="6" ></textarea>
									</div>
									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Pošalji" class="special" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</div>
								</div>
						</section> 
					</form>
				</div>
			</section>';
?>