<?php
get_header();
if (have_posts()):
	while ( have_posts() ) : the_post();
	$meta = get_post_meta( $post->ID, 'your_fields', true );
	?>
	<div class="body-wraper">
	<div class="container" id="home-content">
	<div class="breadcrumb">
	<li> ASSOCIATION EVENTS </li>
	<li><a href="<?php echo home_url() ?>/upcoming-events"> UPCOMING EVENTS</a> </li>
	<li class="active"> <?php the_title(); ?> </li>
	</div>
	<div class="row">
	<div class="col-sm-12">
	<div class="detail_title">
	<h4 class="blog_title">
	<?php the_title(); ?>
	</h4>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-12">
	<div class="detail_date_time">
	<?php
	$timestamp = strtotime($meta['date'].''.$meta['time']);
	echo date("F.d.Y h:i A", $timestamp) ?>
	</div>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-12">
	<hr>
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="blog_img">
	<?php the_post_thumbnail('banner-img'); ?>
	</div>
	<?php } ?>
	<div class="blog_content">
	<?php the_content();  ?>
	</div>
	<div class="row" style="padding-top: 25px;">
	<div class="col-sm-4 event_detail">
	<div class="v_title">
	<h5><p>EVENT </p></h5>
	</div>
	<div class="detail_venue">
	<div class="label-tag">
	<label> Event Category : </label><br>
	<?php echo $meta['e_category']; ?><br>
	</div>
    <?php if ($meta['e_cost'] != NULL){ ?>
	<div class="label-tag">
	<label> Cost : </label><br>
	<?php echo '$'.''.$meta['e_cost']; ?><br>
	</div>
	<?php } ?>
	</div>
	</div>
	<div class="col-sm-4 event_detail">
	<div class="v_title">
	<h5><p>VENUE</p> </h5>
	</div>
	<div class="detail_venue">
	<div class="label-tag">
	<label> Venue Name : </label><br>
	<?php echo $meta['v_name']; ?><br>
	</div>
	<div class="label-tag">
	<label> Address : </label><br>
	<?php echo $meta['v_address']; ?><br>
	</div>
        <?php if ($meta['v_phone'] != NULL){ ?>
	<div class="label-tag">
	<label> Phone : </label><br>
	<?php echo $meta['v_phone']; ?><br>
	</div>
	<?php } ?>
	</div>
	</div>
	<div class="col-sm-4 event_detail">
	<div class="v_title">
	<h5><p>ORGANIZER</p></h5>
	</div>
	<div class="detail_organizer">
	<div class="label-tag">
	<label> Organizer Name : </label><br>
	<?php echo $meta['o_name']; ?><br>
	</div>
	<?php if ($meta['o_phone'] != NULL){ ?>
	<div class="label-tag">
	<label> Phone : </label><br>
	<?php echo $meta['o_phone']; ?><br>
	</div>
	<?php } ?>
	<?php if ($meta['o_email'] != NULL){ ?>
	<div class="label-tag">
	<label> Email : </label><br>
	<?php echo $meta['o_email']; ?><br>
	</div>
	<?php } ?>
	<?php if ($meta['o_website'] != NULL){ ?>
	<div class="label-tag">
	<label> Website : </label><br>
	<a href="<?php echo $meta['o_website']; ?>"><?php echo $meta['o_website']; ?></a><br>
	</div>
	<?php } ?>
	</div>
	</div>
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
