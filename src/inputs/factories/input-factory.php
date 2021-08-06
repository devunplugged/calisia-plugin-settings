<?php
namespace inputs\factories;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}


class InputFactory{
    public static function Create(string $type){
        switch($type){
            case 'input': return new \inputs\Input(); break;
        }
    }
}
