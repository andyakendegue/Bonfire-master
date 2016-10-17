<div id="fh5co-intro-section" class="section-overlay animate-box" data-animate-effect="fadeIn">
    <div class="fh5co-intro-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(<?php echo Template::theme_url('images/Pic-wide4.jpg'); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 float-overlay">
                    <h2>Notre blog</h2>
                    <h3>Retrouvez ici des articles rediges par nos soins.</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="fh5co-section">
    <div class="container">
<div class="row">







    <div class="col-md-9">
        <?php /*if($this->session->userdata('user_id') && $this->session->userdata('user_type') != 'user')
        { ?>
        <h2><a style="color: green" href="<?=  base_url()?>blog/new_post/"><span class="glyphicon glyphicon-pencil"></span> Create a new post</a></h2>
        <?php }*/ ?>
    <!-- insert the page content here -->
    <?php /*foreach($posts as $post)
    { ?>
    <h2><a style="color:red;" href="<?=  base_url()?>blog/post/<?=$post['post_id']?>"><?=$post['post_title'];?></a></h2>
        <?php if($this->session->userdata('user_id') && $this->session->userdata('user_type') != 'user')
        { ?>
        <p>
            <a href="<?=  base_url()?>blog/editpost/<?=$post['post_id']?>"><span class="glyphicon glyphicon-edit" title="Edit post"></span></a> | 
            <a href="<?=  base_url()?>blog/deletepost/<?=$post['post_id']?>"><span style="color:#f77;" class="glyphicon glyphicon-remove-circle" title="Delete post"></span></a>
        </p>
       <?php }?>
        <p><?=  substr(strip_tags($post['post']), 0, 200).'...';?></p>
        <p><a href="<?=  base_url()?>blog/post/<?=$post['post_id']?>">Read More</a></p>
    <?php
    }?>
    <?php print_r($posts)
 */

    ?>




    </div>

    <?php //include 'sidebar.php' ?>
</div>

        </div>
    </div>


<div id="fh5co-product-section">
    <div class="container">
        <div class="row">
            <?php if (isset($articles) && is_array($articles) && count($articles)) {
            foreach($articles as $article) { ?>
            <div class="product-inner">
                <div class="col-md-4 animate-box">
                    <div class="desc">

                        <?php

                                echo ('<h3>'.anchor('/news/article/'.$article->id,$article->title).'</h3>');

                                $string = $article->body;

                                // strip tags to avoid breaking any html
                                $string = strip_tags($string);

                                if (strlen($string) > 500) {

                                    // truncate string
                                    $stringCut = substr($string, 0, 500);

                                    // make sure it ends in a word so assassinate doesn't become ass...

                                    //$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>';
                                    $lire_plus = "...Lire plus";
                                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).anchor('/news/article/'.$article->id,$lire_plus);
                                }



                                ?>

                        <p><?php  echo $string; ?></p>
                    </div>
                </div>
                <div class="col-md-8 animate-box">
                    <figure>
                        <a href="#"><img class="img-responsive" src="<?php echo Template::theme_url('images/product-2.jpg'); ?>" alt="product"></a>
                    </figure>
                </div>



            </div>

            <?php }
            ?>

            <?php
            } else { ?>
                <p><?php echo lang('us_no_articles'); ?></p>
            <?php } ?>

        </div>
    </div>
</div>