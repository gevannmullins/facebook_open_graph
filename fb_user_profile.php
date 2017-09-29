<?php



?>

<style>
    .sidebar_container {
        position: relative;
        width: 100%;
        padding: 20px;
        border-bottom: 1px solid #ccc;
        color: #222222;
    }
    .total_interactions_number {
        color: orangered;
        font-size: 28px;
    }
    .total_interactions_text {
        color: #000;
        font-weight: 800;
    }
    .interaction_number {
        color: orangered;
        font-size: 28px;
    }
    .interaction_text {
        color: #8c8c8c;
        font-size: 9px;
    }
    .sidebar_container_link a {
        color: orangered;
    }
</style>
<!-- user profile information -->
<div class="sidebar_container">
    <div class="row margin_bottom">
        <div class="col-xs-5">
            <img src="<?php echo $user_pic; ?>" class="img-responsive img-circle" width="100%" />
        </div>
        <div class="col-xs-7">
            <h1><?php echo $user_firstname; ?></h1>
            <span><?php echo $user['gender']; ?></span>
        </div>
    </div>

    <div class="row margin_bottom">
        <div class="col-xs-5">
            <i class="fa fa-gift" aria-hidden="true"></i>
            <?php echo $user_birthday; ?>
        </div>
        <div class="col-xs-7">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <?php echo $user_location; ?>
        </div>
    </div>

</div>

<div class="sidebar_container">

    <div class="row">
        <div class="col-xs-12">
            <p class="total_interactions_number">24</p>
            <p class="total_interactions_text">total interactions to date</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-3">
                    <p class="interaction_number">28</p>
                    <p class="interaction_text">FACEBOOK POST LIKES</p>
                </div>
                <div class="col-xs-3">
                    <p class="interaction_number">11</p>
                    <p class="interaction_text">FACEBOOK COMMENTS</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="sidebar_container">

    <div class="row">
        <div class="col-xs-12">
            <p class="interaction_text">OPT IN</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p>SMS - EMAIL</p>

        </div>
    </div>
</div>


<div class="sidebar_container">

    <div class="row">
        <div class="col-xs-12 sidebar_container_link">
            <a href="">Send Email</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 sidebar_container_link">
            <a href="">Visit Facebook Profile</a>
        </div>
    </div>
</div>




