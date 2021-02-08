
<?php

/**
 *
 * Author: Ajith Sebastian
 * Purpose : Create a website where you use Steam to log in. Introduce Steam username and avatar after signing in.
 *
 * Method : We are using Steam OpenID. This allows our application to authenticate a user's SteamID without requiring them to enter their Steam username or password on our site
 * We are getting Steam username and avatar after signing in.
 * 
 * 
 * Output : User can able to login into steam account and their profile information displaying in our website.
 * 
 * 
 * 
 */

session_start();
include_once("config/settings.php");
include_once("controller/userLoginController.php");

//create an object for the userLogin class
$login = new UserLogin();

// if user is logged in then redirect them to user profile page
$login->loggedInCheck($steamauth['useraccount']);

//execute below section if user click login button
 if (isset($_GET['login'])){

    //require open id class file for open id authentication
    require_once 'controller/openidController.php';
    
	try {
		
		$openid = new LightOpenID($steamauth['domainname']);
		
		if(!$openid->mode) {

            //set the open id URL from the settings page
            $openid->identity   = $steamauth['openIdUrl'];
            $login->redirectPage($openid->authUrl());
			
			
		} elseif ($openid->mode == 'cancel') {
			echo 'User has canceled authentication!';
		} else {
			if($openid->validate()) { 
                $id = $openid->identity;
                
                //get the exact open id
                $steam_id   = $login->getSteamId($id);

                //set the steam id in a session variable				
                $_SESSION['steamid'] =  $steam_id;
                
                //redirect user to user account page once we receive the steam id
				$login->redirectPage($steamauth['useraccount']);
				
			} else {
				echo "User is not logged in.\n";
			}
		}
	} catch(ErrorException $e) {
	    echo $e->getMessage();
	}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Task 3 - Steam Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this page -->
    <link href="login.css" rel="stylesheet">
  </head>

  <body>
    <form class="form-signin">
      <div class="text-center mb-4">
        <img class="mb-4" src="https://community.akamai.steamstatic.com/public/shared/images/signinthroughsteam/sits_landing.png" alt="steam" >
        <h1 class="h3 mb-3 font-weight-normal">Welcome Guest</h1>
        <p>Please use below button to login into your steam account.</p>
        <a href='?login'><img src="https://community.akamai.steamstatic.com/public/images/signinthroughsteam/sits_02.png" width="109" height="66" border="0"></a>
      </div>
    </form>
  </body>
</html>