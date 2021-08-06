<?php
namespace settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class SubMenuPage{
    public $parentSlug;
    public $pageTitle;
    public $menuTitle;
    public $capability;
    public $menuSlug;
    public $pageTemplate = '';
    public $position = null;
    public $optionGroup;
    public $page;

    private $renderer;
    
    function __construct(\renderer\interfaces\IRenderer $renderer){
        $this->renderer = $renderer;
    }

    public function Add(){
        \add_submenu_page(
            $this->parentSlug,
            $this->pageTitle,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            [$this, 'Render'],
            $this->position
        );
    }

    public function Render(){
        $this->renderer->render(
            $this->pageTemplate,
            [
                'title' => $this->pageTitle,
                'optionGroup' => $this->optionGroup,
                'page' => $this->page
            ]
        );
    }
}