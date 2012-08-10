<?php
######Sunny Media PHP Class######
######Created by Mave1993.de#####
##Copyright by Patrick Hassmann##

include 'smclass.php';
$sm = new smadmin();
$sm->connect("server/sunnymedia.sqlite"); // Pfad zur sunnymedia.sqlite

$sm->serveradd("neuertest.conf");

$sm->selectserver("neuertest.conf"); // Config Name des Servers

$data = array();
$data['i_server_config_ipv6'] = 0;
$data['i_server_config_remoteadmininterface'] = 1;
$data['s_server_config_motd'] = 'Test Example';
$data['s_server_config_logfilepath'] = "/";
$data['s_server_config_adminpassword'] = "password";
$data['i_server_config_maxconnections'] = 60;
$data['s_server_config_servername'] = 'Example Server';
$data['s_server_config_serverpassword'] = "password";
$data['s_server_config_network_boundtoip'] = "127.0.0.1";
$data['i_server_config_network_port'] = 30046;
$data['i_server_config_codec_band'] = 2;
$data['i_server_config_codec_quality'] = 10;
$data['i_server_config_options_guestscanregister'] = 0;

$sm->serveredit($data);

$sm->serverstart();

?>