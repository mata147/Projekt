<?php
	# Stop Hacking attempt
	if(!defined('__APP__')) {
		die("Hacking attempt");
	}
	print '
		<!-- Main -->
			<section id="main" class="wrapper style2">
				<div class="container">
					<section>';
					$query  = "SELECT * FROM dojmovnik";
					$result = @mysqli_query($MySQL, $query);
					$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
					print'
					<br><h1>Dobrodošao: <img src="userspic/' . $_SESSION['user']['pic'] . '" width="18" alt="' . $_SESSION['user']['name'] . '"></h1><hr>';
					if (isset($_SESSION['message'])) { 
						print $_SESSION['message'];
						unset($_SESSION['message']);
					}
						if ($_GET['menu'] == 110) {
							print '
							<h2>Popis dojmova</h2>
							<table>
							  <thead>
								<tr>';
									if($_SESSION['user']['user_pos'] == 1 or $_SESSION['user']['user_pos'] == 2) print '
									<th width="12"></th>
									<th width="12"></th>
									<th>Ime</th>
									<th>Prezime</th>
									<th>Email</th>
									<th>Grad</th>
									<th>Država</th>
									<th>Status objave</th>';
									
								print'
								</tr>
							  </thead>
							  <tbody>';
									$query  = "SELECT * FROM dojmovnik";
									$result = @mysqli_query($MySQL, $query);
									while($row = @mysqli_fetch_array($result)) {
										print '
									<tr>';	
										if($_SESSION['user']['user_pos'] == 1 or $_SESSION['user']['user_pos']== 2) print '<td><a href="index.php?menu=111&amp;id=' .$row['id']. '"><img src="images/user.png" alt="user"></a></td><td><a href="index.php?menu=113&amp;delete=' .$row['id']. '"><img src="images/delete.png" alt="obriši"></a></td>';
										print'
										<td>' . $row['first_name'] . '</td>
										<td>' . $row['last_name'] . '</td>
										<td>' . $row['email'] . '</td>
										<td>' . $row['city'] . '</td>
										<td>' . $row['country'] . '</td>';
										if($row['state'] == 1) print '<td>Objavljeno</td>';
										else print '<td>Sakriveno</td>';
										print '
									</tr>';
									}
								print '</tbody>							
							</table>
							
							<hr><h2>Popis korisnika za primanje obavijesti</h2>
									<div class="row uniform 50%">
										<div class="6u 12u$(4)">
										<table>
										<thead>
										<tr>
										<th>Red. Br.</th>
										<th>Ime</th>
										<th>Prezime</th>
										<th>Email</th>
										<tbody>
										</tr>';
										$query  = "SELECT * FROM dojmovnik WHERE notification = 1";
										$result = @mysqli_query($MySQL, $query);
										$redbr=1;
										while($row = @mysqli_fetch_array($result)) {
											print '
												<tr>
													<td>' . $redbr . '</td>
													<td>' . $row['first_name'] . '</td>
													<td>' . $row['last_name'] . '</td>
													<td>' . $row['email'] . '</td>
												</tr>';
												$redbr=$redbr+1;
										}
										print '</tbody>
										</table>
										</div>
									</div>';
						}
						#Show user info
						else if ($_GET['menu'] == 111) {
							$query  = "SELECT * FROM dojmovnik";
							$query .= " WHERE id=".$_GET['id'];
							$result = @mysqli_query($MySQL, $query);
							$row = @mysqli_fetch_array($result);
							$broj_dojma= $row['id'];
							print '<h2>Dojam korisnika</h2>.
							<p>
								<form action="trigger.php" name="myForm" id="myForm" method="POST" enctype="multipart/form-data">';
								if ($_GET['menu'] == 111) { 
									print '<input type="hidden" id="_action_" name="_action_" value="change_state">
									<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '">';
								} else {
									print '<input type="hidden" id="_action_" name="_action_" value="change_state">';
								}
									print '
								<b>Broj dojma:</b> ' . $row['id'] . '<br>
								<b>Ime:</b> ' . $row['first_name'] . '<br>
								<b>Prezime:</b> ' . $row['last_name'] . '<br>
								<b>Grad:</b> ' . $row['city'] . '<br>
								<b>Država:</b> ' . $row['country'] . '<br>
								<b>Email:</b> ' . $row['email'] . '<br>
								<b>Datum i vrijeme slanja:</b> ' . $row['date'] . '<br>
								<b>Poruka:</b> ' . $row['message'] . '<br>
								
								<div class="select-wrapper">
									<select name="state" id="state">';

										$_query  = "SELECT state FROM dojmovnik where id='" . $row['id'] . "'";
										$_result = @mysqli_query($MySQL, $_query);
										while($_row = @mysqli_fetch_array($_result)) {
											if($_row['state']=="1") { print '<option value="1">Objavljeno</option>'; }
											else {print '<option value="0">Sakriveno</option>';}
											if ($_GET['menu'] == 111) {
											if($_row['state']=="1") { print '<option value="0">Sakriveno</option>'; }
											else {print '<option value="1">Objavljeno</option>';}
											}
											print '>' . $_row['state'] . '</option>';
										}
										
									print '	
									</select>
									</div>
									
						
							</p>
							<p><a href="index.php?menu=110"><img src="images/back.png" alt="back"></a><input type="submit" value="Pošalji" class="special" /></p>
							
									</form>';
						}
						else if ($_GET['menu'] == 112) {
							include "signin.php";
						}
						else if ($_GET['menu'] == 113) {
							# delete from
							$query  = "DELETE FROM dojmovnik";
							$query .= " WHERE id=".(int)$_GET['delete'];
							$query .= " LIMIT 1";
							$result = @mysqli_query($MySQL, $query);

							$_SESSION['message'] = '<h3>Uspješno ste obrisali dojam korisnika iz baze !</h3><hr>';

							$redirect = "index.php?menu=110";
							header("Location: " . $redirect);
						}
					print '
					</section>
					<hr class="major">
				</div>
			</section>';