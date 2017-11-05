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
                                <form method="POST">
					<label>User-ID</label>
					<input type="text" name="uname" required></br></br>
					<label>Vorname</label>
					<input type="text" name="vname"></br></br>
					<label>Nachname</label>
					<input type="text" name="vname"></br></br>
					<label>Passwort</label>
					<input type="password" name="pw"></br></br>
					<label>Passwort bestätigen</label>
					<input type="password" name="pw"></br></br>
                                        <button type="submit" name="register">registrieren</button>
					<button type="reset" name="reset">zurücksetzen</button>
				</form>
			</div>
		</div>
	</body>
</html>
