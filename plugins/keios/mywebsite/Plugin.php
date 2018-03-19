<?php namespace Keios\MyWebsite;

use System\Classes\PluginBase;

/**
 * MyWebsite Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */

    public function pluginDetails()
    {
        return [
            'name'        => 'MyWebsite',
            'description' => 'keios.mywebsite::lang.keys.plugin_desc',
            'author'      => 'keios',
            'icon'        => 'icon-user',
        ];
    }

    /**
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'keios.mywebsite::lang.keys.plugin_name',
                'description' => 'keios.mywebsite::lang.keys.settings_desc',
                'icon'        => 'icon-user',
                'category'    => 'system::lang.system.categories.cms',
                'class'       => 'Keios\Mywebsite\Models\Settings',
                'permissions' => ['keios.mywebsite.access_Settings'],
                'order'       => 600,
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerFormWidgets()
    {
        return [
            'Owl\FormWidgets\Address\Widget' => [
                'label' => 'Address',
                'code' => 'owl-address'
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'keios.mywebsite.access_settings' => [
                'tab'   => 'keios.mywebsite::lang.keys.tab',
                'label' => 'keios.mywebsite::lang.keys.settings',
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Keios\Mywebsite\Components\WebVariables'  => 'webvariables',
            'Keios\Mywebsite\Components\CookieWarning' => 'cookiewarning',
            'Keios\Mywebsite\Components\Map'           => 'mymap',
        ];
    }


}
