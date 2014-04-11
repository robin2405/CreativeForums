<?php
include_once("connect.php");
include_once("header.php");
include_once("sidebar.php");

echo '
Ga naar: <a href="messages.php">Berichten (Inbox)</a> - <a href="pages.php?page=24" target="_blank">Upload een foto</a>
<form action="newmessage_parse.php" method="post">
<table border="1" cellspacing="0">
           <tr>
                <td align="right">
                    Ontvanger:
                </td>
                <td>
                    <input type="text" name="target">
                </td>
            </tr>
           <tr>
                <td align="right">
                    Onderwerp:
                </td>
                <td>
                    <input type="text" name="title">
                </td>
            </tr>
            <tr>
                <td align="right">
                    Inhoud:
                </td>
                <td>
                    <textarea name="Content">Type hier je berichtje.</textarea>
                </td>
            </tr>
            <tr>
                <td class="td2" align="right">
                    <input type="reset" value="Alle vakken leegmaken" />
                </td>
                <td class="td2">
                    <input type="submit" value="Bericht Verzenden" />
                </td>
            </tr>
</table>
</form>
';

include_once("footer.php");
?>