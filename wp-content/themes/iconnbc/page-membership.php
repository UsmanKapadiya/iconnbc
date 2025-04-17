<?php 
get_header();
?>

<div class="page-banner">
<img src="<?php bloginfo('template_directory'); ?>/images/membership/banner_iconnbc_membership.jpg" class="page-banner-img image-maxwidth">
	<h2 class="reponsive-fonts">
		Become Part of Our Community
	</h2>
</div>
<div class="container">
	<div class="membership-wrap" style="margin: 100px 0">
		
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