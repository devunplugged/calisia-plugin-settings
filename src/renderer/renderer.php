<?php
namespace renderer;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}



class DefaultRenderer implements interfaces\IRenderer{
    public function render(string $template, array $args = [], bool $render = true){
        if(!$render)
            ob_start();
    
        include  CALISIA_PLUGIN_SETTINGS_ROOT . '/templates/'.$template.'.php';
        
        if(!$render){
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
    }
}