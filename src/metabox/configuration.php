<?php
global $post;
$options = array();
$options['autoplay'] = get_post_meta($post->ID, '_mytory_slider_autoplay', true) ?: '0';
$options['pagination'] = get_post_meta($post->ID, '_mytory_slider_pagination', true) ?: 'bullets';
$options['is_main'] = get_post_meta(get_the_ID(), '_mytory_slider_is_main', true) ?: '0';
?>
<table class="form-table">
    <tbody>
    <tr>
        <th scope="row">
            <?php _e('Auto play(milli seconds)', 'wp-main-slider') ?>
        </th>
        <td>
            <input type="text" class="regular-text" title="autoplay milli seconds"
                   name="<?php echo $this->postTypeKey; ?>[_mytory_slider_autoplay]"
                   value="<?php echo $options['autoplay'] ?>">
            <p class="help"><?php _e('Set 0 to disable autoplay.', 'wp-main-slider') ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row">
	        <?php _e('Set to Main Slider', 'wp-main-slider') ?>
        </th>
        <td>
            <p>
                <label style="margin-right: 1em;">
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_is_main]" value="1"
			            <?php attr_checked('1', $options['is_main'], false) ?>>
		            <?php _e('Yes', 'wp-main-slider') ?>
                </label>
                <label>
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_is_main]" value="0"
			            <?php attr_checked('0', $options['is_main'], true) ?>>
		            <?php _e('No', 'wp-main-slider') ?>
                </label>
            </p>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <?php _e('Pagination', 'wp-main-slider') ?>
        </th>
        <td>
            <p>
                <label>
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_pagination]" value="bullets"
                        <?php attr_checked('bullets', $options['pagination']) ?>>
                    <?php _e('bullets', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_pagination]" value="fraction"
                        <?php attr_checked('fraction', $options['pagination']) ?>>
                    <?php _e('fraction', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_pagination]" value="progressbar"
                        <?php attr_checked('progressbar', $options['pagination']) ?>>
                    <?php _e('progressbar', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_pagination]" value="none"
                        <?php attr_checked('none', $options['pagination']) ?>>
                    <?php _e('None', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_pagination]" value="thumbnail"
                        <?php attr_checked('thumbnail', $options['pagination']) ?>>
                    <?php _e('Thumbnail', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="<?php echo $this->postTypeKey; ?>[_mytory_slider_pagination]" value="text"
                        <?php attr_checked('text', $options['pagination']) ?>>
                    <?php _e('Text', 'wp-main-slider') ?>
                </label>
                &nbsp;&nbsp;&nbsp;
                <span class="description"><?php _e('It uses the title of attached image.', 'wp-main-slider'); ?></span>
            </p>
        </td>
    </tr>
    <?php
    if ($post->ID) { ?>
        <tr>
            <th scope="row">
			    <?php _e('Shortcode', 'wp-main-slider') ?>
            </th>
            <td>
                <input type="text" class="regular-text  js-shortcode" readonly value="[<?php echo $this->postTypeKey; ?> id=<?php echo $post->ID ?>]" title="shortcode">
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<script>
    window.mytory_slider_translation = {
        'link': '<?php _e('Link', 'wp-main-slider'); ?>'
    }
</script>