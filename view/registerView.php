<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
/*echo "hallo";
session_start();

if(!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    echo "nicht eingeloggt";
    header("Location: http://localhost/TeamAmused/view/loginView.php");
}*/
?>

<html>
	<head>
		<title>Registrierung</title>
		<link rel="stylesheet" href="../design/styles.css">
	</head>
	<body>
		<div id="block">
			<div id="part1">
				<h1>Reiseverwaltung</h1>
				<p>Registrierung</p>
				<form>
					<label>User-ID</label>
					<input type="text" name="uname" required></br></br>
					<label>Vorname</label>
					<input type="text" name="vname" required></br></br>
					<label>Nachname</label>
					<input type="text" name="vname" required></br></br>
					<label>Passwort</label>
					<input type="password" name="pw" required></br></br>
					<label>Passwort bestätigen</label>
					<input type="password" name="pw" required></br></br>
					<button type="button" name="login">einloggen</button>
					<button type="button" name="reset">zurücksetzen</button>
				</form>
			</div>
		</div>
	</body>
</html>
