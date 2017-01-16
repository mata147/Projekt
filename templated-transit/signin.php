<?php
	# Stop Hacking attempt
	if(!defined('__APP__')) {
		die("Hacking attempt");
	}

	print '
		<!-- Main -->
			<section id="main" class="wrapper">
					<div class="wrapper style2">
						<div class="container">';
							if ($_GET['menu'] == 102) { 
								print '<h2>Uređivanje korisnika</h2>';
								$query  = "SELECT * FROM users";
								$query .= " WHERE user_id='" . $_GET['edit'] . "'";
								$result = @mysqli_query($MySQL, $query);
								$row = @mysqli_fetch_array($result);
							}
							else { print '<h2>Registracijska forma</h2>
										  <h6>Polja sa * su obavezna za popunjavanje!</h6>'; }
							
							print '
								<form action="trigger.php" name="myForm" id="myForm" method="POST" enctype="multipart/form-data">';
								if ($_GET['menu'] == 102) { 
									print '<input type="hidden" id="_action_" name="_action_" value="edit_user">
									<input type="hidden" id="user_id" name="user_id" value="' . $_GET['edit'] . '">';
								} else {
									print '<input type="hidden" id="_action_" name="_action_" value="registration">';
								}
									print '
									<div class="row uniform 50%">
									<div class="6u 12u$(4)">
									<label for="fname">Ime:*</label>
									<input type="text" id="fname" name="fname" '; if ($_GET['menu'] == 102) { print 'value="' . $row['user_firstname'] . '"'; } else { print 'value=""'; } print ' required>
									</div>
									<div class="6u 12u$(4)">
									<label for="lname">Prezime:*</label>
									<input type="text" id="lname" name="lname" '; if ($_GET['menu'] == 102) { print 'value="' . $row['user_lastname'] . '"'; } else { print 'value=""'; } print ' required>
									</div>
									</div>
									<div class="row uniform 50%">
									<div class="6u 12u$(4)">
									<label for="username">Korisničko ime:*</label>
									<input type="text" id="username" name="username" '; if ($_GET['menu'] == 102) { print 'value="' . $row['user_name'] . '"'; } else { print 'value=""'; } print ' pattern=".{5,15}" required>
									<small>Korisničko ime mora imati minimalno 5, a maksimalno 15 znakova</small>
									</div>';
									if ($_GET['menu'] <> 102) {								
									print '
										<div class="6u 12u$(4)">
										<label for="password">Lozinka:*</label>
										<input type="password" id="password" name="password" '; if ($_GET['menu'] == 102) { print 'value="' . $row['user_pass'] . '"'; } else { print 'value=""'; } print ' pattern=".{4,}" required>
										<small>Lozinka ime mora imati minimalno 4 znaka</small>
										</div>	
										</div>										
										<div class="12u$">
										<label for="profile">Slika:</label>
										<input type="file" id="profile" name="profile" value="">
										</div>';
									
									}
									print '
									<div class="row uniform 50%">
									<div class="6u 12u$(4)">
									<label for="email">Email:*</label>
									<input type="email" id="email" name="email" '; if ($_GET['menu'] == 102) { print 'value="' . $row['user_email'] . '"'; } else { print 'value=""'; } print ' required>
									</div>
									<div class="6u 12u$(4)">
									<label for="country">Država:</label>
									<div class="select-wrapper">
									<select name="country" id="country">
										<option value="">Odaberi državu</option>';
										$_query  = "SELECT * FROM countries";
										$_result = @mysqli_query($MySQL, $_query);
										while($_row = @mysqli_fetch_array($_result)) {
											print '<option value="' . $_row['country_code'] . '"';
											if ($_GET['menu'] == 102) {
												if ($row['user_country'] == $_row['country_code']) { print " selected"; }
											}
											print '>' . $_row['country_name'] . '</option>';
										}
										print '
									</select>
									</div>
									</div>';
									if ($_GET['menu'] == 102) {
									if($_SESSION['user']['user_pos'] == 1 or  $_SESSION['user']['user_pos'] == 2) { print '
									<div class="6u 12u$(4)">
									<label for="state">Status pristupa:</label>
									<div class="select-wrapper">
									<select name="state" id="state">';

										$_query  = "SELECT user_archive FROM users where user_id='" . $row['user_id'] . "'";
										$_result = @mysqli_query($MySQL, $_query);
										while($_row = @mysqli_fetch_array($_result)) {
											if($_row['user_archive']=="Y") { print '<option value="Y">Odobren</option>'; }
											else {print '<option value="N">Zabranjen</option>';}
											if ($_GET['menu'] == 102) {
											if($_row['user_archive']=="Y") { print '<option value="N">Zabranjen</option>'; }
											else {print '<option value="Y">Odobren</option>';}
											}
											print '>' . $_row['user_archive'] . '</option>';
										}
										
									print '	
									</select>
									</div>
									</div>
									</div>';
									}
									}
									print'
									<div>
									<br>
									</div>
									<div class="12u$">
									<ul class="actions">
											<li><input type="submit" value="Pošalji" class="special" /></li>
											<li><input type="reset" value="Reset" /></li>
									</ul>
									</div>
								</form>
						</div>';
				print '
					</div>
			</section>';
?>
