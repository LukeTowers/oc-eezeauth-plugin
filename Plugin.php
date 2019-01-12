<?php namespace LukeTowers\EEZEAuth;

use Backend;
use System\Classes\PluginBase;

/**
 * EEZEAuth Plugin Information File
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
            'name'        => 'EEZEAuth',
            'description' => 'No description provided yet...',
            'author'      => 'LukeTowers',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'LukeTowers\EEZEAuth\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'luketowers.eezeauth.some_permission' => [
                'tab' => 'EEZEAuth',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'eezeauth' => [
                'label'       => 'EEZEAuth',
                'url'         => Backend::url('luketowers/eezeauth/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['luketowers.eezeauth.*'],
                'order'       => 500,
            ],
        ];
    }
}
