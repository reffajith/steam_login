<?php

/**
 *
 * Author: Ajith Sebastian
 * Purpose : This page check whether user is logged in to steam account. If logged in, display Steam username and avatar on this page.
 *
 * Method : We are using Steam OpenID. This allows our application to authenticate a user's SteamID without requiring them to enter their Steam username or password on our site
 * We are getting Steam username and avatar after signing in.
 * 
 * 
 * Output : User steam  profile information displaying in this page.
 * 
 * 
 * 
 */

session_start();
//include settings page 
include_once("config/settings.php");
//include userlogin class to check whether user logged in and logout
include_once("controller/userLoginController.php");
//include this page to get the user information
include_once("controller/userAccountController.php");

//create an object for the userLogin class
$login = new UserLogin();

//create an object for the userAccount class to get user info
$user = new UserAccount();

// if user is not logged in then redirect them to login page. Only logged in user access this page
$login->loginCheck($steamauth['loginpage']);

//check whether we already got the user info
if (empty($_SESSION['steam_uptodate']) or empty($_SESSION['steam_personaname'])) {
	
    //call the methode to ge the user information.
    $user_basic_info    = $user->getUserBasicInfo($steamauth['userinfoAPIURL'], $steamauth['apikey'], $_SESSION['steamid']);

    $_SESSION['steam_personaname'] 		= $user_basic_info['steam_personaname'];
    $_SESSION['steam_avatarfull'] 		= $user_basic_info['steam_avatarfull'];
}

//if user click on log out button
if (isset($_GET['logout'])){
	$login->logoutUser($steamauth['loginpage']);
}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">    
    <title>Steam - User Information</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">Steam User Account</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link disabled" href="#"> Welcome <?=$_SESSION['steam_personaname']?></a>
          </li>
        </ul>
        <form action='' method='get' class="form-inline mt-2 mt-md-0">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Logout</button>
        </form>
      </div>
    </nav>

    <main role="main" class="container">
    <div class="jumbotron">
        <h1>Welcome <?=$_SESSION['steam_personaname']?></h1>
        <div class="row g-0">
                <div class="col-md-3 align-self-center pl-4">
                <img class="rounded-circle" src="<?=$_SESSION['steam_avatarfull']?>" alt="avatar" width="140" height="140">
                </div>
                <div class="col-md-9">
                <div class="card-body">
                <p class="lead">This is your basic information about you from your steam profile.</p>
                </div>
                </div>
            </div>
      </div>
    </main>
  </body>
</html>