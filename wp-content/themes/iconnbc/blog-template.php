<?php 
/* 
Template Name: blog layout
*/
get_header();
?>

<?php 
if (have_posts()):
	while ( have_posts() ) : the_post(); 
	the_content();	
	endwhile; 
	else :
	echo 'No post found';
	endif;
get_footer();
?>