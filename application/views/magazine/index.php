<div id="fh5co-intro-section" class="section-overlay animate-box" data-animate-effect="fadeIn">
    <div class="fh5co-intro-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(<?php echo Template::theme_url('images/Pic-wide5.jpg'); ?>);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 float-overlay">
                    <h2>YORHA JOB</h2>
                    <h3>Le magazine de l'emploi et de la formation.</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="fh5co-product-section">
    <div class="container">
        <div class="row">
            <?php if (isset($articles) && is_array($articles) && count($articles)) {
                foreach($articles as $article) { ?>
                    <div class="product-inner">
                        <div class="col-md-4 col-md-push-8 animate-box">
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
                                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>';
                                }



                                ?>

                                <p><?php  echo $string; ?></p>
                            </div>
                        </div>
                        <div class="col-md-8 col-md-pull-4 animate-box">
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
            <div class="product-inner">
                <div class="col-md-4 animate-box">
                    <div class="desc">
                        <h3><a href="#">Product Title</a></h3>
                        <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    </div>
                </div>
                <div class="col-md-8 animate-box">
                    <figure>
                        <a href="#"><img class="img-responsive" src="<?php echo Template::theme_url('images/mag-prod1.jpg'); ?>" alt="product"></a>
                    </figure>
                </div>
            </div>
            <div class="product-inner">
                <div class="col-md-4 col-md-push-8 animate-box">
                    <div class="desc">
                        <h3><a href="#">Product Title</a></h3>
                        <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    </div>
                </div>
                <div class="col-md-8 col-md-pull-4 animate-box">
                    <figure>
                        <a href="#"><img class="img-responsive" src="<?php echo Template::theme_url('images/mag-prod2.jpg'); ?>" alt="product"></a>
                    </figure>
                </div>
            </div>
            <div class="product-inner">
                <div class="col-md-4 animate-box">
                    <div class="desc">
                        <h3><a href="#">Product Title</a></h3>
                        <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    </div>
                </div>
                <div class="col-md-8 animate-box">
                    <figure>
                        <a href="#"><img class="img-responsive" src="<?php echo Template::theme_url('images/mag-prod3.jpg'); ?>" alt="product"></a>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>