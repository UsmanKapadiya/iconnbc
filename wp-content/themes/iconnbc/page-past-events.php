<?php
get_header(); ?>
<div class="page-banner">
<img src="<?php bloginfo('template_directory'); ?>/images/events/banner_iconnbc_event.jpg" class="page-banner-img image-maxwidth">
	<h2 class="reponsive-fonts">
		Connecting, Sharing, and Learning Opportunities
	</h2>
</div>
<div class="body-wraper">
<div class="container" id="home-content">
<!-- <div class="breadcrumb">
<li> ASSOCIATION EVENTS </li>
<li class="active"> PAST EVENTS </li>
</div> -->
<div class="row">
	<div class="row verticallyCenter">
<div class="col-sm-4 col-xs-12">
<h3><strong> PAST EVENTS</strong></h3>
</div>
<div class="col-sm-8 col-xs-12 filter-top-margin">
<?php
include get_theme_file_path( '/filters.php' );
?>
</div>
</div>
</div>

<div class="row past-events-row">
<div class="col-sm-12">
<?php
$currentPage = get_query_var('paged');
$args = array(
	'post_type' => 'past_event',
	'posts_per_page' => 9,
	'paged' => $currentPage
);
$your_loop = new WP_Query( $args );
if ( $your_loop->have_posts() ) : while ( $your_loop->have_posts() ) : $your_loop->the_post();
$meta = get_post_meta( $post->ID, 'past_event', true );
?>

<div class="event_wraper">
<!-- container-fluid	 -->
<div class="">
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
	echo date("F.d.Y", $timestamp).' | '. $meta['e_category'];

//   if( date("H.i",$timestamp) != "00.00"){
    echo "<div style='display: none;'>".$meta."</div>";

    echo "<div style='display: none;'>".date("g.i a",$timestamp)."</div>";
//   }
	?></h6>



	</div>
	<div class="content-summary">
	<p><?php echo $meta['summary']; ?>
	</p>
	</div>

          <div class="call_to_action">
              <a href="<?php the_permalink();?>" class="button">View Details </a>
          </div>

  </div>
</div>
<hr>
</div>
</div>

<?php  endwhile; endif; wp_reset_postdata(); ?>
<?php 
echo "<div class='page-nav-container text-right past-event-pagination'>" . paginate_links(array(
    'total' => $your_loop->max_num_pages,
    'prev_text' => __('<'),
    'next_text' => __('>')
)) . "</div>";
?>
</div>
</div>
</div>
</div>
<?php
get_footer();
?>
