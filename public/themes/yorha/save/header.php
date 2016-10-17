<?php

Assets::add_css(array('bootstrap.min.css', 'bootstrap-responsive.min.css'));

Assets::add_js('bootstrap.min.js');

$inline  = '$(".dropdown-toggle").dropdown();';
$inline .= '$(".tooltips").tooltip();';
Assets::add_js($inline, 'inline');

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php
        echo isset($page_title) ? "{$page_title} : " : '';
        e(class_exists('Settings_lib') ? settings_item('site.title') : 'Bonfire');
        ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php e(isset($meta_description) ? $meta_description : ''); ?>">
    <meta name="author" content="<?php e(isset($meta_author) ? $meta_author : ''); ?>">
    <meta name="keywords" content="yorha, job, gabon, emploi" />


    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />



    <?php //echo Assets::css(); ?>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo Template::theme_url('css/animate.css'); ?>">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?php echo Template::theme_url('css/icomoon.css'); ?>">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="<?php echo Template::theme_url('css/bootstrap2.css'); ?>">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="<?php echo Template::theme_url('css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo Template::theme_url('css/owl.theme.default.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo Template::theme_url('css/style.css'); ?>">


    <!-- Modernizr JS -->
    <script src="<?php echo Template::theme_url('js/modernizr-2.6.2.min.js'); ?>"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="<?php echo Template::theme_url('js/respond.min.js'); ?>"></script>
    <![endif]-->

</head>

<body>
<!--<div class="box-wrap">-->
    <!--
    <div id="main">
        <div id="header">
            <div id="logo">
                <h1><a href="<?=base_url()?>blog/">My Blog</a>
                </h1>
                <div class="slogan">Machines was born to be guided!</div>
            </div>
            <div id="menubar">
                <ul id="menu">
                    <li  ><a href="<?=base_url()?>blog/">Home</a></li>
                    <?php if($this->session->userdata('user_id'))
                    {?>
                          <li><a href="<?=  base_url('logout')?>">(<?=$this->session->userdata['username']?>)Logout</a></li>
                    <?php
                    } 
                    else{ ?>
                        <li><a href="<?=  base_url('login')?>" >Login</a></li>
                    <?php } ?>

                    <li><a href="<?=  base_url('register')?>">Register</a></li>
                    <li ><a href="<?=  base_url('upload')?>">Upload Photo</a></li>
                    <li><a href="<?=  base_url('contact')?>">Contact Us</a></li>
                </ul>
            </div>
        </div>
        </div>
-->
<div id="fh5co-header-top" class="fh5co-grey-section">
    <div class="container">

    <div class="fh5co-social-icons text-center pull-right">
        <!-- A reactiver -->
        <!--
        <?php /*if($this->session->userdata('user_id'))

        {?>
            <a href="<?=  base_url('logout')?>"><i class="icon-logout"></i>(<?=$this->session->userdata['username']?>) Logout</a>
            <a href="<?=  base_url('logout')?>" class="member-text">(<?=$this->session->userdata['username']?>) Logout</a>
            <?php
        }
        else{ ?>
            <a href="<?=  base_url('login')?>" ><i class="icon-login"></i> </a>
            <a href="<?=  base_url('login')?>" class="member-text"> Espace membre</a>
        <?php } */?>
        -->

        <?php if (empty($current_user)) : ?>
            <a href="<?=  site_url(LOGIN_URL);?>" ><i class="icon-login"></i> </a>
            <a href="<?php echo site_url(LOGIN_URL); ?>">Sign In</a>
        <?php else : ?>
             <?php echo check_method('profile'); ?>
        <a href="<?=  site_url(LOGIN_URL);?>" ><i class="icon-log-out"></i> </a>
        <a href="<?php echo site_url('logout'); ?>"><?php e(lang('bf_action_logout')); ?></a>
        <a href="<?php echo site_url('users/profile'); ?>"><?php e(lang('bf_user_settings')); ?></a>

        <?php endif; ?>

        </div>
        <div class="col-md-2 text-center fh5co-social-icons pull-right">

                <a href="#"><i class="icon-twitter-with-circle"></i></a>
                <a href="#"><i class="icon-facebook-with-circle"></i></a>
        </div>

    </div>
</div>


            <header role="banner" id="fh5co-header">
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="fh5co-navbar-brand">
                                    <a class="fh5co-logo" href="<?php echo site_url()?>">
                                    <img class="img-responsive" src="<?php echo Template::theme_url('images/logo.jpg'); ?>" >
                                   </a>
                                </div>
                            </div>
                            <div class="col-md-9 main-nav">
                                <ul class="nav text-right">
                                    <li class="active<?php $home_class ?>"><a href="<?=base_url()?>"><span>Accueil</span></a></li>
                                    <li><a href="<?=base_url('services')?>">Services</a></li>
                                    <li><a href="<?=base_url('blog')?>">Le blog</a></li>
                                    <li><a href="<?=base_url('job')?>">YORHA JOB</a></li>
                                    <li><a href="<?=base_url('about')?>">A Pros de nous</a></li>
                                    <li><a href="<?=base_url('contact')?>">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            <!-- END: header -->