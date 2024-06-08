// BotPress Bubbel
document.addEventListener('DOMContentLoaded', function() {
    function initializeBotpress() {
        if (typeof window.botpressWebChat !== 'undefined') {
            window.botpressWebChat.init(botpressConfig);

// Calently Event Trigger
            window.botpressWebChat.onEvent(
                function (event) {
                    if (event.type === 'TRIGGER') {
                        Calendly.showPopupWidget(botpressConfig.calendlyUrl);
                    }
                },
                ['TRIGGER']
            );
        } else {
            console.error('Botpress WebChat script not loaded');
        }
    }

// // Check periodically if the Botpress script is loaded
    var botpressInterval = setInterval(function() {
        if (typeof window.botpressWebChat !== 'undefined') {
            clearInterval(botpressInterval);
            initializeBotpress();
        }
    }, 100);

// // Avatar URL Medien-Uploader
    jQuery(document).ready(function($){
        var mediaUploader;
        $('#avatarUrl_button').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Avatar',
                button: {
                    text: 'Choose Avatar'
                },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#avatarUrl').val(attachment.url);
            });
            mediaUploader.open();
        });
    });
});