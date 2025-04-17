<?php
get_header();
if (have_posts()):
	while ( have_posts() ) : the_post();
	$meta = get_post_meta( $post->ID, 'past_event', true );
	?>

	<div class="body-wraper">
	<div class="container" id="home-content">
	<div class="breadcrumb">
	<li> ASSOCIATION EVENTS </li>
	<li><a href="<?php echo home_url() ?>/past-events"> PAST EVENTS</a> </li>
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
	$timestamp = strtotime($meta['date']);
	echo date("F.d.Y", $timestamp).' | '. $meta['e_category']; ?>
	</div>
	</div>
	</div>
	<hr>
	<div class="row">
	<div class="col-sm-12">
	<div class="blog_content">
	<?php echo $meta['e_detail']; ?>
	</div>
	</div>
	</div>
	<div class="row">
	<?php
	global $post;
	$count=0;
	$gallery = get_post_gallery_images_with_info($post); //you can use it without params too
    foreach( $gallery as $image_obj ) {
	$count++;
	?>
	<div class="col-sm-3 gallery-img">
	<figure style="margin: 0px !important" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
        <img src="<?=$image_obj['src'];?>" id="gallery-image" class="image" itemprop="thumbnail" alt="" onclick="openModal();currentSlide(<?php echo $count; ?>)">
	</figure>
	<p> <?php echo $image_obj['caption']; ?></p>
	</div>
	<?php
}
?>

<div id="myModal" class="modal">
  <span class="cursor" id ="close-button" onclick="closeModal()">&times;</span>
  <div class="modal-container">
	<?php
	global $post;
	// Use full size gallery images for the next gallery shortcode:
	add_filter( 'shortcode_atts_gallery', 'wpse_141896_shortcode_atts_gallery' );

	$gallery = get_post_gallery_images( $post );

	foreach( $gallery as $image_url ) {
	?>
    <div class="mySlides">
      <img id="modal-image" src="<?php echo $image_url ?>">
    </div>
	<?php
}
?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>


  </div>
</div>



	</div>
	</div>
	</div>
	<?php
	endwhile;
	else :
	echo 'No post found';
	endif;

?>
<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;

}
</script>
<?php
get_footer();
?>
