<?php 
if( is_page( 'constitution-by-laws') ){
	wp_redirect( "http://www.intelligrp.com/iconnbc/wp-content/uploads/2018/01/Constitution-By-Laws.pdf" );
}
else {
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
}
?>