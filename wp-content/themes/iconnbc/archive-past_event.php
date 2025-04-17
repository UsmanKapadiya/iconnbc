<?php 
get_header(); ?>
<div class="body-wraper">
<div class="container" id="home-content">
<!-- <h3 style="padding-bottom: 25px;padding-top: 15px;"><strong> Archive 1</strong></h3> -->
<div class="row">
	<div class="row verticallyCenter">
<div class="col-sm-4">
<h3><strong> Archive</strong></h3>
</div>
<div class="col-sm-8 filter-top-margin">
<?php
include get_theme_file_path( '/filters.php' );
?>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-9">
<?php
$currentPage = get_query_var('paged');
$args = array(
	'post_type' => 'past_event',
	'posts_per_page' => 9,
	'paged' => $currentPage
);
$your_loop = new WP_Query( $args );
if (have_posts()):
	while (have_posts() ) : the_post();
	$meta = get_post_meta( $post->ID, 'past_event', true );
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
	echo date("F.d.Y", $timestamp).' | '. $meta['e_category']; 
    echo "<div style='display: none;'>".$meta."</div>";

    echo "<div style='display: none;'>".date("g.i a",$timestamp)."</div>";
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

<?php  endwhile; 
	else :
    	echo 'No post found';
	endif; ?>
	<div class='page-nav-container text-right archive-pagination'>
        <?php 
            the_posts_pagination( array(
               'prev_text' => __( 'Previous Page', '<'),
               'next_text' => __( 'Next Page', '>'),
               'screen_reader_text' => ('')
            )); 
        ?>
    </div>
</div>



</div>
</div>
</div>
<?php
get_footer();
?>