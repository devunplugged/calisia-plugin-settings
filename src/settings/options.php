<?php
namespace settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class Options{
    private $optionGroup;
    private $optionName;

    function __construct($optionGroup, $optionName, $args=[]){
        $this->optionGroup = $optionGroup;
        $this->optionName = $optionName;
        $this->RegisterSetting($args);
    }

    public function RegisterSetting($args=[]){
        \register_setting(
            $this->optionGroup,
            $this->optionName,
            $args
        );
    }

    public function option_on($option_name){
        $options = get_option( $this->optionName );
        if(!isset($options[$option_name]) || !$options[$option_name])
            return 0;
        return 1;
    }

    public function get_option_value($option_name){
        $options = get_option( $this->optionName );
        if(isset($options[$option_name]) && $options[$option_name])
            return $options[$option_name];
        return '';
    }
}