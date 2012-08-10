<?php
######Sunny Media PHP Class######
######Created by Mave1993.de#####
##Copyright by Patrick Hassmann##

include 'smclass.php';
$sm = new smadmin();
$sm->connect("server/sunnymedia.sqlite"); // Pfad zur sunnymedia.sqlite
$sm->selectserver("sunnymediaserver.conf"); // Config Name des Servers

$sm->serverdel(); //Server beendet sich automatisch und wird ohne rueckfrage geloescht!!!

?>