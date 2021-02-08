<?php
//set basic configurations in this page

$steamauth['apikey'] = "A658A821B14C48D1A48E6198C0409DB0"; // Steam WebAPI-Key from https://steamcommunity.com/dev/apikey
$steamauth['domainname'] = "http://localhost"; // The main URL of your website displayed in the login page
$steamauth['loginpage'] = "http://localhost/job/task3/index.php"; // Page to redirect to after a successfull logout (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
$steamauth['useraccount'] = "http://localhost/job/task3/user_info.php"; // Page to redirect to after a successfull login (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
$steamauth['openIdUrl'] = "https://steamcommunity.com/openid"; // set open ID URL
$steamauth['userinfoAPIURL'] = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/"; // set userinfo API URL

// System stuff
if (empty($steamauth['apikey'])) {
    die("<div style='display: block; width: 100%; background-color: red; text-align: center;'>SteamAuth:<br>Please supply an API-Key!<br>Find this in steamauth/SteamConfig.php, Find the '<b>\$steamauth['apikey']</b>' Array. </div>");}
if (empty($steamauth['domainname'])) {$steamauth['domainname'] = $_SERVER['SERVER_NAME'];}
if (empty($steamauth['logoutpage'])) {$steamauth['logoutpage'] = $_SERVER['PHP_SELF'];}
if (empty($steamauth['loginpage'])) {$steamauth['loginpage'] = $_SERVER['PHP_SELF'];}
?>