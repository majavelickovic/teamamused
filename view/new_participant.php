<!DOCTYPE html>
<!--
Diese Seite stellt die Teilnehmer-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Teilnehmer</title>
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
                            <td><img src="../design/pictures/plus.png"></td><td>neue/r Teilnemer/in hinzufügen</td>
                        </tr>
					</table>
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
                            <td>Vorname</td>
							<td><input type="text" name="vorname" value="" size="40px" /></td>
                        </tr>
						<tr>
                            <td>Nachname</td>
							<td><input type="text" name="nachname" value="" size="40px" /></td>
                        </tr>
						<tr>
                            <td>Geburtsdatum</td>
							<td><input type="text" name="birth" value="" size="40px" /></td>
                        </tr>
						<tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="hinzufügen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
					</table>
                </div>
            </div>
        </div>
    </body>
</html>