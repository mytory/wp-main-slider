<?php
$image_ids = get_post_meta( get_the_ID(), "_{$this->postTypeKey}_image_ids", true );
?>
<p>
    <span class="js-ing">로딩중...</span>
    <button disabled type="button" class="button js-open-media  js-select-photo  hidden">사진 선택</button>
    <button disabled type="button" class="button js-open-media  js-update-photo  hidden">사진 변경</button>
</p>
<input type="hidden" name="_<?php echo $this->postTypeKey; ?>_image_ids"
       id="image_ids" value="<?php echo $image_ids ?>">
<div class="js-preview"></div>