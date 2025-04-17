<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// The CSS files for your theme
function theme_styles() {
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '', 'all');
    wp_enqueue_style('bootstrap-theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css', array('bootstrap-css'), '', 'all');
}

// The JavaScript files for your theme

function theme_js() {
    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array('jquery'), '', true );
}

add_action( 'wp_enqueue_scripts', 'theme_styles' );
add_action( 'wp_enqueue_scripts', 'theme_js' );
add_filter( 'wpcf7_validate_configuration', '__return_false' );

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

// Bootstrap navigation
function bootstrap_nav()
{
	wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'false',
            'menu_class'        => 'nav navbar-nav ml-auto',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
    );
}

// css file.
function website_resources(){
	wp_enqueue_style('style',get_stylesheet_uri());
}
	add_action('wp_enqueue_scripts','website_resources');


//theme setup

function theme_setup(){

	//image path
//	if( !defined(THEME_IMG_PATH)){
  //      wp_enqueue_style( 'THEME_IMG_PATH', get_stylesheet_directory_uri() . '/images' );
	//}
	//add featured image
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 200, 200, true );
	add_image_size( 'banner-img', 718, 500 );

	// Navigation menu
	register_nav_menus(array(
		'primary' => __('Primary Menu'),
		'footer' => __('Footer Menu'),
	));
}
	add_action('after_setup_theme','theme_setup');


add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}



?>


<?php

function create_post_your_post() {
	register_post_type( 'upcoming_event',
		array(
			'labels'       => array(
				'name'       => __( 'Upcoming Event' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'supports'     => array(
				'title',
				'editor',
				'thumbnail',
			),
			'taxonomies'   => array(
				'post_tag',
				'category',
			)
		)
	);
	register_post_type( 'past_event',
		array(
			'labels'       => array(
				'name'       => __( 'Past Event' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'supports'     => array(
				'title',
				'editor',
				'thumbnail',
			),
			'taxonomies'   => array(
				'post_tag',
				'category',
			)
		)
	);
	register_taxonomy_for_object_type( 'category', 'upcoming_event' );
	register_taxonomy_for_object_type( 'post_tag', 'upcoming_event' );
	register_taxonomy_for_object_type( 'category', 'past_event' );
	register_taxonomy_for_object_type( 'post_tag', 'past_event' );
}
add_action( 'init', 'create_post_your_post' );
function add_your_fields_meta_box() {
	add_meta_box(
		'your_fields_meta_box', // $id
		'Your Fields', // $title
		'show_your_fields_meta_box', // $callback
		'upcoming_event', // $screen
		'normal', // $context
		'high' // $priority
	);
	add_meta_box(
		'past_event_meta_box', // $id
		'Your Fields', // $title
		'show_past_event_meta_box', // $callback
		'past_event', // $screen
		'normal', // $context
		'high' // $priority
	);
	add_meta_box(
		'post_meta_box', // $id
		'Your Fields', // $title
		'show_post_meta_box', // $callback
		'post', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );
?>


<?php
function show_post_meta_box() {
	global $post;
		$meta = get_post_meta( $post->ID, 'post', true ); ?>

	<input type="hidden" id="post-form"name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->
	<p>
	<label for="post[e_category]">Event Category</label>
	<br>
	<input type="text" name="post[e_category]" id="post[e_category]" class="e_category" value="<?php echo $meta['e_category']; ?>">
	</p>
	<p>
	<label for="post[date]">Event Date</label>
	<br>
	<input type="date" name="post[date]" id="post[date]" class="regular-date" value="<?php echo $meta['date']; ?>">
	</p>





	<?php }
	function save_post_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'post', true );
	$new = $_POST['post'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'post', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'post', $old );
	}
}
add_action( 'save_post', 'save_post_meta' );


function show_past_event_meta_box() {
	global $post;
		$meta = get_post_meta( $post->ID, 'past_event', true ); ?>

	<input type="hidden" id="post-form"name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->
	<p>
	<label for="past_event[e_category]">Event Category</label>
	<br>
	<input type="text" name="past_event[e_category]" id="past_event[e_category]" class="e_category" value="<?php echo $meta['e_category']; ?>">
	</p>
	<p>
	<label for="past_event[e_detail]">Event Detail</label>
	<br>
	<div><?php echo wp_editor($meta['e_detail'],"event_detail",array( 
		'wpautop' => false, 
		'media_buttons' => false,
		'textarea_name'=>'past_event[e_detail]'
// 		'quicktags' => array(
// 				'buttons' => 'strong,em,del,ul,ol,li,block,close'
// 			),
	)); ?></div>
		</p>
	<p>
	<label for="past_event[summary]">Summary (100-word)</label>
	<br>
	<textarea rows="2" cols="100" maxlength="200" name="past_event[summary]" id="past_event[summary]"><?php echo $meta['summary']; ?>
	</textarea>
	</p>
	<p>
	<label for="past_event[date]">Event Date</label>
	<br>
	<input type="date" name="past_event[date]" id="past_event[date]" class="regular-date" value="<?php echo $meta['date']; ?>">
	</p>





	<?php }
	function save_past_event_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'past_event', true );
	$new = $_POST['past_event'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'past_event', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'past_event', $old );
	}
}
add_action( 'save_post', 'save_past_event_meta' );






function show_your_fields_meta_box() {
	global $post;
		$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

	<input type="hidden" id="post-form"name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->
	<p>
	<label for="your_fields[e_category]">Event Category</label>
	<br>
	<input type="text" name="your_fields[e_category]" id="your_fields[e_category]" class="e_category" value="<?php echo $meta['e_category']; ?>">
	</p>
	<p>
	<label for="your_fields[e_category]">Event Cost</label>
	<br>
	<input type="number" step="any" name="your_fields[e_cost]" id="your_fields[e_cost]" class="e_cost" value="<?php echo $meta['e_cost']; ?>">
	</p>
	<p>
	<label for="your_fields[date]">Event Date</label>
	<br>
	<input type="date" name="your_fields[date]" id="your_fields[date]" class="regular-date" value="<?php echo $meta['date']; ?>">
	</p>
	<p>
	<label for="your_fields[date]">Event Time</label>
	<br>
	<input type="time" name="your_fields[time]" id="your_fields[time]" class="regular-time" value="<?php echo $meta['time']; ?>">
	</p>
	<p>
	<label for="your_fields[v_name]">Venue Name</label>
	<br>
	<input type="text" name="your_fields[v_name]" id="your_fields[v_name]" class="v_name" value="<?php echo $meta['v_name']; ?>">
	</p>
	<p>
	<label for="your_fields[v_address]">Venue Address</label>
	<br>
	<input type="text" name="your_fields[v_address]" id="your_fields[v_address]" class="v_address" value="<?php echo $meta['v_address']; ?>">
	</p>
	<p>
	<label for="your_fields[v_phone]">Venue Phone</label>
	<br>
	<input type="tel" name="your_fields[v_phone]" id="your_fields[v_phone]" class="v_phone" value="<?php echo $meta['v_phone']; ?>">
	</p>
	<p>
	<label for="your_fields[o_name]">Oraganizer Name</label>
	<br>
	<input type="text" name="your_fields[o_name]" id="your_fields[o_name]" class="o_name" value="<?php echo $meta['o_name']; ?>">
	</p>
	<p>
	<label for="your_fields[o_phone]">Organizer Phone</label>
	<br>
	<input type="tel" name="your_fields[o_phone]" id="your_fields[o_phone]" class="o_phone" value="<?php echo $meta['o_phone']; ?>">
	</p>
	<p>
	<label for="your_fields[o_email]">Organizer Email</label>
	<br>
	<input type="email" name="your_fields[o_email]" id="your_fields[o_email]" class="o_email" value="<?php echo $meta['o_email']; ?>">
	</p>
	<p>
	<label for="your_fields[o_website]">Organizer Website</label>
	<br>
	<input type="url" name="your_fields[o_website]" id="your_fields[o_website]" class="o_website" value="<?php echo $meta['o_website']; ?>">
	</p>



	<?php }
	function save_your_fields_meta( $post_id ) {
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	$old = get_post_meta( $post_id, 'your_fields', true );
	$new = $_POST['your_fields'];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, 'your_fields', $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, 'your_fields', $old );
	}
}
add_action( 'save_post', 'save_your_fields_meta' );

function my_function( $post_id )
        {
			global $post;
			if ($post->post_type == "upcoming_event") {

			$meta = get_post_meta( $post->ID, 'your_fields', true );

			}
			elseif ($post->post_type == "past_event") {

			$meta = get_post_meta( $post->ID, 'past_event', true );

			}
			else{
			$meta = get_post_meta( $post->ID, 'post', true );
			}
			$timestamp = strtotime($meta['date'].''.$meta['time']);

            $postdate = date("Y.m.d H:i:s", $timestamp);

            $my_args = array(
               'ID' => $post_id,
			   'post_date' => $postdate,

            );

            if ( ! wp_is_post_revision( $post_id ) ){

                    // unhook this function so it doesn't loop infinitely
                    remove_action('save_post', 'my_function');

                    // update the post, which calls save_post again
                    wp_update_post( $my_args );

                    // re-hook this function
                    add_action('save_post', 'my_function');
            }

		}
        add_action('save_post', 'my_function');

/**
 * Set the size attribute to 'full' in the next gallery shortcode.
 */
function wpse_141896_shortcode_atts_gallery( $out )
{
    remove_filter( current_filter(), __FUNCTION__ );
    $out['size'] = 'full';
    return $out;
}



function get_post_gallery_images_with_info($postvar = NULL) {
    if(!isset($postvar)){
        global $post;
        $postvar = $post;//if the param wasnt sent
    }


    $post_content = $postvar->post_content;
    preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
    $images_id = explode(",", $ids[1]); //we get the list of IDs of the gallery as an Array


    $image_gallery_with_info = array();
    //we get the info for each ID
    foreach ($images_id as $image_id) {
        $attachment = get_post($image_id);
        array_push($image_gallery_with_info, array(
            'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink($attachment->ID),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
                )
        );
    }
    return $image_gallery_with_info;
}
add_action('wpcf7_before_send_mail', 'handle_contact_form_submission', 10, 1);
function handle_contact_form_submission($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $posted_data = $submission->get_posted_data();

        // Extract and process dynamic guest fields
        $numGuests = isset($posted_data['num_guests']) ? intval($posted_data['num_guests']) : 0;
       if ($numGuests > 0) {
    $guestsInfo = '';

    // Define column widths
    $nameWidth = 20;
    $saladWidth = 30;
    $soupWidth = 30;
    $entreeWidth = 40;

    // Add header row
    $guestsInfo .= str_pad('Name', $nameWidth) . str_pad('Salad', $saladWidth) . str_pad('Soup', $soupWidth) . str_pad('Entree', $entreeWidth) . "\n";
    $guestsInfo .= str_repeat('-', $nameWidth + $saladWidth + $soupWidth + $entreeWidth) . "\n";  // Add a separator line

    for ($i = 1; $i <= $numGuests; $i++) {
        $guestName = isset($posted_data["guest-${i}-name"]) ? sanitize_text_field($posted_data["guest-${i}-name"]) : '';
        $guestSalad = isset($posted_data["guest-${i}-salad"]) ? sanitize_text_field($posted_data["guest-${i}-salad"]) : '';
        $guestSoup = isset($posted_data["guest-${i}-soup"]) ? sanitize_text_field($posted_data["guest-${i}-soup"]) : '';
        $guestEntree = isset($posted_data["guest-${i}-entree"]) ? sanitize_text_field($posted_data["guest-${i}-entree"]) : '';

        // Add guest information with padding to align columns
        $guestsInfo .= str_pad($guestName, $nameWidth) . 
                       str_pad($guestSalad, $saladWidth) . 
                       str_pad($guestSoup, $soupWidth) . 
                       str_pad($guestEntree, $entreeWidth) . "\n";
    }

    // Update the email body with guest information
    $mail = $contact_form->prop('mail');
    $mail['body'] .= "\n\nGuests Information:\n" . $guestsInfo;
    $contact_form->set_properties(array('mail' => $mail));
}


    }
}
?>


  <?php
                function enqueue_inline_dynamic_guest_script() {
                    // Enqueue jQuery as a dependency (or any other script)
                    wp_enqueue_script('jquery');
                    
                    // Your inline JavaScript
                    $inline_script = '
                    document.addEventListener("DOMContentLoaded", function () {
                        const numGuestsField = document.getElementById("num-guests");
                        const guestFieldsContainer = document.getElementById("guest-fields-container");
                
                        numGuestsField.addEventListener("input", function () {
                            const numGuests = parseInt(this.value, 10);
                            guestFieldsContainer.innerHTML = "";
                
                            for (let i = 1; i <= numGuests; i++) {
                                const guestFieldHTML = `
                                   <div class="form-row mb-20 m-5">
    									<div class="column-full" style="width:99% !important">
											<label class="custom-label" for="guest-${i}-name">Full Name</label>
											<input type="text" name="guest-${i}-name" id="guest-${i}-name" class="guest-												input-bg full-width-input"
												placeholder="Enter Guest ${i} Full Name" required>
										</div>
									</div>
									<div class="form-row mb-20">
										<div class="column-full mt-10" style="text-align:center">
											<label class="custom-label">Dinner Menu Selection</label>
										</div>
									</div>
									<div class="form-row mb-20">
									<div class="column-full">

									<div class="menu-options">
										<div class="row" style="margin:-5px;padding-left:10px">
													<div class="column-third-custom" style="padding-top:0px">
														<label for="guest-${i}-salad" class="custom-label">Salad</label>
														<select name="guest-${i}-salad" id="guest-${i}-salad" class="guest-input-bg"
															style="color:#000000">
															<option value="">Select Salad</option>
															<option value="Tuna Tataki Salad">Tuna Tataki Salad</option>
															<option value="Romaine Hearts & Kale Caesar Salad">Romaine Hearts & Kale Caesar Salad</option>
														</select>
													</div>
													<div class="column-third-custom" style="padding-top:0px">
														<label for="guest-${i}-soup" class="custom-label">Soup</label>
														<select name="guest-${i}-soup" id="guest-${i}-soup" class="guest-input-bg"
															style="color:#000000">
															<option value="">Select Soup</option>
															<option value="Truffle & Cauliflower">Truffle & Cauliflower</option>
															<option value="Lobster Bisque">Lobster Bisque</option>
														</select>
													</div>
													<div class="column-third-custom" style="padding-top:0px">
														<label for="guest-${i}-entree" class="custom-label">Entrée</label>
														<select name="guest-${i}-entree" id="guest-${i}-entree" class="guest-input-bg custom-drop-down"
															style="color:#000000">
															<option value="">Select Entrée</option>
															<option value="Port Wine Braised Boneless Certified Angus Beef Short Rib">Port Wine Braised Boneless Certified Angus Beef Short Rib</option>
															<option value="Sablefish en Papillote with Miso Glaze, Sesame Seeds, & Scallions">Sablefish en Papillote with Miso Glaze, Sesame Seeds, & Scallions</option>
															<option value="Ragu of Moroccan Spiced Lentils with Citrus">Ragu of Moroccan Spiced Lentils with Citrus</option>
														</select>
													</div>
												</div>

									</div>	
								</div>
							</div>

							  <div class="form-row mb-20 m-5">
    									<div class="column-full" style="width:97% !important">
	 							 <hr style="border-top: 1px solid #ccc; margin-bottom: 20px;margin-top:20px">
								 </div>
								 </div>
                                `;
                                guestFieldsContainer.innerHTML += guestFieldHTML;
                            }
                
                            // Re-initialize Contact Form 7 listeners
                            if (typeof wpcf7 !== "undefined" && typeof wpcf7.initForm !== "undefined") {
                                wpcf7.initForm(document.querySelector(".wpcf7-form"));
                            }
                        });
                    });
                    ';
                    
                    // Add the inline script
                    wp_add_inline_script('jquery', $inline_script);
                }
                add_action('wp_enqueue_scripts', 'enqueue_inline_dynamic_guest_script');
                ?>
<?php
                function enqueue_inline_dynamic_guest_script_cn() {
                    // Enqueue jQuery as a dependency (or any other script)
                    wp_enqueue_script('jquery');
                    
                    // Your inline JavaScript
                    $inline_script = '
                    document.addEventListener("DOMContentLoaded", function () {
                        const numGuestsField = document.getElementById("num-guests");
                        const guestFieldsContainer = document.getElementById("guest-fields-container-cn");
                
                        numGuestsField.addEventListener("input", function () {
                            const numGuests = parseInt(this.value, 10);
                            guestFieldsContainer.innerHTML = "";
                
                            for (let i = 1; i <= numGuests; i++) {
                                const guestFieldHTML = `
                                       <!-- <div class="form-row mb-20" >
                                        <div class="column-half">
                                            <label class="custom-label" for="guest-${i}-name">全名</label>
                                            <input type="text" name="guest-${i}-name" id="guest-${i}-name" class="guest-input-bg" placeholder="輸入訪客 ${i} 全名" required>
                                        </div>
                                        <div class="column-half">
                                            <label class="custom-label" for="num_guests">餐點選項</label>
                                             <select name="guest-${i}-meal" id="guest-${i}-meal" class="guest-input-bg" style="color:#000000">
                                                <option value="">選擇餐食</option>
                                                <option value="Beef">牛肉</option>
                                                <option value="Chicken">雞肉</option>
                                                <option value="Vegetarian">素食</option>
                                            </select>       
                                        </div>
                                        </div> -->
										<div class="form-row mb-20 m-5">
	<div class="column-full" style="width:99% !important">
		<label class="custom-label" for="guest-${i}-name">全名</label>
		<input type="text" name="guest-${i}-name" id="guest-${i}-name" class="guest-												input-bg full-width-input"
			placeholder="輸入訪客 ${i} 全名" required>
	</div>
</div>
	<div class="form-row mb-20">
										<div class="column-full mt-10" style="text-align:center">
											<label class="custom-label">晚餐菜單選擇</label>
										</div>
									</div>
									<div class="form-row mb-20">
									<div class="column-full">

									<div class="menu-options">
										<div class="row" style="margin:-5px;padding-left:10px">
													<div class="column-third-custom" style="padding-top:0px">
														<label for="guest-${i}-salad" class="custom-label">沙律</label>
														<select name="guest-${i}-salad" id="guest-${i}-salad" class="guest-input-bg"
															style="color:#000000">
															<option value="">選擇沙律</option>
															<option value="Tuna Tataki Salad">炙燒鮪魚沙律</option>
															<option value="Romaine Hearts & Kale Caesar Salad">生菜心羽衣甘藍凱撒沙律</option>
														</select>
													</div>
													<div class="column-third-custom" style="padding-top:0px">
														<label for="guest-${i}-soup" class="custom-label">湯</label>
														<select name="guest-${i}-soup" id="guest-${i}-soup" class="guest-input-bg"
															style="color:#000000">
															<option value="">選擇湯</option>
															<option value="Truffle & Cauliflower">黑松露椰菜花湯</option>
															<option value="Lobster Bisque">龍蝦湯</option>
														</select>
													</div>
													<div class="column-third-custom" style="padding-top:0px">
														<label for="guest-${i}-entree" class="custom-label">主菜</label>
														<select name="guest-${i}-entree" id="guest-${i}-entree" class="guest-input-bg custom-drop-down"
															style="color:#000000">
															<option value="">選擇主菜</option>
															<option value="Port Wine Braised Boneless Certified Angus Beef Short Rib">波特酒燜無骨安格斯牛小排</option>
															<option value="Sablefish en Papillote with Miso Glaze, Sesame Seeds, & Scallions">味噌釉黑貂魚</option>
															<option value="Ragu of Moroccan Spiced Lentils with Citrus">柑橘醬摩洛哥五香扁豆</option>
														</select>
													</div>
												</div>

									</div>	
								</div>
							</div>

							  <div class="form-row mb-20 m-5">
    									<div class="column-full" style="width:97% !important">
	 							 <hr style="border-top: 1px solid #ccc; margin-bottom: 20px;margin-top:20px">
								 </div>
								 </div>
                                `;
                                guestFieldsContainer.innerHTML += guestFieldHTML;
                            }
                
                            // Re-initialize Contact Form 7 listeners
                            if (typeof wpcf7 !== "undefined" && typeof wpcf7.initForm !== "undefined") {
                                wpcf7.initForm(document.querySelector(".wpcf7-form"));
                            }
                        });
                    });
                    ';
                    
                    // Add the inline script
                    wp_add_inline_script('jquery', $inline_script);
                }
                add_action('wp_enqueue_scripts', 'enqueue_inline_dynamic_guest_script_cn');
                ?>


  <?php
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('https://iconnbc.com/wp-content/themes/iconnbc/images/ICONNBC_logo.png');
            height: 65px;
			width: 320px;
			background-size: contain;
			background-repeat: no-repeat;
			padding-bottom: 30px;
			display: block;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

?>
<?php
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
?>


