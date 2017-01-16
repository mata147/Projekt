<?php

	# Stop Hacking attempt
    define('__APP__', TRUE);
	
	# Start session
    session_start();
    
    # Configuration file
    include_once("./config.php");
    
    # ---------------------------------------------------------------------------#
	# Connect to MySQL database
	# ---------------------------------------------------------------------------#
	$MySQL = mysqli_connect($conf['MySQL']['Host'],$conf['MySQL']['User'],$conf['MySQL']['Password'],$conf['MySQL']['Database'])
	or die('Error connecting to MySQL server.');
	
	# Redirect
    $redirect = "";
		
	# ---------------------------------------------------------------------------#
    # Registration
    if($_POST['_action_'] == "registration") {
		
		$hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
        #password_hash https://secure.php.net/manual/en/function.password-hash.php
		
        copy($_FILES['profile']['tmp_name'], "userspic/".$_FILES['profile']['name']);
		
        $query  = "INSERT INTO users (user_firstname, user_lastname, user_picture, user_name, user_pass, user_email, user_country)";
        $query .= " VALUES ('" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '" . $_FILES['profile']['name'] . "', '" . $_POST['username'] . "', '" . $hash . "', '" . $_POST['email'] . "', '" . $_POST['country'] . "')";
        $result = @mysqli_query($MySQL, $query);
        
        $ID = mysqli_insert_id();
        $_SESSION['message'] = '<br><hr><h3>Uspješno ste se registrirali! U najkraćem vremenu moderator će Vam odobriti pristup sustavu!</h3><hr>';
        
        $redirect .= "index.php?menu=6";
    }
	
	# ---------------------------------------------------------------------------#
	# dojmovnik
	
	if($_POST['_action_'] == "send") {
		
        $query  = "INSERT INTO dojmovnik (first_name, last_name, city, country, email, notification, message)";
        $query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['city'] . "', '" . $_POST['country'] . "','" . $_POST['email'] . "', '" . $_POST['notification'] . "', '" . $_POST['message'] . "')";
        $result = @mysqli_query($MySQL, $query);
        
        $_SESSION['message'] = '<br><hr><h3>Vaš dojam je uspiješno poslan administratoru na provjeru. Prikazan će biti tek kada se odobri!</h3><hr>';
        
        $redirect .= "index.php?menu=4";
    }
	
	# ---------------------------------------------------------------------------#
	# change_state
	
	if($_POST['_action_'] == "change_state") {
		
        $query  = "UPDATE dojmovnik SET state='" . $_POST['state'] . "'";
        $query .= " WHERE id=" . (int)$_POST['id'];
        $result = @mysqli_query($MySQL, $query);
        
        $_SESSION['message'] = '<br><hr><h3>Promjena je uspiješno odrađena!</h3><hr>';
        
        $redirect .= "index.php?menu=110";
    }
	
	# ---------------------------------------------------------------------------#
	# Sign Up
	else if($_POST['_action_'] == "sign_up") {
	    $_username = $_POST['username'];
		$_password = $_POST['password'];

		$query  = "SELECT * FROM users";
		$query .= " WHERE user_name='" .  $_username . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ((password_verify($_password, $row['user_pass'])) and ($row['user_archive']==Y)) {
		#password_verify https://secure.php.net/manual/en/function.password-verify.php
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['user_id'];
			$_SESSION['user']['name'] = $row['user_name'];
			$_SESSION['user']['first_name'] = $row['user_firstname'];
			$_SESSION['user']['last_name'] = $row['user_lastname'];
			$_SESSION['user']['pic'] = $row['user_picture'];
			$_SESSION['user']['user_pos'] = $row['user_position'];
			$_SESSION['user']['user_archive'] = $row['user_archive'];
		    $_SESSION['message'] = '<p>Dobrodošao ' . $_SESSION['user']['first_name']. ' '. $_SESSION['user']['last_name']. '. Ugodan boravak na našoj stranici !</p>';
			$redirect .= "index.php?menu=100";
		}
		
		# Bad username or password
		else {
			unset($_SESSION['user']);
			$_SESSION['user']['valid'] = 'false';
			$_SESSION['message'] = '<br><hr><h3>Upisali ste pogrešno korisničko ime ili lozinku. Također postoji mogučnost da Vam pristup nije odobren!</h3><hr>';
			$redirect .= "index.php?menu=6";
		}
		
	}
	
	# ---------------------------------------------------------------------------#
	# Edit user
	
	else if($_POST['_action_'] == "edit_user") {
		

			
			if($_SESSION['user']['user_pos'] == 1 or $_SESSION['user']['user_pos']== 2 ){
					$hash2 = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
					$query  = "UPDATE users SET user_firstname='" . $_POST['fname'] . "', user_lastname='" . $_POST['lname'] . "', user_name='" . $_POST['username'] . "', user_email='" . $_POST['email'] . "', user_country='" . $_POST['country'] . "', user_pass='" .$hash2 . "', user_archive='" . $_POST['state'] . "'";
					$query .= " WHERE user_id=" . (int)$_POST['user_id'];
					$query .= " LIMIT 1";
					$result = @mysqli_query($MySQL, $query);
					$_SESSION['message'] = '<br><hr><h3>Uspješno ste izmjenili podatke o korisniku!'.$pwd_res .'</h3><hr>';
					$redirect = "index.php?menu=100";
					
				}
			else {
					$query  = "UPDATE users SET user_firstname='" . $_POST['fname'] . "', user_lastname='" . $_POST['lname'] . "', user_name='" . $_POST['username'] . "', user_email='" . $_POST['email'] . "', user_country='" . $_POST['country'] . "'";
					$query .= " WHERE user_id=" . (int)$_POST['user_id'];
					$query .= " LIMIT 1";
					$result = @mysqli_query($MySQL, $query);
					$_SESSION['message'] = '<br><hr><h3>Uspješno ste izmjenili podatke o korisniku</h3><hr>';
					$redirect = "index.php?menu=100";
					}
		
		
				}

	# Close MySQL connection
    @mysqli_close($mysql);
    
    # Redirect
    header("Location: " . $redirect);
    exit;
?>