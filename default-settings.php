<?php
if (!defined('ABSPATH')) {
    exit;
}

function botpress_get_default_settings() {
    return array(
        'composerPlaceholder' => 'Chat with bot',
        'botConversationDescription' => 'This chatbot was built surprisingly fast with Botpress',
        'botId' => 'b4f639e7-b7f3-4834-88f8-e5c05e606edf',
        'hostUrl' => 'https://cdn.botpress.cloud/webchat/v1',
        'messagingUrl' => 'https://messaging.botpress.cloud',
        'clientId' => 'b4f639e7-b7f3-4834-88f8-e5c05e606edf',
        'webhookId' => 'e087df5b-984d-420a-8836-4338417003c9',
        'lazySocket' => true,
        'themeName' => 'prism',
        'avatarUrl' => 'https://sk-online-marketing.de/wp-content/uploads/2023/06/Gruppe-1508.png',
        'stylesheet' => 'https://webchat-styler-css.botpress.app/prod/97563d8c-2005-4868-931d-df6ebf3facf2/v68032/style.css',
        'frontendVersion' => 'v1',
        'useSessionStorage' => true,
        'enableConversationDeletion' => true,
        'theme' => 'prism',
        'themeColor' => '#2563eb',
        'allowedOrigins' => array(),
        'calendlyUrl' => 'https://calendly.com/info-pkq/meeting-clubmanager'
    );
}
?>
