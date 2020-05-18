<?php
require_once("includes/header.php");
require_once("includes/classes/Privatevideo.php");

$trendingProvider = new Privatevideo($con, $userLoggedInObj);
$videos = $trendingProvider->getVideos();

$videoGrid = new VideoGrid($con, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, "Your videos uploaded privately. Only you can view these videos", false);
    }
    else {
        echo "No videos to show";
    }
    ?>
</div> 