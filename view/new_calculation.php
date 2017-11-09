<!DOCTYPE html>
<!--
Diese Seite stellt die Rechnungs-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Rechnung</title>
    </head>
    <body>		
        <div id="whiteblock">
            <div id="block">
                <div id="navblock">
                    <ul>
                        <li><a href="#reise">Reise</a></li>
                        <li><a href="#rechnung">Rechnung</a></li>
                        <li><a href="#teilnehmer">Teilnehmer</a></li>
                        <li><a href="#profil">Profil</a></li>
                    </ul>
                </div>
                <div id="blockleft">
					<table>
                        <tr>
                            <td><img src="../design/pictures/plus.png"></td><td>neue Rechnung hinzufügen</td>
                        </tr>
					</table>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
					<table>
						<tr>
                            <td>Reise</td>
							<td>
								<select id="dropdown" name="reise">
									<option value="">X</option>
									<option value="">Y</option>
									<option value="">Z</option>
								</select>
							</td>
                        </tr>
						<tr>
                            <td>Rechnungsart</td>
							<td>
								<select id="dropdown" name="rgart">
									<option value="">X</option>
									<option value="">Y</option>
									<option value="">Z</option>
								</select>
							</td>
                        </tr>
						<tr>
                            <td>Kosten</td>
							<td><input type="text" name="price" value="" size="40px" /></td>
                        </tr>
						<tr>
                            <td>Beschreibung</td>
							<td><input type="text" name="discription" value="" size="40px" /></td>
                        </tr>
						<tr>
                            <td>Dokument</td>
							<td><input type="text" name="document" value="" size="40px" /></td>
                        </tr>
						<tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="hinzuf&uuml;gen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
					</form>
					</table>
                </div>
            </div>
        </div>
    </body>
</html>