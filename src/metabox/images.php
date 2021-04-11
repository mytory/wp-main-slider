<?php
$_mytory_slider_image_ids = get_post_meta(get_the_ID(), '_mytory_slider_image_ids', true);
?>
<p>
    <span class="js-ing">로딩중...</span>
    <button disabled type="button" class="button js-open-media  js-select-photo  hidden">사진 선택</button>
    <button disabled type="button" class="button js-open-media  js-update-photo  hidden">사진 변경</button>
</p>
<input type="hidden" name="_mytory_slider_image_ids" id="_mytory_slider_image_ids" value="<?php echo $_mytory_slider_image_ids ?>">
<div class="js-preview"></div>