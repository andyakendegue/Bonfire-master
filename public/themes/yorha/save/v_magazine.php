<div id="fh5co-intro-section" class="section-overlay animate-box" data-animate-effect="fadeIn">
    <div class="fh5co-intro-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(images/intro.jpg);">
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

<div id="fh5co-section">
    <div class="container">
<div class="row">








    <div class="col-md-9">
        <?php if($this->session->userdata('user_id') && $this->session->userdata('user_type') != 'user')
        { ?>
        <h2><a style="color: green" href="<?=  base_url()?>blog/new_post/"><span class="glyphicon glyphicon-pencil"></span> Create a new post</a></h2>
        <?php } ?>
    <!-- insert the page content here -->
    <?php foreach($posts as $post)
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
    <?=$pages?>
    </div>

    <?php include 'sidebar.php' ?>
</div>

        </div>
    </div>