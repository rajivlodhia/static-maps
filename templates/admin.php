<div class="wrap">
    <h1>Static Maps Settings</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
        settings_fields( 'static_maps_options_group' );
        do_settings_sections( 'static_maps_settings' );
        //do_settings_fields( 'static_maps_settings', 'section_static_maps_google' );
        submit_button();
        ?>
    </form>
</div>
