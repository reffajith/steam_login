<?php
//include basic class for basic methodes
include_once('basicController.php');

//extend user login from basic class
class UserAccount extends BasicController {


    //this method will logout user and redirect to the specified page
    public function getUserBasicInfo($steam_api_URL, $steam_api_key, $steam_id) {
        
        //get the json response
        $url = file_get_contents($steam_api_URL."?key=".$steam_api_key."&steamids=".$steam_id); 
        $content = json_decode($url, true);
        
        //extyract the user details
        $user_basic_info['steam_personaname'] 		= $content['response']['players'][0]['personaname'];
        $user_basic_info['steam_avatarfull'] 		= $content['response']['players'][0]['avatarfull'];
        
        return $user_basic_info;
    }

}


?>