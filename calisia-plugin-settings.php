<?php
//namespace calisia_plugin_settings;
/**
 * Plugin Name: calisia-plugin-settings
 * Author: Tomasz Boroń
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

define('CALISIA_PLUGIN_SETTINGS_ROOT', __DIR__);

require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/renderer/interfaces/irenderer.php';
require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/renderer/renderer.php';

require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/inputs/factories/input-factory.php';
require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/inputs/input.php';

require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/settings/field.php';
require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/settings/menu-page.php';
require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/settings/options.php';
require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/settings/section.php';
require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/settings/settings-page.php';
require_once CALISIA_PLUGIN_SETTINGS_ROOT . '/src/settings/submenu-page.php';



$settings = new calisia_plugin_settings();





class calisia_plugin_settings{

    function __construct(){
        add_action( 'admin_menu', [$this, 'AddSettingsPage'] );
        add_action( 'admin_init', [$this, 'RegisterSettings'] );
    }

    public function AddSettingsPage(){
        $menuPage = new settings\MenuPage(new renderer\DefaultRenderer());
        $menuPage->pageTitle = 'My Settings Page';
        $menuPage->menuTitle = __( 'My Settings Page', 'some-textdomain' );
        $menuPage->capability = 'manage_options';
        $menuPage->menuSlug = 'another-test-settings-page';
        $menuPage->pageTemplate = 'default-settings-page';
        $menuPage->iconUrl = '';
        $menuPage->position = 0;
        $menuPage->optionGroup = 'my-option-group';
        $menuPage->page = 'my-settings-page';
        $menuPage->Add();



        $menuPage = new settings\SubMenuPage(new renderer\DefaultRenderer());
        $menuPage->parentSlug = 'another-test-settings-page';
        $menuPage->pageTitle = 'My Settings Sub Page';
        $menuPage->menuTitle = __( 'My Settings Sub Page', 'some-textdomain' );
        $menuPage->capability = 'manage_options';
        $menuPage->menuSlug = 'another-sub-test-settings-page';
        $menuPage->pageTemplate = 'default-settings-page';
        $menuPage->position = 1;
        $menuPage->optionGroup = 'my-option-group';
        $menuPage->page = 'my-settings-page';
        $menuPage->Add();


        $menuPage = new settings\SettingsPage(new renderer\DefaultRenderer());
        $menuPage->pageTitle = 'Settings Sub Page';
        $menuPage->menuTitle = __( 'Settings Sub Page', 'some-textdomain' );
        $menuPage->capability = 'manage_options';
        $menuPage->menuSlug = 'another-settings-test-settings-page';
        $menuPage->pageTemplate = 'default-settings-page';
        $menuPage->position = 0;
        $menuPage->optionGroup = 'my-option-group';
        $menuPage->page = 'my-settings-page';
        $menuPage->Add();

    }

    public function RegisterSettings(){

        $section = new settings\Section(new renderer\DefaultRenderer());
        $section->id = 'my-section-id';
        $section->title = 'my section title';
        $section->template = 'section-text-example-2';
        $section->page = 'my-settings-page';
        $section->text = 'Text about my section';
        $section->Add();

        $options = new settings\Options('my-option-group', 'my-option-name');

        $field = new settings\Field(new renderer\DefaultRenderer());     
        $field->id = 'my-input';
        $field->title = 'Some field';
        $field->page = 'my-settings-page';
        $field->sectionId = 'my-section-id';
        $field->optionName = 'my-option-name';   
        $field->input = inputs\factories\InputFactory::Create('input');
        $field->input->value = $options->get_option_value($field->id);
        $field->Add();

        $field2 = new settings\Field(new renderer\DefaultRenderer());
        $field2->id = 'my-input-2';
        $field2->title = 'Some field 2';
        $field2->page = 'my-settings-page';
        $field2->sectionId = 'my-section-id';
        $field2->optionName = 'my-option-name';
        $field2->input = inputs\factories\InputFactory::Create('input');
        $field2->input->value = $options->get_option_value($field2->id);
        $field2->Add();
        //$fields->input->id = $fields->id;
        //$fields->input->name = $fields->optionName . '[' . $fields->id . ']';
        //$fields->input->class = 'my-input-class';
        //$fields->input->value = $fields->get_option_value($fields->id);

    }
}