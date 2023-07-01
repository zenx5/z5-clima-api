<?php

class Z5Clima {

    public static function activation() {

    }

    public static function deactivation() {
        
    }

    public static function init() {
        add_action('admin_menu', ['Z5Clima', 'admin_menu']);
        add_action('wp_head', ['Z5Clima', 'card_clima']);
        add_action('wp_enqueue_scripts', ['Z5Clima', 'script_head']);
        add_action('wp_ajax_get_clima', ['Z5Clima', 'get_clima']);
        add_action('wp_ajax_save_options', ['Z5Clima', 'save_options']);
    }

    public static function admin_menu() {
        add_menu_page(
            'Clima API',
            'Clima API',
            'manage_options',
            'clima-options',
            function(){
                include WP_PLUGIN_DIR.'/z5-clima-api/templates/clima-options.php';
            },
            "",
            10
        );
    }

    public static function script_head() {
        wp_register_style( 'clima-style', plugins_url( '../css/card-clima.css' , __FILE__ ) );
        wp_register_script( 'position-script', plugins_url( '../js/position.js' , __FILE__ ) );
        wp_enqueue_style( 'clima-style' );
        wp_enqueue_script( 'position-script' );
    }

    public static function card_clima() {
        include WP_PLUGIN_DIR.'/z5-clima-api/templates/clima.php';
    }

    public static function get_clima() {
        $apikey = get_option('z5-clima-apikey','');
        $units = get_option('z5-clima-units','metric');
        $lat = $_GET['lat'];
        $lon = $_GET['lon'];
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apikey&units=$units";

        $temp = 'K';
        $speed = 'meter/sec';
        switch ($units) {
            case 'standard': 
                $temp = 'K';
                $speed = 'meter/sec';
                break;
            case 'metric': 
                $temp = 'ºC';
                $speed = 'meter/sec';
                break;
            case 'imperial': 
                $temp = 'ºF';
                $speed = 'miles/hour';
                break;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode( curl_exec($ch), true );
        curl_close($ch);
        $result["units"] = [
            "temp" => $temp,
            "speed" => $speed
        ];
        
        echo json_encode( $result );
        die();
    }

    public static function save_options() {
        $apikey = $_GET['apikey'];
        $units = $_GET['units'];
        update_option('z5-clima-apikey', $apikey);
        update_option('z5-clima-units', $units);
        echo 1;
        die();
    }

}