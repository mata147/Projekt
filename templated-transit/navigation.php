<?php
	# Stop Hacking attempt
	if(!defined('__APP__')) {
		die("Hacking attempt");
	}
print '
<nav id="nav">
	<ul>
		<li><a href="index.php?menu=1"'; if($_GET['menu'] == 1) { print ' class="button special"';} print '>Početna</a></li>
		<li><a href="index.php?menu=2"'; if($_GET['menu'] == 2) { print ' class="button special"';} print '>O nama</a></li>
		<li><a href="index.php?menu=3"'; if($_GET['menu'] == 3) { print ' class="button special"';} print '>Proizvodi</a></li>
		<li><a href="index.php?menu=4"'; if($_GET['menu'] == 4) { print ' class="button special"';} print '>Dojmovnik</a></li>
		<li><a href="index.php?menu=5"'; if($_GET['menu'] == 5) { print ' class="button special"';} print '>Kontakt</a></li>
		<li><a href="http://www.tvz.hr" target="_blank"'; if($_GET['menu'] == 5) { print ' class="button special"';} print '>TVZ</a></li>';
		if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
			print '
			<li><a href="index.php?menu=7"'; if($_GET['menu'] == 7) { print ' class="button special"';} print '>Registracija</a></li>
			<li><a href="index.php?menu=6"'; if($_GET['menu'] == 6) { print ' class="button special"';} print '>Prijava</a></li>';
		}
		else if ($_SESSION['user']['valid'] == 'true' and ($_SESSION['user']['user_pos'] == 1 or $_SESSION['user']['user_pos'] == 2)) {
			print '<li><a href="index.php?menu=100"'; if($_GET['menu'] >= 100 && $_GET['menu'] <= 105) { print ' class="button special"';} print '>Administracija</a></li>
			<li><a href="index.php?menu=110"'; if($_GET['menu'] >= 110 && $_GET['menu'] <= 115) { print ' class="button special"';} print '>Odobrenja</a></li>
			<li><a href="logout.php">Odjava</a></li>';
		}
		else if($_SESSION['user']['valid'] == 'true') {
			print '<li><a href="index.php?menu=100"'; if($_GET['menu'] >= 100 && $_GET['menu'] <= 105) { print ' class="button special"';} print '>Administracija</a></li>
			<li><a href="logout.php">Odjava</a></li>';
		}
	print '
	</ul>
</nav>';

?>

