<?php 
if( is_page( 'constitution-by-laws') ){
	wp_redirect( "http://www.intelligrp.com/iconnbc/wp-content/uploads/2018/01/Constitution-By-Laws.pdf" );
}
else {
get_header();
?>
<div class="page-banner">
<img src="<?php bloginfo('template_directory'); ?>/images/about/banner_iconnbc_aboutus.jpg" class="page-banner-img image-maxwidth">
	<h2 class="reponsive-fonts">
			Striving Towards Fostering Excellence
		</h2>
</div>

<div class="container">
	<div class="contact-wrap" style="margin: 100px 0">
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
}
?>