<?php
global $post;
$options = array();
$options['autoplay'] = get_post_meta($post->ID, '_autoplay', true);
if (!$options['autoplay']) {
    $options['autoplay'] = 0;
}
$options['pagination'] = get_post_meta($post->ID, '_pagination', true);
if (!$options['pagination']) {
    $options['pagination'] = 'bullets';
}

?>
<table class="form-table">
    <tbody>
    <?php
    if ($post->ID) { ?>
    <tr>
        <th scope="row">
            <?php _e('Shortcode', 'wp-main-slider') ?>
        </th>
        <td>
            <input type="text" class="regular-text  js-shortcode" readonly value="[mytory_slider id=<?php echo $post->ID ?>]" title="shortcode">
        </td>
    </tr>
    <?php } ?>
    <tr>
        <th scope="row">
            <?php _e('Auto play(milli seconds)', 'wp-main-slider') ?>
        </th>
        <td>
            <input type="text" class="regular-text" title="autoplay milli seconds"
                   name="mytory_slider[_autoplay]"
                   value="<?php echo $options['autoplay'] ?>">
            <p class="help"><?php _e('Set 0 to disable autoplay.', 'wp-main-slider') ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <?php _e('Pagination', 'wp-main-slider') ?>
        </th>
        <td>
            <p>
                <label>
                    <input type="radio" name="mytory_slider[_pagination]" value="bullets"
                        <?php attr_checked('bullets', $options['pagination']) ?>>
                    <?php _e('bullets', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="mytory_slider[_pagination]" value="fraction"
                        <?php attr_checked('fraction', $options['pagination']) ?>>
                    <?php _e('fraction', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="mytory_slider[_pagination]" value="progressbar"
                        <?php attr_checked('progressbar', $options['pagination']) ?>>
                    <?php _e('progressbar', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="mytory_slider[_pagination]" value="none"
                        <?php attr_checked('none', $options['pagination']) ?>>
                    <?php _e('None', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="mytory_slider[_pagination]" value="thumbnail"
                        <?php attr_checked('thumbnail', $options['pagination']) ?>>
                    <?php _e('Thumbnail', 'wp-main-slider') ?>
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="mytory_slider[_pagination]" value="text"
                        <?php attr_checked('text', $options['pagination']) ?>>
                    <?php _e('Text', 'wp-main-slider') ?>
                </label>
                &nbsp;&nbsp;&nbsp;
                <span class="description">텍스트 내비게이션은 사진의 '제목' 값을 사용합니다. '사진변경'에서 개별 사진을 선택하신 뒤, 우측 하단에 있는 제목을 수정하시면 됩니다.</span>
            </p>
        </td>
    </tr>
    </tbody>
</table>
