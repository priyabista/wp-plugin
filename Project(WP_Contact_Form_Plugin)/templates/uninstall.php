<?php
defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

    function contact_form_uninstall() {
        
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'contact_form';

        $sql = "DROP TABLE `$table_name`";

        $wpdb->query($sql);
    }
?>