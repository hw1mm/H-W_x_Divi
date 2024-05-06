jQuery(document).ready(function ($) {
    // Media Upload Button
    $('.media-upload-button').each(function () {
        $(this).click(function () {
            button = $(this);
            var frame = wp.media({
                title: 'Medien auswählen',
                button: {
                    text: 'Einfügen'
                },
                multiple: false,
                library: {
                    type: ['video']
                },
            });

            frame.open();

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                var url = attachment.url;

                // Do something with the URL
                console.log($('video[data-input="' + $(button).attr('data-input') + '"] source'));

                // Set the value of the input field
                // $(this).val(url);

                $('#' + $(button).attr('data-input')).val(url);
                $($('video[data-input="' + $(button).attr('data-input') + '"] source')).attr('src', url);
                $($('video[data-input="' + $(button).attr('data-input') + '"]')).load();
            });
        })
    });
    $('.image-upload-button').each(function () {
        $(this).click(function () {
            button = $(this);
            var frame = wp.media({
                title: 'Bild auswählen',
                button: {
                    text: 'Einfügen'
                },
                multiple: false,
                library: {
                    type: ['image']
                },
            });

            frame.open();

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                var url = attachment.url;

                // Do something with the URL
                console.log($('video[data-input="' + $(button).attr('data-input') + '"] source'));

                // Set the value of the input field
                // $(this).val(url);

                $('#' + $(button).attr('data-input')).val(url);
                console.log($(button).attr('data-input'))
                console.log($($('img[data-input="' + $(button).attr('data-input') + '"]')))
                $($('img[data-input="' + $(button).attr('data-input') + '"]')).attr('src', url);
            });
        })
    });
});