jQuery(function ($) {
    var mediaFrame,
        image_ids = $.trim($('#image_ids').val()),
        fetchCompleteCount = 0;

    if (image_ids) {
        _.each(image_ids.split(','), function (id, index, list) {
            var attachment = wp.media.attachment(id);
            attachment.fetch().done(function () {
                fetchCompleteCount++;
                if (fetchCompleteCount === list.length) {
                    $('.js-open-media').attr('disabled', false);
                    toggleButton();
                    setPreview();
                }
            });
        });
    } else {
        toggleButton();
        $('.js-open-media').attr('disabled', false);
    }

    $('.js-open-media').click(function () {
        if (!mediaFrame) {
            mediaFrame = wp.media.frames.assisiPhotoFrame = wp.media(getOptions());
            addEventHandler();
        }
        mediaFrame.open();

        setTimeout(function () {
            document.querySelector('.media-button-insert').addEventListener('click', function () {
                setTimeout(function () {
                    $('.describe').attr('placeholder', 'Link');
                }, 100);
            });
        }, 100);
    });

    function getOptions() {
        var models = [],
            options = {
                frame: 'post',
                state: 'gallery-library',
            },
            image_ids = $.trim($('#image_ids').val());

        if (image_ids) {
            _.each(image_ids.split(','), function (id) {
                var attachment = wp.media.attachment(id);
                models.push(attachment);
            });
            options.selection = new wp.media.model.Selection(models, {multiple: true});
        }

        return options;
    }

    function addEventHandler() {
        mediaFrame.on('open', function () {
            if ($.trim($('#image_ids').val())) {
                mediaFrame.setState('gallery-edit');
            }
            // post_excerpt 를 링크 거는 데 사용. 꼼수.
            $('.describe').attr('placeholder', 'Link');
        });

        // 이미지 선택시 실행할 동작
        mediaFrame.on('update', setImageIds);
    }

    function setPreview() {
        $('.js-preview').html('');
        _.each($('#image_ids').val().split(','), function (id) {
            var attachment = wp.media.attachment(id),
                url;
            if (attachment.attributes.sizes.hasOwnProperty('thumbnail')) {
                url = attachment.attributes.sizes.thumbnail.url;
            } else {
                url = attachment.attributes.url;
            }

            $('<img>', {
                'src': url,
                'style': 'margin: 0 .5em .3em 0; width: 150px; height: 150px;',
                'title': '편집하려면 사진 변경 버튼을 누르세요.'
            }).appendTo('.js-preview');
        });
    }

    function toggleButton() {
        $('.js-ing').remove();
        $('.js-open-media').addClass('hidden');
        if ($.trim($('#image_ids').val())) {
            $('.js-update-photo').removeClass('hidden');
        } else {
            $('.js-select-photo').removeClass('hidden');
        }
    }

    function setImageIds(library) {
        var ids = _.pluck(library.toJSON(), 'id').join(',');
        $('#image_ids').val(ids);
        toggleButton();
        setPreview();
    }
});
