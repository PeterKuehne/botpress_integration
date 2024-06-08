<?php
if (!defined('ABSPATH')) {
    exit;
}

function botpress_integration_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['botpress_settings'])) {
        $settings = get_option('botpress_settings', botpress_get_default_settings());

        // Update each setting individually to ensure checkboxes are handled
        $settings['composerPlaceholder'] = sanitize_text_field($_POST['botpress_settings']['composerPlaceholder']);
        $settings['botConversationDescription'] = sanitize_text_field($_POST['botpress_settings']['botConversationDescription']);
        $settings['botId'] = sanitize_text_field($_POST['botpress_settings']['botId']);
        $settings['hostUrl'] = sanitize_text_field($_POST['botpress_settings']['hostUrl']);
        $settings['messagingUrl'] = sanitize_text_field($_POST['botpress_settings']['messagingUrl']);
        $settings['clientId'] = sanitize_text_field($_POST['botpress_settings']['clientId']);
        $settings['webhookId'] = sanitize_text_field($_POST['botpress_settings']['webhookId']);
        $settings['lazySocket'] = isset($_POST['botpress_settings']['lazySocket']) ? true : false;
        $settings['themeName'] = sanitize_text_field($_POST['botpress_settings']['themeName']);
        $settings['avatarUrl'] = sanitize_text_field($_POST['botpress_settings']['avatarUrl']);
        $settings['stylesheet'] = sanitize_text_field($_POST['botpress_settings']['stylesheet']);
        $settings['frontendVersion'] = sanitize_text_field($_POST['botpress_settings']['frontendVersion']);
        $settings['useSessionStorage'] = isset($_POST['botpress_settings']['useSessionStorage']) ? true : false;
        $settings['enableConversationDeletion'] = isset($_POST['botpress_settings']['enableConversationDeletion']) ? true : false;
        $settings['theme'] = sanitize_text_field($_POST['botpress_settings']['theme']);
        $settings['themeColor'] = sanitize_text_field($_POST['botpress_settings']['themeColor']);
        $settings['allowedOrigins'] = array_map('sanitize_text_field', explode(',', $_POST['botpress_settings']['allowedOrigins']));
        $settings['calendlyUrl'] = sanitize_text_field($_POST['botpress_settings']['calendlyUrl']);
        update_option('botpress_settings', $settings);
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    $settings = get_option('botpress_settings', botpress_get_default_settings());
    ?>
    <div class="wrap">
        <h1>BotPress Integration Settings</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="composerPlaceholder">Bot Name</label></th>
                    <td><input name="botpress_settings[composerPlaceholder]" type="text" id="composerPlaceholder" value="<?php echo esc_attr($settings['composerPlaceholder']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="botConversationDescription">Bot Beschreibung</label></th>
                    <td><input name="botpress_settings[botConversationDescription]" type="text" id="botConversationDescription" value="<?php echo esc_attr($settings['botConversationDescription']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="botId">Bot ID</label></th>
                    <td><input name="botpress_settings[botId]" type="text" id="botId" value="<?php echo esc_attr($settings['botId']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="hostUrl">Host URL</label></th>
                    <td><input name="botpress_settings[hostUrl]" type="text" id="hostUrl" value="<?php echo esc_attr($settings['hostUrl']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="messagingUrl">Messaging URL</label></th>
                    <td><input name="botpress_settings[messagingUrl]" type="text" id="messagingUrl" value="<?php echo esc_attr($settings['messagingUrl']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="clientId">Client ID</label></th>
                    <td><input name="botpress_settings[clientId]" type="text" id="clientId" value="<?php echo esc_attr($settings['clientId']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="webhookId">Webhook ID</label></th>
                    <td><input name="botpress_settings[webhookId]" type="text" id="webhookId" value="<?php echo esc_attr($settings['webhookId']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="lazySocket">Lazy Socket</label></th>
                    <td><input name="botpress_settings[lazySocket]" type="checkbox" id="lazySocket" <?php checked($settings['lazySocket'], true); ?>></td>
                </tr>
                <tr>
                    <th scope="row"><label for="themeName">Theme Name</label></th>
                    <td><input name="botpress_settings[themeName]" type="text" id="themeName" value="<?php echo esc_attr($settings['themeName']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="avatarUrl">Avatar URL</label></th>
                    <td>
                        <input name="botpress_settings[avatarUrl]" type="text" id="avatarUrl" value="<?php echo esc_attr($settings['avatarUrl']); ?>" class="regular-text">
                        <input type="button" id="avatarUrl_button" class="button" value="Select Image">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="stylesheet">Stylesheet</label></th>
                    <td><input name="botpress_settings[stylesheet]" type="text" id="stylesheet" value="<?php echo esc_attr($settings['stylesheet']); ?>" class="regular-text">
                        <br><a target="_blank" rel="noreferrer" href="https://styler.botpress.app/?_gl=1*1scbk2*_ga*MTcxNDY0MzI4Ni4xNzE0NDczNjI1*_ga_HKHSWES9V9*MTcxNzQ5MjA4Ni4zMS4xLjE3MTc0OTIxMDQuMC4wLjA.">Stylesheet URL Generator</a>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="frontendVersion">Frontend Version</label></th>
                    <td><input name="botpress_settings[frontendVersion]" type="text" id="frontendVersion" value="<?php echo esc_attr($settings['frontendVersion']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="useSessionStorage">Sitzungsspeicher verwenden</label></th>
                    <td><input name="botpress_settings[useSessionStorage]" type="checkbox" id="useSessionStorage" <?php checked($settings['useSessionStorage'], true); ?>></td>
                </tr>
                <tr>
                    <th scope="row"><label for="enableConversationDeletion">Konversationen Löschen erlauben</label></th>
                    <td><input name="botpress_settings[enableConversationDeletion]" type="checkbox" id="enableConversationDeletion" <?php checked($settings['enableConversationDeletion'], true); ?>></td>
                </tr>
                <tr>
                    <th scope="row"><label for="theme">Theme</label></th>
                    <td><input name="botpress_settings[theme]" type="text" id="theme" value="<?php echo esc_attr($settings['theme']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="themeColor">Theme Color</label></th>
                    <td><input name="botpress_settings[themeColor]" type="text" id="themeColor" value="<?php echo esc_attr($settings['themeColor']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="allowedOrigins">Allowed Origins</label></th>
                    <td><input name="botpress_settings[allowedOrigins]" type="text" id="allowedOrigins" value="<?php echo esc_attr(implode(',', $settings['allowedOrigins'])); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="calendlyUrl">Calendly URL</label></th>
                    <td><input name="botpress_settings[calendlyUrl]" type="text" id="calendlyUrl" value="<?php echo esc_attr($settings['calendlyUrl']); ?>" class="regular-text"></td>
                </tr>
                </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
?>
