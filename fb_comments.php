<?php

error_reporting(-1);
session_start();

include_once "facebook_config.php";

$helper = $fb->getCanvasHelper();

//$permissions = ['user_posts']; // optionnal


//$requestLikes = $fb->get('/me/comments?limit=100');
//$likes = $requestLikes->getGraphEdge();
// getting all posts published by user
try {
//    $posts_request = $fb->get('/me?fields=comments.summary(true)');
    $posts_request = $fb->get('/me/posts?fields=comments.summary(true)');
    $post_comments = $posts_request->getGraphEdge();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
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
        <h3 class="content_header"><?php echo $user_firstname; ?> has commented on {COMMENTS AMOUNT} posts.</h3>
    </div>
</div>

<?php



$total_posts = array();
$posts_response = $posts_request->getGraphEdge();
if($fb->next($posts_response)) {
    $response_array = $posts_response->asArray();
    $total_posts = array_merge($total_posts, $response_array);
    while ($posts_response = $fb->next($posts_response)) {
        $response_array = $posts_response->asArray();
        $total_posts = array_merge($total_posts, $response_array);
    }
    var_dump($total_posts);
} else {
    $posts_response = $posts_request->getGraphEdge()->asArray();
    var_dump($posts_response);
}

?>