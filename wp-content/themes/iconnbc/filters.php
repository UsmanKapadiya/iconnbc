<div id="primary" class="sidebar">
    <?php do_action('before_sidebar'); ?>
    <?php if (!dynamic_sidebar('sidebar-primary')) : ?>
        <!--
        <aside id="search" class="widget widget_search">
           <?php get_search_form(); ?>
        </aside>
        -->
        <div class="row">
        <div class="col-sm-6 col-xs-12">
        <aside id="archives" class="widget">
            <!-- <h5 class="widget-title">
                <p><?php _e('ARCHIVES', 'shape'); ?></p>
            </h5> -->
			<label for="archive-dropdown"><?php echo esc_html__('FILTER BY YEARS', 'shape'); ?>:</label>
            <select id="archive-dropdown" name="m" onchange="applyArchiveFilter(this.value)" class="select-width" style="border: none;"> 
                <option value=""><?php echo esc_html__('ALL', 'shape'); ?></option>
                <?php
                // Display archive options
                $archive_args = array(
                    'type'     => 'yearly',
                    'format'   => 'option',
                    'post_type' => is_page('past-events') || ($post->post_type == 'past_event') ? 'past_event' : 'post',
                );
                echo wp_get_archives($archive_args);
                ?>
            </select>
        </aside>

        <script>
            function applyArchiveFilter(value) {
                if (value !== '') {
                    window.location.href = value;
                }
            }
        </script>

        <!--
        <aside id="meta" class="widget">
            <h5 class="widget-title"><p><?php _e('META', 'shape'); ?></p></h5>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
        -->
        </div>
        <div class="col-sm-6 col-xs-12">
       <aside id="category" class="widget">
            <!-- <h5 class="widget-title">
                <p><?php _e('CATEGORIES'); ?></p>
            </h5> -->
		     <label for="category-dropdown"><?php echo esc_html__('FILTER BY CATEGORY', 'shape'); ?>:</label>
            <select id="category-dropdown" name="cat" onchange="window.location.href=this.value" class="select-width"  style="border: none;">
                <?php
                if (is_page('past-events') || ($post->post_type == 'past_event')) {
                    $category_ids = get_all_category_ids();
                    $args         = array('orderby' => 'slug', 'parent' => 0);
                    $categories   = get_categories($args);
                    // Display the "All" option
                    echo '<option value="' . esc_url(home_url('/')) . '">' . esc_html__('ALL', 'shape') . '</option>';
            
                    foreach ($categories as $category) {
                        $category_link = esc_url(add_query_arg('post_type', 'past_event', get_category_link($category->term_id)));
                        $selected      = ($category->term_id == get_query_var('cat')) ? 'selected="selected"' : '';
                        echo '<option value="' . $category_link . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                    }
                } else {
                    $category_dropdown_args = array(
                        'show_option_none' => __('ALL categories', 'shape'),
                        'show_count'       => 1,
                        'orderby'          => 'name',
                        'echo'             => 0,
                    );
                    $category_dropdown     = wp_dropdown_categories($category_dropdown_args);

                    // Modify the "select" tag to include the onchange attribute
                    echo preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $category_dropdown);
                }
                ?>
            </select>
        </aside>
        </div>
    <?php endif; ?>
</div>
