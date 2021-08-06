<h1><?php echo $args['title']; ?></h1>
<form action="options.php" method="post">
    <?php 
        settings_fields( 'my-option-group' );
        do_settings_sections( 'my-settings-page' ); 
    ?>
    <input name="submit" class="button button-primary" type="submit" value="<?php _e( 'Save', 'some-textdomain' ); ?>" />
</form>