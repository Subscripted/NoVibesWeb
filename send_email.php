<?php
$empfaenger = "lor.els@gmx.de";
$betreff = "Die Mail-Funktion";
$text = "Hier lernt Ihr, wie man mit PHP Mails verschickt";

mail($empfaenger, $betreff, $text);
?>