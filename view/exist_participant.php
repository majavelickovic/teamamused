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
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/reise" ?>">Reise</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/rechnung" ?>">Rechnung</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/teilnehmer" ?>">Teilnehmer</a></li>
                        <li><a href="<?php echo $GLOBALS["ROOT URL"] . "/logout" ?>">Logout</a></li>
                    </ul>
                </div>
                <div id="blockleft">
                    <table>
                        <tr>
                            <td><img src="../design/pictures/search.png"></td><td>bestehende Teilnehmer anzeigen</td>
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
                            <td>Teilnehmer-ID</td>
                            <td><input type="text" name="teilnehmer_id" value="" size="40px" /></td>
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
                            <td colspan="2" align="center"><input type="submit" class="button" value="suchen" />  <input type="reset" class="button" value="zur&uuml;cksetzen" /></td>
                        </tr>
                    </table>
                </div>
                <div id="blockright">
                    <table id="participantTable">
                        <tr>
                            <th>Teilnehmer-ID</th>
                            <th>Reise-ID</th>
                            <th>Vorname</th>
                            <th>Nachname</th>
                        </tr>
                        <?php
                            $participanttablecontent = controller\TeilnehmerController::readParticipant();
                            if($participanttablecontent != null){
                                echo $participanttablecontent;
                            }else{
                                echo "";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
