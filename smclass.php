<?php
class smadmin {

private $_db;
private $_conf;
private $_sid;

function connect($conf)
{
$this->_db=@sqlite_open($conf);
}

function selectserver($config)
{
$result=sqlite_query($this->_db,"SELECT * FROM sm_servers WHERE s_server_config_file='".sqlite_escape_string($config)."'");
$row=sqlite_fetch_array($result);
$this->_sid = $row['i_server_id'];
$this->_conf = $row['s_server_config_file'];
}

function serveradd($conf)
{
if(sqlite_query($this->_db,"INSERT INTO sm_servers (s_server_config_file,i_server_command) VALUES ('".$conf."',3)"))
{
return true;
}else{
return false;
}
}

function serverstart()
{
if(sqlite_query($this->_db,"UPDATE sm_servers SET i_server_command=1 WHERE s_server_config_file='".$this->_conf."'"))
{
return true;
}else{
return false;
}
}

function serverstop()
{
if(sqlite_query($this->_db,"UPDATE sm_servers SET i_server_command=2 WHERE s_server_config_file='".$this->_conf."'"))
{
return true;
}else{
return false;
}
}

function serverdel()
{
if(sqlite_query($this->_db,"UPDATE sm_servers SET i_server_command=2 WHERE s_server_config_file='".$this->_conf."'") AND sqlite_query($this->_db,"UPDATE sm_servers SET i_server_status=0 WHERE s_server_config_file='".$this->_conf."'") AND sqlite_query($this->_db,"UPDATE sm_servers SET i_server_command=4 WHERE s_server_config_file='".$this->_conf."'"))
{
return true;
}else{
return false;
}
}

function serveredit($array)
{
if(isset($array['i_server_config_ipv6']) AND !empty($array['i_server_config_ipv6'])){ $i_server_config_ipv6 = "i_server_config_ipv6=".$array['i_server_config_ipv6'].", "; }else{ $i_server_config_ipv6 = ''; }

if(isset($array['i_server_config_remoteadmininterface']) AND !empty($array['i_server_config_remoteadmininterface'])){ $i_server_config_remoteadmininterface = "i_server_config_remoteadmininterface=".$array['i_server_config_remoteadmininterface'].", "; }else{ $i_server_config_remoteadmininterface = ''; }

if(isset($array['s_server_config_motd']) AND !empty($array['s_server_config_motd'])){ $s_server_config_motd = "s_server_config_motd='".$array['s_server_config_motd']."', "; }else{ $s_server_config_motd = ''; }

if(isset($array['s_server_config_logfilepath']) AND !empty($array['s_server_config_logfilepath'])){ $s_server_config_logfilepath = "s_server_config_logfilepath='".$array['s_server_config_logfilepath']."', "; }else{ $s_server_config_logfilepath = ''; }

if(isset($array['s_server_config_adminpassword']) AND !empty($array['s_server_config_adminpassword'])){ $s_server_config_adminpassword = "s_server_config_adminpassword='".$array['s_server_config_adminpassword']."', "; }else{ $s_server_config_adminpassword = ''; }

if(isset($array['i_server_config_maxconnections']) AND !empty($array['i_server_config_maxconnections'])){ $i_server_config_maxconnections = "i_server_config_maxconnections=".$array['i_server_config_maxconnections'].", "; }else{ $i_server_config_maxconnections = ''; }

if(isset($array['s_server_config_servername']) AND !empty($array['s_server_config_servername'])){ $s_server_config_servername = "s_server_config_servername='".$array['s_server_config_servername']."', "; }else{ $s_server_config_servername = ''; }

if(isset($array['s_server_config_serverpassword']) AND !empty($array['s_server_config_serverpassword'])){ $s_server_config_serverpassword = "s_server_config_serverpassword='".$array['s_server_config_serverpassword']."', "; }else{ $s_server_config_serverpassword = ''; }

if(isset($array['s_server_config_network_boundtoip']) AND !empty($array['s_server_config_network_boundtoip'])){ $s_server_config_network_boundtoip = "s_server_config_network_boundtoip='".$array['s_server_config_network_boundtoip']."', "; }else{ $s_server_config_network_boundtoip = ''; }

if(isset($array['i_server_config_network_port']) AND !empty($array['i_server_config_network_port'])){ $i_server_config_network_port = "i_server_config_network_port=".$array['i_server_config_network_port'].", "; }else{ $i_server_config_network_port = ''; }

if(isset($array['i_server_config_codec_band']) AND !empty($array['i_server_config_codec_band'])){ $i_server_config_codec_band = "i_server_config_codec_band=".$array['i_server_config_codec_band'].", "; }else{ $i_server_config_codec_band = ''; }

if(isset($array['i_server_config_codec_quality']) AND !empty($array['i_server_config_codec_quality'])){ $i_server_config_codec_quality = "i_server_config_codec_quality=".$array['i_server_config_codec_quality'].", "; }else{ $i_server_config_codec_quality = ''; }

if(isset($array['i_server_config_options_guestscanregister']) AND !empty($array['i_server_config_options_guestscanregister'])){ $i_server_config_options_guestscanregister = "i_server_config_options_guestscanregister=".$array['i_server_config_options_guestscanregister'].", "; }else{ $i_server_config_options_guestscanregister = ''; }

$up = $i_server_config_ipv6.$i_server_config_remoteadmininterface.$s_server_config_motd.$s_server_config_logfilepath.$s_server_config_adminpassword.$i_server_config_maxconnections.$s_server_config_servername.$s_server_config_serverpassword.$s_server_config_network_boundtoip.$i_server_config_network_port.$i_server_config_codec_band.$i_server_config_codec_quality.$i_server_config_options_guestscanregister;

$up2 = substr($up, 0, -2);
if(sqlite_query($this->_db,"UPDATE sm_servers SET 
				i_server_config_changed=1,
$up2
			WHERE i_server_id=".$this->_sid))
{
return true; }else{ return false; }
}

}
?>