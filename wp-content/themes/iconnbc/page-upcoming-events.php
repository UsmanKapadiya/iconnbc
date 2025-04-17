<?php
get_header();
?>
<div class="body-wraper">
<div class="container" id="home-content">
<div class="breadcrumb">
<li> ASSOCIATION EVENTS </li>
<li class="active"> UPCOMING EVENTS </li>
</div>
<div class="row">
<div class="col-sm-12 col-md-9">
<h3 style="padding-bottom: 25px;padding-top: 15px;"><strong> UPCOMING EVENTS</strong></h3>

<?php
$args = array(
	'post_type' => 'upcoming_event',
	'orderby' => '$timestamp',
	'order' => 'ASC'
);
$your_loop = new WP_Query( $args );

if ( $your_loop->have_posts() ) : while ( $your_loop->have_posts() ) : $your_loop->the_post();
$meta = get_post_meta( $post->ID, 'your_fields', true );
$current_month = get_the_date('F');

if( $your_loop->current_post === 0 ) { ?>

	<div class="month_wraper">
	<div class="container-fluid">
	<h5 style="margin: 5px 0px;">
   <?php the_date( 'F Y' ); ?>
   </h5>
   </div>
   </div>
<?php
}

else{

    $f = $your_loop->current_post - 1;
    $old_date =   mysql2date( 'F', $your_loop->posts[$f]->post_date );

    if($current_month != $old_date) {?>

	<div class="month_wraper">
	<div class="container-fluid">
	<h5 style="margin: 5px 0px;">
   <?php the_date( 'F Y' ); ?>
   </h5>
   </div>
   </div>
<?php

    }

}
?>

<div class="event_wraper">
<div class="container-fluid">
<div class="row" id="event-container">
  <div class="col-sm-3 date-block" style="padding: 0;">
	<div class="event_date">
	<?php
	$timestamp = strtotime($meta['date']);
	$day = date('l', $timestamp);
	$date = date('d', $timestamp);
	$month = date('F', $timestamp);
	$year = date('Y', $timestamp);
	?>
	<div class="e_date">
	<?php echo $date; ?>
	</div>
	</div>
	<div class="mdt">
	<div class="e_month">
	<?php echo $month; ?>
	</div>
	<div class="e_day">
	<?php echo $day; ?>
	</div>
	<div class="event_time">
	<?php
	$time = strtotime($meta['time']);
	echo date('h:i A', $time);; ?>
	</div>
	</div>
  </div>
  <div class="col-sm-9">
	<div class="event_title">
	<h4 class="event_title" ><?php the_title(); ?></h4>
	</div>
	<div class="event_category">
	<h6 class="event_category"><?php echo $meta['e_category']; ?></h6>
	</div>
	<div class="event_venue">
	<h7><?php echo $meta['v_name']; ?>, <?php echo $meta['v_address']; ?></h7>
	</div>
	<div class="call_to_action">
	<a href="<?php the_permalink();?>" class="button">Find Out More </a>
	</div>
  </div>
</div>
<hr>

</div>
</div>
<?php
endwhile; else:?>
<p>No Events Found </p>
<?php endif; wp_reset_postdata(); ?>
</div>
<div class="col-sm-12 col-md-3 adv" class="img-responsive">
	<!-- adv img -->
</div>
</div>
</div>
</div>
<?php
get_footer();
?>
