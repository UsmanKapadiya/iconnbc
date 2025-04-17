<?php 
get_header(); ?>
<div class="body-wraper">
<div class="container" id="home-content">
<h3 style="padding-bottom: 25px;padding-top: 15px;"><strong> Archive</strong></h3>
<div class="row">
<div class="col-sm-9">
<?php
if (have_posts()):
	while ( have_posts() ) : the_post();
	$meta = get_post_meta( $post->ID, 'post', true );
	$timestamp = strtotime($meta['date']);
	$cd=date('Y-m-d');
	$cp= date("Y-m-d", $timestamp);
	if($cp<$cd){
	?>

<div class="event_wraper">
<div class="container-fluid">
<div class="row" id="event-container">
  <div class="col-sm-4" style="overflow:hidden;">
	<?php the_post_thumbnail(); ?>
  </div>
  <div class="col-sm-8">
	<div class="event_title">
	<h4 class="event_title" ><?php the_title(); ?></h4>
	</div>
	<div class="event_category">
	<h6 class="event_category">
	<?php 
	$timestamp = strtotime($meta['date']);
	echo date("F.d.Y", $timestamp).' | '. $meta['e_category']; ?></h6>
	</div>
	<div class="call_to_action">
	<a href="<?php the_permalink();?>" class="button">View Photos </a>
	</div>
  </div>
</div>  
<hr>
</div>
</div>

	<?php }
	else{
		echo 'No post found';
	}

	endwhile; 
	else :
	echo 'No post found';
	endif; ?>
</div>
  <div class="col-sm-3">
	<?php get_sidebar(); ?>
  </div>


</div>
</div>
</div>
<?php
get_footer();
?>