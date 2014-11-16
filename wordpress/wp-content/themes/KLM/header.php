<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>"/>
    <title><?php wp_title('&laquo;', true, 'right'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/style.css"/>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<?php
global $dm_settings;

?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div>
    <div class="collapse navbar-collapse container-fluid ">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="text-center row">
            <div class="col-xs-4 text-left">
                <h2><a href="mailto:<?php echo $dm_settings['email'] ?>"><?php echo $dm_settings['email'] ?></a></h2>
            </div>

            <div class="col-xs-4 logo text-center">
                <b>K&middot;L&middot;M</b> Chauffeurs
            </div>

            <div class="col-xs-4 text-right">
                <h2><a href="tel:<?php echo $dm_settings['phone_number'] ?>"><?php echo $dm_settings['phone_number'] ?></a>
                </h2>
            </div>

        </div>
    </div>
    <!-- /.navbar-collapse -->
    <div class="bottom-nav">
        <hr/>
        <div class="div-center collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav menu" id="menu">
                <li><a href="/">Home</a></li>
                <li><a href="fleet.html">Fleet</a></li>
                <li><a href="airport-transfers.html">Airport Transfers</a></li>
                <li><a href="wedding-and-special-events.html">Special Occasions</a></li>
                <li><a href="corporate.html">Corporate</a></li>
                <li><a href="booknow.html">Booking &amp; Payment</a></li>
                <li><a href="whyus.html">Why Us?</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>

</script>