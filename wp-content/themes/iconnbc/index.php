<?php 
get_header();
?>
<div class="container">
<?php 
if (have_posts()):
	while ( have_posts() ) : the_post();?>
	<div class="wraper">
	<h2 class="blog_title">
	<a href="<?php the_permalink();?>"> 
	<?php the_title(); ?> 
	</a>
	</h2>
	<div class="blog_content">
	<?php the_content();  ?>
	</div>
	</div>
	<?php
	endwhile; 
	else :
	echo 'No post found';
	endif;
	?>
</div>	
<?php	
get_footer();
?>