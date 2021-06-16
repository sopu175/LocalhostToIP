<form action="<?php plugin_dir_path(__FILE__) . "/form_field.php"; ?>" method="post">
    <?php

    $current_url = get_home_url();
    $exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
    $hostname = trim($exec); //remove any spaces before and after
    $ip = gethostbyname($hostname); //resolves the hostname using local hosts resolver or DNS
    //check string
    $check_localhost = true;
    if (strpos($current_url, 'localhost') !== false) {
        $check_localhost = false;
    }
    else{
       $check_localhost = true;
    }

    wp_nonce_field('ltp');

    ?>
    <div class="Form_wrapper">


        <?php
        echo "<h2 class='Title'>Localhost to IP</h2>";

        if($check_localhost == true){
            echo '<h3 class="short_description">If your site url is <span class="text-underline">' . get_home_url() . '</span> then it will be change to <span class="text-underline">' . str_replace($ip, "localhost", get_home_url()) . '</span></h3>';

            echo "Please make sure your site url is ". get_home_url();
        }
        else{
            echo '<h3 class="short_description">If your site url is <span class="text-underline">' . get_home_url() . '</span> then it will be change to <span class="text-underline">' . str_replace("localhost", $ip, get_home_url()) . '</span></h3>';

        }
        ?>

        <div class="form-group">
            <?php
                if($check_localhost == false){
                    submit_button('Click to Update IP');
                    $check_localhost = false;
                }
                else{
                    submit_button('Back To localhost');
                    $check_localhost = true;
                }
            ?>
        </div>
    </div>
</form>
<?php


global $wpdb;
$table_name = $wpdb->prefix . "options";
if (isset($_POST['submit'])) {
    global $wpdb;


    if($check_localhost == false){
        $exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
        $hostname = trim($exec); //remove any spaces before and after
        $ip = gethostbyname($hostname); //resolves the hostname using local hosts resolver or DNS
        $ip = $ip;
        $ip = sanitize_text_field($ip);
        $url = str_replace("localhost", $ip, get_home_url());

        $execut = $wpdb->query($wpdb->prepare("UPDATE $table_name SET option_value = %s WHERE option_id = %s ", $url, 1));
        $execut2 = $wpdb->query($wpdb->prepare("UPDATE $table_name SET option_value = %s WHERE option_id = %s ", $url, 2));

        if (($execut > 0) && ($execut2)) {
            printf(
            esc_html__('Successfully Updated Your site url is now ' . $url ,'ltp'));
            printf(
                '<br><a href="%s/wp-admin">%s</a>',
                esc_url( $url),
                esc_html__( 'Click to Login', 'ltp' )
            );
        } else {
            exit(var_dump($wpdb->last_query));
        }
        $wpdb->flush();
    }
    if($check_localhost == true){
        $exec = exec("hostname"); //the "hostname" is a valid command in both windows and linux
        $hostname = trim($exec); //remove any spaces before and after
        $ip = gethostbyname($hostname); //resolves the hostname using local hosts resolver or DNS

        $ip = sanitize_text_field($ip);
        $url = str_replace($ip, "localhost", get_home_url());

        $execut = $wpdb->query($wpdb->prepare("UPDATE $table_name SET option_value = %s WHERE option_id = %s ", $url, 1));
        $execut2 = $wpdb->query($wpdb->prepare("UPDATE $table_name SET option_value = %s WHERE option_id = %s ", $url, 2));

        if (($execut > 0) && ($execut2)) {
            printf(esc_html__('Successfully Updated Your site url is now' . $url  ,'ltp'));
            printf('<br><a href="%s/wp-admin">%s</a>', esc_url( $url), esc_html__( 'Click to Login', 'ltp' ) );
        } else {
            exit(var_dump($wpdb->last_query));
        }
        $wpdb->flush();
    }

}
