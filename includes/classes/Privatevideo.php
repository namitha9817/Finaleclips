<?php
require_once("ProfileData.php");
class Privatevideo {

    private $con, $userLoggedInObj, $profileUsername;

    public function __construct($con, $userLoggedInObj) {
        $this->con = $con;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getProfileUsername() {
        return $this->userLoggedInObj->getUsername();
    }

    public function getVideos() {
        $videos = array();

        $query = $this->con->prepare("SELECT * FROM videos WHERE privacy = 0 AND uploadedBy=:username");
        $query->bindParam(":username", $profileUsername);
        $profileUsername = $this->getProfileUsername();
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->con, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos; 
    }
}
?>