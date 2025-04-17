<!DOCTYPE html>
<html>
<head>
<?php wp_head(); ?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="ICONNBC Website">
<meta name="keywords" content="HTML, CSS, PHP, JavaScript">
</head>
<body <?php body_class(); ?>>
<div id="wraper">
<?php if(is_user_logged_in()):?>
<div class="login-span">
<span><?php
    $current_user = wp_get_current_user();
    echo 'Hello,  ' . $current_user->user_login ;

?> </span>
<div class="login-content">
	<div class="login-info">
	<li><a href="<?php echo wp_login_url(); ?>">Edit My Profile</a></li>
	<li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
	</div>
  </div>
</div>
<?php endif; ?>
<nav class="navbar">
	<div class="container">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>


		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo home_url() ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ICONNBC_logo.png" class="brand-img" width="225"></a>
		</div>
		<div id="navbar" class="collapse navbar-collapse nav-responsive-position">
			<?php bootstrap_nav(); ?>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</nav>
<?php if( is_front_page() ) { ?>
  <div class="container-fluid" id="slide-wraper">
  <div id="myCarousel" class="carousel" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?php bloginfo('template_directory'); ?>/images/home/banner_home_1.jpg" alt="Iconnbc Banner" style="width:100%;">
		  	<div class="carousel-caption d-none d-md-block">
				  <h2 class="reponsive-fonts">Building Platforms for Success</h2>
			</div>
      </div>
      <div class="item">
        <img src="<?php bloginfo('template_directory'); ?>/images/home/banner_home_2.jpg" alt="Iconnbc Banner" style="width:100%;">
			<div class="carousel-caption d-none d-md-block">
				  <h2 class="reponsive-fonts">Various Events for All Businesses </h2>
			</div>
      </div>
      <div class="item">
        <img src="<?php bloginfo('template_directory'); ?>/images/home/banner_home_3.jpg" alt="Iconnbc Banner" style="width:100%;">
		  	<div class="carousel-caption d-none d-md-block">
				  <h2 class="reponsive-fonts">Join Us and Share Our Vision</h2>
			</div>
      </div>
    </div>
  </div>

<?php } ?>
