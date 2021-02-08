<?php
//include basic class for basic methodes
include_once('basicController.php');

//extend user login from basic class
class UserLogin extends BasicController {


    //this method will logout user and redirect to the specified page
    public function logoutUser($location) {
        
        session_unset();
        session_destroy();
        $this->redirectPage($location);

    }

    //check whether user already logged in else redirect to login page
    public function loginCheck($login_page) {
        
        if(!isset($_SESSION['steamid'])) {
            $this->redirectPage($login_page);
        }

    }

    //get exact open id
    public function getSteamId($open_id) {
        
        $ptn = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
        preg_match($ptn, $open_id, $matches);

        return $matches[1];

    }

    //check whether user already logged in then redirect to user info page
    public function loggedInCheck($user_account) {
        
        if(isset($_SESSION['steamid'])) {
            $this->redirectPage($user_account);
        }

    }

}


?>