<?php
get_header();
if (have_posts()):
	while ( have_posts() ) : the_post();
	$meta = get_post_meta( $post->ID, 'post', true );
	?>
	<div class="body-wraper">
	<div class="container" id="home-content">
	<div class="breadcrumb">
	<li> NATIONAL & INTERNATIONAL NEWS & EVENTS </li>
	<?php
	$timestamp = strtotime($meta['date']);
	$cd=date('Y-m-d');
	$cp= date("Y-m-d", $timestamp);
	if($cp>$cd){?>
	<li><a href="<?php echo home_url() ?>/upcoming-news-events"> UPCOMING NEWS & EVENTS</a> </li>
	<?php }
	else{ ?>
	<li><a href="<?php echo home_url() ?>/past-news-events"> PAST NEWS & EVENTS</a> </li>
	<?php } ?>
	<li class="active"> <?php the_title(); ?> </li>
	</div>
	<div class="row">
	<div class="col-sm-9">
	<div class="detail_title">
	<h4 class="blog_title">
	<?php the_title(); ?>
	</h4>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-9">
	<div class="detail_date_time">
	<?php
	$timestamp = strtotime($meta['date']);
	echo date("F.d.Y", $timestamp) ?>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-9">
	<hr>
	<br>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="blog_img">
	<?php the_post_thumbnail('banner-img'); ?>
	</div>
	<?php } ?>
	<div class="blog_content">
	<?php the_content();  ?>
	</div>
	</div>
	<div class="col-sm-3">
		<!-- adv img -->
	</div>
	</div>

	</div>
	</div>
	<?php
	endwhile;
	else :
	echo 'No post found';
	endif;
get_footer();
?>
