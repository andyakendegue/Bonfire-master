<?php
/**
 * Created by PhpStorm.
 * User: capp
 * Date: 18/09/2016
 * Time: 18:42
 */


echo theme_view('header'); ?>
    <div class="container"><!-- Start of Main Container -->
<?php
    //echo theme_view('_sitenav');

    echo Template::message();
    echo isset($content) ? $content : Template::content();

    echo theme_view('footer');
    ?>