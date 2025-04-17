<?php 
get_header();
?>
<div class="page-banner">
<img src="<?php bloginfo('template_directory'); ?>/images/contact/banner_iconnbc_contactus.jpg" class="page-banner-img image-maxwidth ">
		<h2 class="reponsive-fonts">
			Build Towards A Better Future
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
?>