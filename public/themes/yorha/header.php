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
<div class="box-wrap">

<div id="fh5co-header-top" class="fh5co-grey-section">
    <div class="container">
        <div id="language" class="col-md-2 text-center fh5co-social-icons pull-left">

            <?php if ($language == 'fr') : ?>
                <a href="<?php echo site_url()?>" class="active">fr</a>
                <a href="<?php echo site_url('en')?>">en</a>
            <?php else : ?>
                <a href="<?php echo site_url()?>">fr</a>
                <a href="<?php echo site_url('en')?>" class="active">en</a>
            <?php endif; ?>

            </div>
        <div class="fh5co-social-icons text-center pull-right">


        <?php if (empty($current_user)) : ?>
            <a href="<?=  site_url(LOGIN_URL);?>" ><i class="icon-login"></i> </a>
            <?php if ($language == 'fr') : ?>
            <a class="link-bar-top" href="<?php echo site_url(LOGIN_URL); ?>">Espace Membre</a>
                <?php else : ?>
                <a class="link-bar-top" href="<?php echo site_url(LOGIN_URL); ?>">Member zone</a>
            <?php endif; ?>

        <?php else : ?>
             <?php //echo check_method('profile'); ?>
        <a href="<?=  site_url(LOGIN_URL);?>" ><i class="icon-log-out"></i> </a>
        <!--<a href="<?php echo site_url('logout'); ?>"><?php e(lang('bf_action_logout')); ?></a>-->

            <?php if ($language == 'fr') : ?>
                <a href="<?php echo site_url('logout'); ?>">Deconnexion</a>
            <?php else : ?>
                <a href="<?php echo site_url('logout'); ?>">Log out</a>
            <?php endif; ?>

            <?php if ($language == 'fr') : ?>
                <a href="<?php echo site_url('users/profile'); ?>">Mon profil</a>
                <?php else : ?>
                <a href="<?php echo site_url('users/profile'); ?>">My profile</a>
            <?php endif; ?>
            <!--<a id="modal-profile" href="#modal-container-profile" role="button" data-toggle="modal"><?php e(lang('bf_user_settings')); ?></a>
            <div class="modal fade" id="modal-container-profile" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                Mon Profil
                            </h4>
                        </div>
                        <div id="page-load" class="modal-body">
                            内容...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button> <button type="button" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>

                </div>

            </div>
-->
        <?php endif; ?>

        </div>
        <div class="col-md-2 text-center fh5co-social-icons pull-right">

                <a href="https://twitter.com/yorhajob" target="_blank"><i class="icon-twitter-with-circle"></i></a>
                <a href="https://www.facebook.com/pages/Yorha-Consulting" target="_blank"><i class="icon-facebook-with-circle"></i></a>
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
                                <?php if ($language == 'fr') : ?>
                                <ul class="nav text-right">
                                    <li class="<?php echo $link_class['home'] ?>"><a href="<?=base_url()?>"><span>Accueil</span></a></li>
                                    <li class="<?php echo $link_class['services'] ?>"><a href="<?=base_url('services')?>">Services</a></li>
                                    <li class="<?php echo $link_class['blog'] ?>"><a href="<?=base_url('blog')?>">Le blog</a></li>
                                    <li class="<?php echo $link_class['job'] ?>"><a href="<?=base_url('job')?>">YORHA JOB</a></li>
                                    <li class="<?php echo $link_class['about'] ?>"><a href="<?=base_url('about')?>">A Propos de nous</a></li>
                                    <li class="<?php echo $link_class['contact'] ?>"><a href="<?=base_url('contact')?>">Contact</a></li>
                                </ul>
                                <?php else: if ($language == 'en') : ?>
                                <ul class="nav text-right">
                                    <li class="<?php echo $link_class['home'] ?>"><a href="<?=base_url()?>"><span>Home</span></a></li>
                                    <li class="<?php echo $link_class['services'] ?>"><a href="<?=base_url('services')?>">Services</a></li>
                                    <li class="<?php echo $link_class['blog'] ?>"><a href="<?=base_url('blog')?>">Blog</a></li>
                                    <li class="<?php echo $link_class['job'] ?>"><a href="<?=base_url('job')?>">YORHA JOB</a></li>
                                    <li class="<?php echo $link_class['about'] ?>"><a href="<?=base_url('about')?>">About us</a></li>
                                    <li class="<?php echo $link_class['contact'] ?>"><a href="<?=base_url('contact')?>">Contact</a></li>
                                </ul>
                                <?php else : ?>
                                <?php endif; ?><?php endif; ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>