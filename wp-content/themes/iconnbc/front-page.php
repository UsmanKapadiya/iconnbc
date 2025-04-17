<?php
get_header();
?>
<div class="home-body-wraper" style="padding-top:0px;">
<div class="container" id="home-content">
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

<!-- <div class="container-fluid" style="padding: 0;">
<div class="row" id="banner-row">
<div class="col-sm-6" id="banner-mission">
<h4>OUR MISSION</h4>
To promote traditional Canadian values and share business knowledge.
</div>
<div class="col-sm-6" id="banner-mandate">
<h4>OUR MANDATE</h4>
To build a platform for new entrepreneurs, small and medium sized businesses.
</ul>
</div>

</div>
<div class="row" id="link-row">
<div class="col-sm-6" id="link-aboutus">
<a href="about-us"> Meet Our Board of Directors
<span class="glyphicon glyphicon-chevron-right"></span>
</a>
</div>
<div class="col-sm-6" id="link-membership">
<a href="membership">Apply for Membership
<span class="glyphicon glyphicon-chevron-right"></span>
</a>
</div>
</div>
</div> -->
<?php
get_footer();
?>
