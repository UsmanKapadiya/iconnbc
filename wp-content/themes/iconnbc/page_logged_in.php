<?php 
    /*
    Template Name: Logged-In Users Page
    */
?>
<?php if(is_user_logged_in()):?>
<?php 
get_header();
?>
<div class="body-wraper">
<div class="container" id="home-content">
<?php 
if (have_posts()):
	while ( have_posts() ) : the_post();
	the_content();	
	endwhile; 
	else :
	echo 'No post found';
	endif;
	?>
</div>
</div>
<?php
get_footer();
?>
<?php 
	else:
	wp_redirect( wp_login_url() );
	endif;
?>