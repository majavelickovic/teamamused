<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="design/styles.css">
	</head>
	<body>
		<div id="block">
			<div id="part1">
				<h1>Reiseverwaltung</h1>
				<p>Login</p>
				<form>
					<label>User-ID</label>
					<input type="text" name="uname" required></br></br>
					<label>Passwort</label>
					<input type="password" name="pw" required></br></br>
					<button type="button" name="login">einloggen</button>
					<button type="button" name="reset">zurücksetzen</button>
				</form>
				<a href="registerView.php">zur Registrierung</a>
			</div>
		</div>
	</body>
</html>