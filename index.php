<?php
require_once("config/Autoloader.php");

use router\Router;

session_start();

/*$authFunction = function () {
    if (isset($_SESSION["agentLogin"])) {
        return true;
    }
    Router::redirect("view/loginView.php");
    return false;
};*/

$errorFunction = function () {
    Router::errorHeader();
    require_once("view/404.php");
};

Router::route("GET", "/register", function () {
    require_once("../view/registerview.php");
});

?>
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
				<a href="<?php echo $GLOBALS["ROOT_URL"]; ?>/register">zur Registrierung</a>
			</div>
		</div>
	</body>
</html>