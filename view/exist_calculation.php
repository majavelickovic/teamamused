<!DOCTYPE html>
<!--
Diese Seite stellt die Rechnungs-Seite dar.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../design/styles.css">
        <title>Reise</title>
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
                            <td><img src="../design/pictures/search.png"></td><td>bestehende Rechnung anzeigen</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>Reise</td>
							<td>
								<select id="dropdown" name="journey">
									<option value="">X</option>
									<option value="">Y</option>
									<option value="">Z</option>
								</select>
							</td>
                        </tr>
						<tr>
                            <td>Rechnung-ID</td>
                            <td><input type="text" name="calculationID" value="" size="40px" /></td>
                        </tr>
                        <tr>
                            <td>Rechnungsart</td>
							<td>
								<select id="dropdown" name="calculation">
									<option value="">X</option>
									<option value="">Y</option>
									<option value="">Z</option>
								</select>
							</td>
                        </tr>
						<tr>
                            <td colspan="2" align="center"><input type="submit" class="button" value="suchen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
