<?php

error_reporting(-1);
session_start();

include_once "facebook_config.php";

$requestLikes = $fb->get('/me/likes?limit=50');
$likes = $requestLikes->getGraphEdge();

$totalLikes = array();
if ($fb->next($likes)) {
    $likesArray = $likes->asArray();
    $totalLikes = array_merge($totalLikes, $likesArray);
    while ($likes = $fb->next($likes)) {
        $likesArray = $likes->asArray();
        $totalLikes = array_merge($totalLikes, $likesArray);
    }
} else {
    $likesArray = $likes->asArray();
    $totalLikes = array_merge($totalLikes, $likesArray);
}

?>
<style>
    .content_header {
        font-size: 24px;
        margin-top: 40px;
        margin-bottom: 40px;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <h3 class="content_header"><?php echo $user_firstname; ?> has liked <?php echo count($totalLikes); ?> posts.</h3>
    </div>
</div>

<!-- display list of liked posts/pages images -->
<div class="row">
<?php
// printing data on screen
foreach ($totalLikes as $key) {
?>
    <div class="col-xs-4">
        <a href="https://www.facebook.com/<?php echo $key['id']; ?>">
            <img src="https://graph.facebook.com/<?php echo $key['id']; ?>/picture?type=large" class="img-responsive bordered_container" style="margin-top: 5px; margin-bottom: 5px;" />
        </a>
    </div>
<?php
}
?>
</div>

